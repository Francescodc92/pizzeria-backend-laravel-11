<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//controllers admin
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\PizzaController;
use App\Http\Controllers\admin\UserController;

//controllers employee
use App\Http\Controllers\employee\EmployeePizzaController;
use App\Http\Controllers\employee\EmployeeUserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//admin routes
Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    //pizzas
    Route::resource('/pizzas', PizzaController::class);
    //users
    Route::resource('/users', UserController::class)->only(['index', 'show']);
    Route::post('/users/{user}/roles', [UserController::class , 'assignRole'])->name('user.role');
    Route::delete('/users/{user}/role/{role}', [UserController::class, 'removeRole'])->name('user.role.remove');
    //orders
    Route::resource('/orders', OrderController::class)->only(['index', 'show', 'update']);
    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


//employee routes
Route::middleware(['auth', 'role:admin|employee'])->name('employee.')->prefix('employee')->group(function () {
    //pizzas
    Route::resource('/pizzas', EmployeePizzaController::class)->only(['index', 'show']);
    //users
    Route::resource('/users', EmployeeUserController::class)->only(['index', 'show']);
    // //orders
    // Route::resource('/orders', OrderController::class)->only(['index', 'show', 'update']);
});

require __DIR__.'/auth.php';
