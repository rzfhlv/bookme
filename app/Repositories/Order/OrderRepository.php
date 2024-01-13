<?php

namespace App\Repositories\Order;

use App\Models\Order;

class OrderRepository
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function create(array $data)
    {
        return $this->order::create($data);
    }

    public function all()
    {
        return $this->order::paginate(5);
    }

    public function get(int $id)
    {
        return $this->order::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        return $this->order::findOrFail($id)->update($data);
    }

    public function delete(int $id)
    {
        return $this->order::findOrFail($id)->delete();
    }
}
