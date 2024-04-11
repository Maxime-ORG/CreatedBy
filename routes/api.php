<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::post('/logout', [LoginRegisterController::class, 'logout']);

    Route::controller(ProductController::class)->group(function() {
        Route::post('/product', 'create')->name('product.create');
        Route::delete('/product/{id}', 'destroy')->name('product.destroy');
        Route::put('/product/{id}', 'update')->name('product.update');

    });

    Route::controller(ShopController::class)->group(function() {
        Route::post('/shop', 'create')->name('shop.create');
        Route::delete('/shop/{id}', 'destroy')->name('shop.destroy');
        Route::put('/shop/{id}', 'update')->name('shop.update');
    });

    Route::controller(OrderController::class)->group(function() {
        Route::post('/order', 'create')->name('order.create');
        Route::delete('/order/{id}', 'destroy')->name('order.destroy');
        Route::put('/order/{id}', 'update')->name('order.update');
    });
});

Route::middleware('guest')->group(function () {
    Route::controller(ProductController::class)->group(function() {
        Route::get('/product', 'index')->name('product.index');
        Route::get('/product/{id}', 'show')->name('product.show');
        Route::get('/product/search/{name}', 'search')->name('product.search');
        Route::get('/product/category/{name}', 'category')->name('product.category');
        Route::get('/product/material/{name}', 'material')->name('product.material');
        Route::get('/product/color/{name}', 'color')->name('product.color');
        Route::get('/product/size/{name}', 'size')->name('product.size');
    });

    Route::controller(ShopController::class)->group(function() {
        Route::get('/shop', 'index')->name('shop.index');
        Route::get('/shop/{id}', 'show')->name('shop.show');
    });

    Route::controller(OrderController::class)->group(function() {
        Route::get('/order', 'index')->name('order.index');
        Route::get('/order/{id}', 'show')->name('order.show');
    });
});

