<?php

namespace App\Services\Payment;

use App\Enums\PaymentStatus;
use App\Repositories\Payment\PaymentRepository;

class PaymentService
{
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function create(array $data)
    {
        $data['status'] = PaymentStatus::PENDING;
        return $this->paymentRepository->create($data);
    }

    public function all()
    {
        return $this->paymentRepository->all();
    }

    public function get(int $id)
    {
        return $this->paymentRepository->get($id);
    }

    public function update(array $data, int $id)
    {
        return $this->paymentRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        return $this->paymentRepository->delete($id);
    }
}
