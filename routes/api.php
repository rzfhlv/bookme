<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RefreshController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [LoginController::class, 'index'])->name('login');
Route::post('/register', [RegisterController::class, 'index']);

Route::middleware(['auth:sanctum', 'ability:access-api'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [LogoutController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'ability:access-token'])->post('/refresh', [RefreshController::class, 'index']);

Route::get('/unauthorized', function (Request $request) {
    return response()->json([
        'ok' => false,
        'msg' => 'Unauthorized',
    ], Response::HTTP_UNAUTHORIZED);
})->name('unauthorized');

Route::any('{path}', function () {
    return response()->json(array(
        'ok' => false,
        'msg' => 'Invalid API',
    ), 404);
})->where('path', '.*');