<?php

namespace App\Repositories\Payment;

use App\Models\Payment;

class PaymentRepository
{
    protected $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function create(array $data)
    {
        return $this->payment::create($data);
    }

    public function all()
    {
        return $this->payment::paginate(5);
    }

    public function get(int $id)
    {
        return $this->payment::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        return $this->payment::findOrFail($id)->update($data);
    }

    public function delete(int $id)
    {
        return $this->payment::findOrFail($id)->delete();
    }
}
