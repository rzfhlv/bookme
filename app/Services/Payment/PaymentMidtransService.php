<?php

namespace App\Services\Payment;

use App\Repositories\Order\OrderRepository;
use App\Repositories\Payment\PaymentMidtransRepository;
use App\Repositories\Payment\PaymentRepository;
use Illuminate\Support\Facades\DB;
use Throwable;

class PaymentMidtransService
{
    protected $paymentMidtransRepository;
    protected $orderRepository;
    protected $paymentRepository;

    public function __construct(
        PaymentMidtransRepository $paymentMidtransRepository,
        OrderRepository $orderRepository,
        PaymentRepository $paymentRepository,
    ) {
        $this->paymentMidtransRepository = $paymentMidtransRepository;
        $this->orderRepository = $orderRepository;
        $this->paymentRepository = $paymentRepository;
    }

    public function createTransaction(array $data)
    {
        DB::beginTransaction();
        try {
            $order = $this->orderRepository->get($data["order_id"]);
            $payment = $order->payments->sortByDesc("created_at")->first();
            $client = $order->client;

            $params = [
                "transaction_details" => [
                    "order_id" => $order->id . "-" . $payment->id,
                    "gross_amount" => $payment->amount_paid,
                ],
                "expiry" => [
                    "start_time" => date("Y-m-d H:i:s T"),
                    "unit" => "hour",
                    "duration" => 3,
                ],
                "customer_details" => [
                    "firts_name" => $client->name,
                    "email" => $data["email"],
                ],
            ];
            $snap = $this->paymentMidtransRepository->createTransaction($params);
            $orderPayload = [
                "token_snap" => $snap->token,
                "redirect_url" => $snap->redirect_url,
            ];
            $paymentPayload = [
                "request_payload" => $params,
            ];
            $this->orderRepository->update($orderPayload, $order->id);
            $this->paymentRepository->update($paymentPayload, $payment->id);
        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        DB::commit();

        return $this->orderRepository->get($order->id);
    }
}
