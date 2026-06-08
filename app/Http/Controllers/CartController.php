<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart; // WAJIB TAMBAH INI UNTUK MEMANGGIL TABEL CARTS
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class CartController extends Controller
{
    public function index()
    {
        // Ambil data keranjang dari database berdasarkan user yang sedang login
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        
        // Kirim variabel $cartItems ke view
        return view('cart.index', compact('cartItems'));
    }

    // Fungsi Tambah Barang (Database + Validasi Stok)
    public function add($id)
    {
        // 1. CEK LOGIN: (Sebagai perlindungan ganda selain dari Middleware)
        if (!Auth::check()) {
            session()->put('url.intended', url()->previous());
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mulai berbelanja.');
        }

        $product = Product::findOrFail($id);
        $userId = Auth::id();

        // Cari apakah produk ini sudah ada di keranjang user di database
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $id)->first();
        
        // Cek jumlah barang yang udah ada di keranjang saat ini
        $currentQty = $cartItem ? $cartItem->quantity : 0;

        // VALIDASI STOK: Tolak kalau jumlah di keranjang udah sama/melebihi stok asli
        if ($currentQty >= $product->stock) {
            return redirect()->back()->with('error', 'Maaf, sisa stok ' . $product->name . ' hanya ' . $product->stock . ' pcs');
        }

        if ($cartItem) {
            // Kalau sudah ada, tambahkan kuantitasnya
            $cartItem->increment('quantity');
        } else {
            // Kalau belum ada, buat data baru di tabel carts
            Cart::create([
                'user_id' => $userId,
                'product_id' => $id,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambah!');
    }

    // Fungsi Kurangi Barang Baru (Database)
    public function decrease($id)
    {
        // Cari produk spesifik di keranjang milik user yang sedang login
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                // Kalau jumlah lebih dari 1, kurangi 1
                $cartItem->decrement('quantity');
            } else {
                // Kalau jumlah cuma 1 dan dikurangi, hapus barang dari tabel
                $cartItem->delete();
            }
        }

        return redirect()->back();
    }
}