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
    
    // Rute untuk detail pesanan
    Route::get('/pesanan/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Rute untuk checkout keranjang
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

    // Rute untuk mengunggah bukti pembayaran
    Route::post('/orders/{order}/upload-payment-proof', [OrderController::class, 'uploadPaymentProof'])
      ->middleware(['auth']) // Pastikan hanya user yang login bisa akses
      ->name('orders.uploadPaymentProof');

    // Rute untuk halaman layanan
    Route::get('/services/custom-rom', function () {
    return view('services.custom-rom');
    })->name('services.custom-rom');

    Route::get('/services/tweaking-performance', function () {
        return view('services.tweaking-performance');
    })->name('services.tweaking-performance');

    Route::get('/services/root-unlock', function () {
        return view('services.root-unlock');
    })->name('services.root-unlock');

    Route::get('/services/unlock-bootloader', function () {
        return view('services.unlock-bootloader');
    })->name('services.unlock-bootloader');

    Route::get('/services/upgrade-downgrade', function () {
        return view('services.upgrade-downgrade');
    })->name('services.upgrade-downgrade');

    Route::get('/services/consultation-support', function () {
        return view('services.consultation-support');
    })->name('services.consultation-support');
});
require __DIR__.'/auth.php';
