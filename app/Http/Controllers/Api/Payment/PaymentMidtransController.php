<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\PaymentMidtransCreateRequest;
use App\Http\Resources\Order\OrderDetailResource;
use App\Services\Payment\PaymentMidtransService;
use Throwable;

class PaymentMidtransController extends Controller
{
    protected $paymentMidtransService;

    public function __construct(PaymentMidtransService $paymentMidtransService)
    {
        $this->paymentMidtransService = $paymentMidtransService;
    }

    public function createTransaction(PaymentMidtransCreateRequest $request)
    {
        try {
            $data = $request->validated();
            $data['email'] = $request->user()->email;

            $snapToken = $this->paymentMidtransService->createTransaction($data);

            return new OrderDetailResource($snapToken);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }
}
