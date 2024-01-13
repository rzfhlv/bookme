<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class LogoutController extends Controller
{
    public function index(Request $request)
    {
        try {
            $request->user()->tokens()->delete();

            return $this->responseBasic();
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }
}
