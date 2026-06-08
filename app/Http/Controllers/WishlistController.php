<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist; // WAJIB TAMBAH INI BUAT MANGGIL TABEL WISHLISTS
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // WAJIB TAMBAH INI BUAT CEK LOGIN

class WishlistController extends Controller
{
    // Tampilkan halaman Wishlist
    public function index()
    {
        // 1. Ambil data wishlist dari DATABASE, bukan session lagi
        // Perhatikan nama variabelnya: $wishlists (pakai 's')
        $wishlists = Wishlist::with('product')->where('user_id', Auth::id())->get();
        
        return view('wishlist.index', compact('wishlists'));
    }

    // Fungsi Toggle (Tambah/Hapus Wishlist via Database)
    public function toggle($id)
    {
        $product = Product::findOrFail($id);
        $userId = Auth::id();

        // Cari apakah produk ini sudah ada di wishlist user
        $wishlistItem = Wishlist::where('user_id', $userId)->where('product_id', $id)->first();

        if ($wishlistItem) {
            // Kalau udah ada di database, hapus!
            $wishlistItem->delete();
            $message = 'Produk dihapus dari Wishlist!';
        } else {
            // Kalau belum ada, masukkan ke database!
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $id
            ]);
            $message = 'Produk berhasil disimpan ke Wishlist!';
        }

        return redirect()->back()->with('success', $message);
    }
}