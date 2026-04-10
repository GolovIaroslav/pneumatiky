<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Keep old route for backward compat (redirect to products listing)
Route::get('/product-detail', function () {
    return redirect()->route('products');
})->name('product.detail');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/transport', function () {
    return view('transport');
})->name('transport');

Route::get('/delivery', function () {
    return view('delivery');
})->name('delivery');

Route::get('/confirmation', function () {
    return view('confirmation');
})->name('confirmation');

Route::get('/admin-form', function () {
    return view('admin-form');
})->name('admin.form');

Route::get('/admin-products', function () {
    return view('admin-products');
})->name('admin.products');

Route::get('/summary', function () {
    return view('summary');
})->name('summary');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
