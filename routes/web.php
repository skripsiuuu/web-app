<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. RUTE PUBLIK (Bebas diakses tanpa login)
|--------------------------------------------------------------------------
*/

// Halaman Utama / Tentang Kami
Route::get('/', function () {
    return view('about');
});
// Rute jembatan buat nyatet halaman terakhir sebelum login
Route::get('/login-kembali', function () {
    // Simpan URL halaman saat ini (katalog/produk) ke memori (session)
    session()->put('url.intended', url()->previous());
    
    // Baru arahin ke halaman login beneran
    return redirect()->route('login');
})->name('login.kembali');

// Halaman Katalog & Detail Produk
Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('products.show');

// ---> RUTE KERANJANG SEKARANG DI SINI (Area Publik) <---
Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::get('/keranjang/tambah/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/keranjang/kurang/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

// Halaman Informasi Menarik & Artikel
Route::get('/informasi', function () {
    return view('info');
})->name('informasi.index');

Route::get('/informasi-menarik/gaya-hidup-sehat', function () {
    return view('informasi.gaya-hidup');
})->name('informasi.gaya-hidup');

Route::get('/informasi-menarik/resep-inovatif', function () {
    return view('informasi.resep');
})->name('informasi.resep');

Route::get('/informasi-menarik/gizi-nutrisi', function () {
    return view('informasi.gizi');
})->name('informasi.gizi');

// Halaman Detail Artikel
Route::get('/informasi/gaya-hidup/manfaat-lari-pagi', function () {
    return view('articles.lifestyle-detail'); 
})->name('informasi.gaya-hidup.detail');

Route::get('/informasi/resep/omurice-khas-jepang', function () {
    return view('articles.recipe-detail'); 
})->name('informasi.resep.detail');

Route::get('/informasi/gizi/mengenal-karbohidrat', function () {
    return view('articles.nutrition-detail'); 
})->name('informasi.gizi.detail');

// Halaman Distribusi
Route::get('/distribusi-kami', function () {
    return view('distkami');
})->name('distribusi.index');


/*
|--------------------------------------------------------------------------
| 2. RUTE PRIVATE (Wajib Login - Disatukan dalam 1 grup)
|--------------------------------------------------------------------------
*/

// Alihkan Dashboard default bawaan Breeze ke halaman Profil
Route::get('/dashboard', function () {
    return redirect()->route('profile.edit');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    
    // Fitur Manajemen Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Fitur Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('/wishlist/toggle/{id}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Fitur Checkout & Pesanan
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{id}/payment', [OrderController::class, 'payment'])->name('orders.payment');
    Route::post('/orders/{id}/pay', [OrderController::class, 'pay'])->name('orders.pay');
    Route::post('/orders/{id}/complete', [OrderController::class, 'completeOrder'])->name('orders.complete');

    // Fitur Ulasan
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // =============================================================
    // KELOMPOK RUTE KHUSUS ADMIN (DIPROTEKSI OLEH SATPAM IS_ADMIN)
    // =============================================================
    Route::middleware(['is_admin'])->group(function () {
        Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
        Route::post('/admin/orders/{id}/ship', [AdminController::class, 'shipOrder'])->name('admin.ship');
        Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
        Route::post('/admin/products/{id}/stock', [AdminController::class, 'updateStock'])->name('admin.update-stock');
        Route::get('/admin/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
        Route::post('/admin/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
        Route::get('/admin/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
        Route::post('/admin/products/{id}/update', [AdminController::class, 'updateProduct'])->name('admin.products.update');
        Route::delete('/admin/products/{id}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');
    });
    
});

// Memuat rute bawaan milik Breeze (Login, Register, Lupa Password, dll)
require __DIR__.'/auth.php';