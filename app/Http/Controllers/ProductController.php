<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product; // Jalur buat manggil gudang data produk
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = [];
        if (Auth::check()) {
            // Mengambil array berupa [product_id => quantity] milik user yang sedang login
            $cartItems = \App\Models\Cart::where('user_id', Auth::id())->pluck('quantity', 'product_id')->toArray();
        }
        // 1. Mulai query produk DAN hitung rata-rata rating dari tabel reviews
        // Ini bikin Laravel otomatis nambahin data 'reviews_avg_rating' secara virtual
        $query = Product::withAvg('reviews', 'rating');

        // 2. Logika Pencarian (Search)
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 3. Logika Kategori 
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // 4. LOGIKA SORTIR
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'harga_terendah':
                    $query->orderBy('price', 'asc');
                    break;
                case 'harga_tertinggi':
                    $query->orderBy('price', 'desc');
                    break;
                case 'terlaris':
                    $query->orderBy('sold', 'desc'); 
                    break;
                case 'rating_terbaik': // <--- TAMBAHAN BARU
                    // Urutkan berdasarkan nilai rata-rata rating tertinggi
                    $query->orderBy('reviews_avg_rating', 'desc');
                    break;
                case 'terbaru':
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            // Default: Tampilkan produk paling baru ditambah
            $query->orderBy('created_at', 'desc');
        }

        // Eksekusi query
        $products = $query->get();
        // $products = $query->paginate(8); 
        
        return view('products.index', compact('products', 'cartItems'));
    }

    // Tambahin fungsi ini buat nampilin Halaman Detail Produk
    public function show($slug)
    {
        // 1. Cari produk berdasarkan slug-nya
        $product = Product::where('slug', $slug)->firstOrFail();

        // 2. Hitung Rata-rata Rating (Biar $averageRating di baris 38 ngga error)
        // Kalau belum ada review, kita kasih default 5.0
        $averageRating = $product->reviews()->avg('rating') ?? 5.0;
        $averageRating = number_format($averageRating, 1);

        // 3. Ambil total terjual (Biar $totalSold di baris 45 ngga error)
        // pakai kolom 'sold' yang udah ditambahin di database tadi
        $totalSold = $product->sold;

        // 4. Lempar SEMUA variabelnya ke halaman show.blade.php
        return view('products.show', compact('product', 'averageRating', 'totalSold'));
    }


}