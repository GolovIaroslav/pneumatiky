<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    $newestProducts = \App\Models\Product::with(['images' => fn ($q) => $q->orderByDesc('is_main')])
        ->orderByDesc('id')
        ->limit(10)
        ->get();

    $recommendedProducts = \App\Models\Product::with(['images' => fn ($q) => $q->orderByDesc('is_main')])
        ->whereNotIn('id', $newestProducts->pluck('id'))
        ->inRandomOrder()
        ->limit(10)
        ->get();

    if ($newestProducts->count() < 4) {
        $recommendedProducts = $newestProducts;
    }

    return view('index', compact('newestProducts', 'recommendedProducts'));
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

Route::get('/transport', [CartController::class, 'transport'])->name('transport');
Route::post('/transport', [CartController::class, 'saveTransport'])->name('transport.post');

Route::get('/delivery', [CartController::class, 'delivery'])->name('delivery');
Route::post('/delivery', [CartController::class, 'saveDelivery'])->name('delivery.post');
Route::get('/summary', [CartController::class, 'summary'])->name('summary');
Route::post('/confirmation', [CartController::class, 'confirmOrder'])->name('confirmation.post');

use App\Http\Controllers\AdminProductController;
Route::get('/confirmation', function () {
    if (! session()->pull('order_completed')) {
        return redirect()->route('home');
    }
    $orderId = session()->pull('last_order_id');
    return view('confirmation', compact('orderId'));
})->name('confirmation');

Route::prefix('admin')->group(function () {
    Route::get('/products', function () {
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect()->route('login')->with('error', 'Prístup zamietnutý. Prihláste sa ako administrátor.');
        }
        return app(AdminProductController::class)->index();
    })->name('admin.products');

    Route::get('/form/{id?}', function ($id = null) {
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect()->route('login')->with('error', 'Prístup zamietnutý. Prihláste sa ako administrátor.');
        }
        return app(AdminProductController::class)->form($id);
    })->name('admin.form');

    Route::post('/form/save/{id?}', function (\Illuminate\Http\Request $request, $id = null) {
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect()->route('login')->with('error', 'Prístup zamietnutý. Prihláste sa ako administrátor.');
        }
        return app(AdminProductController::class)->save($request, $id);
    })->name('admin.save');

    Route::post('/products/delete/{id}', function ($id) {
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect()->route('login')->with('error', 'Prístup zamietnutý. Prihláste sa ako administrátor.');
        }
        return app(AdminProductController::class)->delete($id);
    })->name('admin.delete');

    Route::post('/image/delete/{id}', function ($id) {
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect()->route('login')->with('error', 'Prístup zamietnutý. Prihláste sa ako administrátor.');
        }
        return app(AdminProductController::class)->deleteImage($id);
    })->name('admin.image.delete');
});

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
