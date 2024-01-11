<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\RegisterService;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    protected $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function index(RegisterRequest $request)
    {
        try {
            $result = $this->registerService->register($request->all());

            return response()->json([
                "ok" => true,
                "msg" => "Success",
                "data" => $result,
            ]);
        } catch (\Throwable $th) {
            return $this->generateError($th);
        }
    }
}
