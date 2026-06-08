<?php

use App\Models\Article;
use App\Models\Recipe;
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

// Rute jembatan untuk mencatat halaman terakhir sebelum login
Route::get('/login-kembali', function () {
    // Simpan URL halaman saat ini (katalog/produk) ke memori (session)
    session()->put('url.intended', url()->previous());
    
    // Arahkan ke halaman login
    return redirect()->route('login');
})->name('login.kembali');

// Halaman Katalog & Detail Produk
Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('products.show');

// Halaman Informasi Menarik & Artikel
Route::get('/informasi', function () {
    return view('info');
})->name('informasi.index');

// Rute Halaman Gaya Hidup Sehat
Route::get('/informasi-menarik/gaya-hidup-sehat', function (\Illuminate\Http\Request $request) {
    // Filter kategori yang memiliki unsur kata "Gaya Hidup"
    $query = \App\Models\Article::where('category', 'like', '%Gaya Hidup%');

    if ($request->has('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    $articles = $query->latest()->paginate(9);
    return view('informasi.gaya-hidup', compact('articles'));
})->name('informasi.gaya-hidup');

// Rute Halaman Artikel Gizi & Nutrisi
Route::get('/informasi-menarik/gizi-nutrisi', function (\Illuminate\Http\Request $request) {
    // Filter kategori yang memiliki unsur kata "Gizi & Nutrisi" atau "Olahraga"
    $query = \App\Models\Article::where(function($q) {
        $q->where('category', 'like', '%Gizi & Nutrisi%')
            ->orWhere('category', 'like', '%Olahraga%'); 
    });

    if ($request->has('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    $articles = $query->latest()->paginate(9);
    return view('informasi.gizi', compact('articles'));
})->name('informasi.gizi');

// Rute Halaman Kumpulan Resep
Route::get('/informasi-menarik/kumpulan-resep', function (\Illuminate\Http\Request $request) {
    $query = Recipe::query();

    // Filter Kategori
    if ($request->has('category')) {
        $query->where('category', $request->category);
    }
    // Filter Pencarian
    if ($request->has('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    $recipes = $query->latest()->paginate(9);
    return view('informasi.resep', compact('recipes'));
})->name('informasi.resep');

// Halaman Detail Artikel
// Rute Detail Gizi & Nutrisi
Route::get('/informasi-menarik/gizi-nutrisi/baca/{slug}', function ($slug) {
    $article = \App\Models\Article::where('slug', $slug)->firstOrFail();
    return view('informasi.detail', compact('article')); 
})->name('informasi.gizi.detail');

// Rute Detail Gaya Hidup Sehat
Route::get('/informasi-menarik/gaya-hidup-sehat/baca/{slug}', function ($slug) {
    $article = \App\Models\Article::where('slug', $slug)->firstOrFail();
    return view('informasi.detail', compact('article'));
})->name('informasi.gaya-hidup.detail');

// Rute Halaman Detail Resep
Route::get('/informasi-menarik/kumpulan-resep/{slug}', function ($slug) {
    $recipe = Recipe::where('slug', $slug)->firstOrFail();
    return view('informasi.resep-detail', compact('recipe'));
})->name('informasi.resep.detail');

// Halaman Distribusi
Route::get('/distribusi-kami', function () {
    return view('distkami');
})->name('distribusi.index');


/*
|--------------------------------------------------------------------------
| 2. RUTE PRIVAT (Wajib Login - Disatukan dalam 1 grup)
|--------------------------------------------------------------------------
*/

// Alihkan Dashboard bawaan Breeze ke halaman Profil
Route::get('/dashboard', function () {
    return redirect()->route('profile.edit');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    
    // Fitur Manajemen Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // =============================================================
    // FITUR YANG DIPINDAHKAN DARI AREA PUBLIK (Pencegah Error Name on Null)
    // =============================================================
    // Fitur Keranjang 
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::get('/keranjang/tambah/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/keranjang/kurang/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

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
  
    // Fitur Pengajuan Refund
    Route::get('/orders/{id}/refund', [OrderController::class, 'refundForm'])->name('orders.refund');
    Route::post('/orders/{id}/refund', [OrderController::class, 'processRefund'])->name('orders.refund.store');

    // Fitur Ulasan
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/orders/{id}/refund-history', [OrderController::class, 'refundHistory'])->name('orders.refund.history');

    // =============================================================
    // KELOMPOK RUTE KHUSUS ADMIN
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
        
        // Rute untuk Kelola Pengguna
        Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
        Route::delete('/admin/users/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.users.delete');
        Route::get('/admin/users/{id}/behavior', [App\Http\Controllers\AdminController::class, 'userBehavior'])->name('admin.users.behavior');

        // Rute untuk Kelola Laporan
        Route::get('/admin/reports', [App\Http\Controllers\AdminController::class, 'reports'])->name('admin.reports');
        Route::post('/admin/reports/{id}/update', [AdminController::class, 'updateReportStatus'])->name('admin.reports.update');
        // Rute untuk Menghapus Ulasan
        Route::delete('/admin/reviews/{id}', [App\Http\Controllers\AdminController::class, 'deleteReview'])->name('admin.reviews.delete');
    });
    
});

// Rute untuk menerima notifikasi otomatis dari Midtrans (Wajib di luar Auth agar Midtrans bisa akses)
Route::post('/midtrans/callback', [OrderController::class, 'callback'])->name('midtrans.callback');

// Memuat rute bawaan milik Breeze
require __DIR__.'/auth.php';