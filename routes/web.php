<?php

use Illuminate\Support\Facades\Route;

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
