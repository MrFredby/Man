<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerGroupController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\InventoryController;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Rutas del Back Office (Admin)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('customer-groups', CustomerGroupController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('discounts', DiscountController::class);
    Route::resource('warehouses', WarehouseController::class);
    Route::resource('inventory', InventoryController::class);
    Route::get('reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports');
});

// Rutas del Front Office (Tienda pública)
Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/', [App\Http\Controllers\Shop\HomeController::class, 'index'])->name('home');

    Route::get('/productos', [App\Http\Controllers\Shop\ProductController::class, 'index'])->name('products.index');
    Route::get('/productos/{slug}', [App\Http\Controllers\Shop\ProductController::class, 'show'])->name('products.show');

    Route::get('/carrito', [App\Http\Controllers\Shop\CartController::class, 'index'])->name('cart.index');
    Route::post('/carrito/agregar', [App\Http\Controllers\Shop\CartController::class, 'add'])->name('cart.add');
    Route::post('/carrito/actualizar', [App\Http\Controllers\Shop\CartController::class, 'update'])->name('cart.update');
    Route::post('/carrito/eliminar', [App\Http\Controllers\Shop\CartController::class, 'remove'])->name('cart.remove');

    Route::post('/cupones/aplicar', [App\Http\Controllers\Shop\CartController::class, 'applyCoupon'])->name('coupon.apply');
    Route::post('/cupones/eliminar', [App\Http\Controllers\Shop\CartController::class, 'removeCoupon'])->name('coupon.remove');

    Route::get('/login', [App\Http\Controllers\Shop\AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Shop\AuthController::class, 'login'])->name('login.post');
    Route::get('/registro', [App\Http\Controllers\Shop\AuthController::class, 'registerForm'])->name('register');
    Route::post('/registro', [App\Http\Controllers\Shop\AuthController::class, 'register'])->name('register.post');
    Route::post('/logout', [App\Http\Controllers\Shop\AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth.customer')->group(function () {
        Route::get('/checkout', [App\Http\Controllers\Shop\CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout', [App\Http\Controllers\Shop\CheckoutController::class, 'store'])->name('checkout.store');
        Route::get('/pedidos', [App\Http\Controllers\Shop\OrderController::class, 'index'])->name('orders.index');
        Route::get('/pedidos/{order}', [App\Http\Controllers\Shop\OrderController::class, 'show'])->name('orders.show');
        Route::get('/perfil', [App\Http\Controllers\Shop\ProfileController::class, 'index'])->name('profile');
        Route::put('/perfil', [App\Http\Controllers\Shop\ProfileController::class, 'update'])->name('profile.update');
    });
});