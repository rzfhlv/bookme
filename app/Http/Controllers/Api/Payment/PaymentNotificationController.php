<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Services\Payment\PaymentNotificationService;
use Illuminate\Http\Request;
use Throwable;

class PaymentNotificationController extends Controller
{
    protected $paymentNotificationService;

    public function __construct(PaymentNotificationService $paymentNotificationService)
    {
        $this->paymentNotificationService = $paymentNotificationService;
    }

    public function handleNotification(Request $request)
    {
        try {
            $this->paymentNotificationService->handleNotification($request->all());

            return $this->responseBasic();
        } catch (Throwable $th) {
            dd($th);
            return $this->generateError($th);
        }
    }
}
