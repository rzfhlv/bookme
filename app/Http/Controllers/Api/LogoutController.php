<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogoutController extends Controller
{
    public function index(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return response()->json([
                'ok' => true,
                'msg' => 'Success',
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'msg' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
