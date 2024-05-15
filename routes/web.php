<?php

use App\Http\Controllers\admin\PizzaController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::resource('/pizzas', PizzaController::class);
    Route::resource('/users', UserController::class);
    Route::post('/users/{user}/roles', [UserController::class , 'assignRole'])->name('user.role');
    Route::delete('/users/{user}/role/{role}', [UserController::class, 'removeRole'])->name('user.role.remove');
});

require __DIR__.'/auth.php';
