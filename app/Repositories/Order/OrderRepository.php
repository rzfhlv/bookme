<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\Repository;

class OrderRepository extends Repository
{
    protected $order;

    public function __construct(Order $order)
    {
        parent::__construct();
        $this->order = $order;
    }

    public function create(array $data)
    {
        return $this->order::create($data);
    }

    public function all()
    {
        return $this->order::paginate($this->getPagination());
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
