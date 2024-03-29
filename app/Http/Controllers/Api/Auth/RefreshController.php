<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class RefreshController extends Controller
{
    public function index(Request $request)
    {
        try {
            $token = $request->user()->createToken(
                'access_token',
                ['access-api'],
                now()->addMinutes(config('sanctum.access_token_exp'))
            )->plainTextToken;

            return response()->json([
                "ok" => true,
                "msg" => "Success",
                "data" => [
                    "access_token" => $token,
                ]
            ], Response::HTTP_OK);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }
}
