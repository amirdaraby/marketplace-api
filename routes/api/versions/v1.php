<?php

use App\Http\Controllers\v1\AuthController;
use Illuminate\Support\Facades\Route;

Route::name('admins.')->prefix('/admins')->group(function (){});

Route::name('auth.')->prefix('/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::name('users.')->prefix('/users')->group(function (){});

Route::name('sellers.')->prefix('/sellers')->group(function (){});

Route::name('orders.')->prefix('/orders')->group(function (){});

Route::name('products.')->prefix('/products')->group(function (){});
