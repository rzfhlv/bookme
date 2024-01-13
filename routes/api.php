<?php

use App\Http\Controllers\Api\Conselor\ConselorController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RefreshController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Client\ClientController;
use App\Http\Controllers\Api\Schedule\ScheduleController;
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

    Route::prefix('/conselors')->group(function () {
        Route::controller(ConselorController::class)->group(function () {
            Route::post('/', 'create');
            Route::get('/', 'all');
            Route::get('/{id}', 'get');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'delete');
        });
    });

    Route::prefix('/categories')->group(function () {
        Route::controller(CategoryController::class)->group(function () {
            Route::post('/', 'create');
            Route::get('/', 'all');
            Route::get('/{id}', 'get');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'delete');
        });
    });

    Route::prefix('/clients')->group(function () {
        Route::controller(ClientController::class)->group(function () {
            Route::post('/', 'create');
            Route::get('/', 'all');
            Route::get('/{id}', 'get');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'delete');
        });
    });

    Route::prefix('/schedules')->group(function () {
        Route::controller(ScheduleController::class)->group(function () {
            Route::post('/', 'create');
            Route::get('/', 'all');
            Route::get('/{id}', 'get');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'delete');
        });
    });
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
