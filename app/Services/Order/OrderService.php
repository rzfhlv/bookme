<?php

namespace App\Services\Order;

use App\Enums\OrderStatus;
use App\Repositories\Order\OrderRepository;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function create(array $data)
    {
        $data['status'] = OrderStatus::PENDING;
        return $this->orderRepository->create($data);
    }

    public function all()
    {
        return $this->orderRepository->all();
    }

    public function get(int $id)
    {
        return $this->orderRepository->get($id);
    }

    public function update(array $data, int $id)
    {
        return $this->orderRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        return $this->orderRepository->delete($id);
    }
}
