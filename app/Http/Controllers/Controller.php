<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\UniqueConstraintViolationException;
use Throwable;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;

    protected function generateError(Throwable $th)
    {
        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        $msg = "Something went wrong";

        if ($th instanceof ModelNotFoundException) {
            $statusCode = Response::HTTP_NOT_FOUND;
            $msg = "Data not found";
        } elseif ($th instanceof ValidationException) {
            $statusCode = Response::HTTP_UNAUTHORIZED;
            $msg = "The provided credentials are incorrect";
        } elseif ($th instanceof UniqueConstraintViolationException) {
            $statusCode = Response::HTTP_CONFLICT;
            $msg = "Duplicate entry";
        } elseif ($th->getCode() == 400) {
            $statusCode = Response::HTTP_BAD_REQUEST;
            $msg = $th->getMessage();
        }

        return response()->json([
            "ok" => false,
            "msg" => $msg,
        ], $statusCode);
    }

    protected function responseBasic()
    {
        return response()->json([
            "ok" => true,
            "msg" => "Success",
        ]);
    }

    protected function getPagination()
    {
        return config('additional.pagination');
    }
}
