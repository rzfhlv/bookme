<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RefreshController extends Controller
{
    public function index(Request $request)
    {
        try {
            $token = $request->user()->createToken('access_token', ['access-api'], now()->addMinutes(config('sanctum.access_token_exp')))->plainTextToken;
            return response()->json([
                'ok' => true,
                'msg' => 'Success',
                'data' => [
                    'access_token' => $token,
                ]
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'msg' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
