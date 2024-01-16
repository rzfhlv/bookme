<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\PaymentCreateRequest;
use App\Http\Requests\Payment\PaymentUpdateRequest;
use App\Http\Resources\Payment\PaymentCollection;
use App\Http\Resources\Payment\PaymentDetailResource;
use App\Services\Payment\PaymentService;
use Illuminate\Http\Request;
use Throwable;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function create(PaymentCreateRequest $request)
    {
        try {
            $payment = $this->paymentService->create($request->validated());

            return new PaymentDetailResource($payment);
        } catch (Throwable $th) {
            dd($th);
            return $this->generateError($th);
        }
    }

    public function all(Request $request)
    {
        try {
            $payments = $this->paymentService->all();

            return new PaymentCollection($payments);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function get(Request $request, $id)
    {
        try {
            $payment = $this->paymentService->get($id);

            return new PaymentDetailResource($payment);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function update(PaymentUpdateRequest $request, $id)
    {
        try {
            $this->paymentService->update($request->validated(), $id);
            $payment = $this->paymentService->get($id);

            return new PaymentDetailResource($payment);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $this->paymentService->delete($id);

            return $this->responseBasic();
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }
}
