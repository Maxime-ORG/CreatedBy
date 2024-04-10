<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Http\Request;
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

Route::middleware('guest')->group(function () {
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/product', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/search/{name}', [ProductController::class, 'search'])->name('product.search');
    Route::get('/product/category/{name}', [ProductController::class, 'category'])->name('product.category');
    Route::get('/product/material/{name}', [ProductController::class, 'material'])->name('product.material');
    Route::get('/product/color/{name}', [ProductController::class, 'color'])->name('product.color');
    Route::get('/product/size/{name}', [ProductController::class, 'size'])->name('product.size');

    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
    Route::post('/shop', [ShopController::class, 'create'])->name('shop.create');
    Route::get('/shop/{id}', [ShopController::class, 'show'])->name('shop.show');
    Route::delete('/shop/{id}', [ShopController::class, 'destroy'])->name('shop.destroy');
    Route::put('/shop/{id}', [ShopController::class, 'update'])->name('shop.update');

    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order', [OrderController::class, 'create'])->name('order.create');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::delete('/order/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::put('/order/{id}', [OrderController::class, 'update'])->name('order.update');
});
