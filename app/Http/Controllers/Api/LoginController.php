<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function index(LoginRequest $request)
    {
        try {
            $result = $this->loginService->login($request->all());
            return response()->json([
                'ok' => true,
                'msg' => 'Success',
                'data' => $result,
            ]);
        } catch (\Throwable $th) {
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;
            if ($th instanceof ValidationException) {
                $code = Response::HTTP_UNAUTHORIZED;
            }
            return response()->json([
                'ok' => false,
                'msg' => $th->getMessage(),
            ], $code);
        }
    }
}
