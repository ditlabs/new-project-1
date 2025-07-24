<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.detail');

    // Rute untuk checkout produk
    Route::post('/checkout/now', [OrderController::class, 'checkoutNow'])->name('checkout.now');
    Route::get('/pesanan-saya', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');

    // Rute untuk mengelola produk
    Route::prefix('keranjang')->name('keranjang.')->group(function () {
    Route::get('/items', [CartController::class, 'getItems'])->name('items');
    Route::post('/tambah', [CartController::class, 'addItem'])->name('add');
    Route::get('/jumlah', [CartController::class, 'getTotalItems'])->name('total');
        
    // Rute ini kita siapkan untuk nanti, tidak perlu dibuat fungsinya sekarang
    Route::patch('/update/{cart}', [CartController::class, 'updateItem'])->name('update');
    Route::delete('/hapus/{cart}', [CartController::class, 'removeItem'])->name('remove');
    });

    // Rute untuk checkout keranjang
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});
require __DIR__.'/auth.php';
