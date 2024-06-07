<?php

use Illuminate\Support\Facades\Route;
// controllers
use App\Http\Controllers\api\auth\AuthController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\PizzaController;
use App\Http\Controllers\api\UserController;

Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/user/address', [UserController::class, 'updateUserAddress']);
    Route::delete('/user/address/{addressId}', [UserController::class, 'deleteUserAddress']);
    Route::get('/orders/generate/token', [OrderController::class, 'generateFrontToken']);
    Route::post('/orders/make/payment', [OrderController::class, 'makePayment']);
    Route::get('/orders', [OrderController::class, 'getUserOrders']);
});

Route::name('api.')->group(function () {
    Route::get('/pizzas', [PizzaController::class, 'index']);
    Route::get('/pizzas-with-discount', [PizzaController::class, 'pizzasWithDiscount']);
    Route::get('/pizzas/{pizza}', [PizzaController::class, 'show']);
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);