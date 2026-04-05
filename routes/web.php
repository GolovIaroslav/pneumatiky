<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/products', function () {
    return view('products');
})->name('products');

Route::get('/product-detail', function () {
    return view('product-detail');
})->name('product.detail');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

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

