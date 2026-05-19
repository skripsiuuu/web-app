<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController; // Sesuaikan dengan nama controller Anda

// Route untuk menampilkan halaman edit profil
Route::get('/profile/edit', function () {
    return view('profile.edit'); // Sesuaikan dengan folder tempat Anda menyimpan file blade tadi
})->name('profile.edit');

// Route untuk memproses update data (opsional, jika backend-nya sudah siap)
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

//bawaan
Route::get('/', function () {
    return view('welcome');
});

// Halaman Tentang Kami (Utama)
Route::get('/', function () {
    return view('about');
});

// Halaman Katalog Produk
Route::get('/produk', function () {
    return view('products.index');
});

// Route Kosong untuk halaman lainnya (Bisa kamu buat filenya nanti)
Route::get('/informasi', function () {
    return view('info');
    // return "Halaman Informasi Menarik sedang dikembangkan.";
});
// Route untuk Sub-Halaman Informasi Menarik
Route::get('/informasi-menarik/gaya-hidup-sehat', function () {
    return view('informasi.gaya-hidup');
})->name('informasi.gaya-hidup');

Route::get('/informasi-menarik/resep-inovatif', function () {
    return view('informasi.resep');
})->name('informasi.resep');

Route::get('/informasi-menarik/gizi-nutrisi', function () {
    return view('informasi.gizi');
})->name('informasi.gizi');


// Route::get('/distribusi', function () {
//     // return view('');
//     // return "Halaman Distribusi Kami sedang dikembangkan.";
// });

Route::get('/distribusi-kami', function () {
    return view('distkami');
})->name('distribusi.index');