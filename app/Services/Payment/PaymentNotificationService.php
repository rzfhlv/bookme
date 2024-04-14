<?php

namespace App\Services\Payment;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Payment\PaymentNotificationRepository;
use App\Repositories\Payment\PaymentRepository;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Notification;
use Throwable;

class PaymentNotificationService
{
    protected $paymentNotificationRepository;
    protected $orderRepository;
    protected $paymentRepository;

    public function __construct(
        OrderRepository $orderRepository,
        PaymentRepository $paymentRepository,
    ) {
        $this->orderRepository = $orderRepository;
        $this->paymentRepository = $paymentRepository;
    }

    public function handleNotification(array $data)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        $notification = new Notification();
        $validSignature = hash(
            "sha512",
            $data["order_id"] .
            $data["status_code"] .
            $data["gross_amount"] .
            config('payment.midtrans.server.key')
        );

        if ($data["signature_key"] != $validSignature) {
            throw ValidationException::withMessages([
                'email' => ['Signature key not verified'],
            ]);
        }

        $transaction = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $idList = explode('-', $notification->order_id);

        $paymentStatus = null;
        $orderStatus = null;
        if ($transaction == "capture") {
            if ($type == "credit_card") {
                if ($fraud == "challenge") {
                    $paymentStatus = PaymentStatus::CHALLENGE;
                    $orderStatus = OrderStatus::FAILED;
                } else {
                    $paymentStatus = PaymentStatus::SETTLEMENT;
                    $orderStatus = OrderStatus::SUCCESS;
                }
            }
        } elseif ($transaction == "settlement") {
            $paymentStatus = PaymentStatus::SETTLEMENT;
            $orderStatus = OrderStatus::SUCCESS;
        } elseif ($transaction == "pending") {
            $paymentStatus = PaymentStatus::PENDING;
            $orderStatus = OrderStatus::PENDING;
        } elseif ($transaction == "deny") {
            $paymentStatus = PaymentStatus::DENY;
            $orderStatus = OrderStatus::FAILED;
        } elseif ($transaction == "expire") {
            $paymentStatus = PaymentStatus::EXPIRE;
            $orderStatus = OrderStatus::FAILED;
        } elseif ($transaction == "cancel") {
            $paymentStatus = PaymentStatus::CANCEL;
            $orderStatus = OrderStatus::CANCELLED;
        }

        $paymentUpdate = ["status" => $paymentStatus, "response_payload" => $data];
        $orderUpdate = ["status" => $orderStatus];

        DB::beginTransaction();
        try {
            $this->paymentRepository->update($paymentUpdate, $idList[1]);
            $this->orderRepository->update($orderUpdate, $idList[0]);
        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        DB::commit();

        return true;
    }
}
