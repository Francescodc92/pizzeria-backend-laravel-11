<?php

use App\Http\Controllers\api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['middleware' => 'auth:sanctum'], function () {
});

Route::get('orders/generate', [OrderController::class, 'generateFrontToken']);
Route::post('orders/make/payment', [OrderController::class, 'makePayment']);