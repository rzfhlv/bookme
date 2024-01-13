<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Http\Resources\Order\OrderCollection;
use App\Http\Resources\Order\OrderDetailResource;
use App\Services\Order\OrderService;
use Illuminate\Http\Request;
use Throwable;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function create(OrderCreateRequest $request)
    {
        try {
            $order = $this->orderService->create($request->validated());

            return new OrderDetailResource($order);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function all(Request $request)
    {
        try {
            $orders = $this->orderService->all();

            return new OrderCollection($orders);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function get(Request $request, $id)
    {
        try {
            $order = $this->orderService->get($id);

            return new OrderDetailResource($order);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function update(OrderUpdateRequest $request, $id)
    {
        try {
            $this->orderService->update($request->validated(), $id);
            $order = $this->orderService->get($id);

            return new OrderDetailResource($order);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $this->orderService->delete($id);

            return $this->responseBasic();
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }
}
