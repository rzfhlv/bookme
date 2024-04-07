<?php

use App\Http\Controllers\Api\Payment\PaymentNotificationController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'status' => 'ok',
        'msg' => 'Welcome to the app!'
    ]);
});

Route::post('/payments/midtrans/notification', [PaymentNotificationController::class, 'handleNotification']);
