<?php

use App\Http\Controllers\v1\AdminController;
use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\MarketController;
use App\Http\Controllers\v1\ProductController;
use App\Http\Controllers\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::name('admins.')->prefix('/admins')->middleware(['auth:api', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
});

Route::name('users.')->prefix('/users')->middleware(['auth:api'])->group(function () {
    Route::post('/', [UserController::class, 'store'])->middleware('admin')->name('store');
    Route::get('/', [UserController::class, 'index'])->middleware('admin')->name('index');
    Route::get('/{id}', [UserController::class, 'show'])->name('show');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'delete'])->name('delete');
});

Route::name('auth.')->prefix('/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::name('markets.')->prefix('/markets')->middleware(['auth:api'])->group(function () {
    Route::post('/', [MarketController::class, 'store'])->middleware('admin')->name('store');
    Route::get('/', [MarketController::class, 'index'])->middleware('admin')->name('index');
    Route::get('/{id}', [MarketController::class, 'show'])->name('show');
    Route::put('/{id}', [MarketController::class, 'update'])->name('update');
    Route::delete('/{id}', [MarketController::class, 'delete'])->name('delete');
});

Route::name('products.')->prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->middleware('seller')->name('index');
    Route::post('/', [ProductController::class, 'store'])->middleware('seller')->name('products.store');
    Route::put('/{id}', [ProductController::class, 'update'])->middleware('seller')->name('products.update');
    Route::delete('/{id}', [ProductController::class, 'delete'])->middleware('seller')->name('products.delete');
    Route::get('/{id}', [ProductController::class, 'show'])->name('show');
});
