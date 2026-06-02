<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    // Tampilkan halaman Wishlist
    public function index()
    {
        $wishlist = session()->get('wishlist', []);
        return view('wishlist.index', compact('wishlist'));
    }

    // Fungsi Toggle (Tambah/Hapus Wishlist)
    public function toggle($id)
    {
        $product = Product::findOrFail($id);
        $wishlist = session()->get('wishlist', []);

        if(isset($wishlist[$id])) {
            // Kalau udah ada di wishlist, hapus!
            unset($wishlist[$id]);
            $message = 'Produk dihapus dari Wishlist!';
        } else {
            // Kalau belum ada, masukkan!
            $wishlist[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image,
                "category" => $product->category,
                "slug" => $product->slug
            ];
            $message = 'Produk berhasil disimpan ke Wishlist!';
        }

        session()->put('wishlist', $wishlist);
        return redirect()->back()->with('success', $message);
    }
}