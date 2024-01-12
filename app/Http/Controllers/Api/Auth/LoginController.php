<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Throwable;

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
                "ok" => true,
                "msg" => "Success",
                "data" => $result,
            ]);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }
}
