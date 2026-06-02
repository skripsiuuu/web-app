<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // WAJIB TAMBAH INI BUAT NGECEK LOGIN

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Fungsi Tambah Barang (Sekarang pakai validasi stok & login)
    public function add($id)
    {
        // 1. CEK LOGIN: Kalau belum login, catat URL produknya lalu lempar ke form login
        if (!Auth::check()) {
            // Simpan link halaman detail produk ke memori
            session()->put('url.intended', url()->previous());
            
            // Arahkan ke halaman login dengan pesan error
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mulai berbelanja.');
        }

        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // Cek jumlah barang yang udah ada di keranjang saat ini
        $currentQty = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;

        // VALIDASI STOK: Tolak kalau jumlah di keranjang udah sama/melebihi stok asli
        if ($currentQty >= $product->stock) {
            return redirect()->back()->with('error', 'Maaf, sisa stok ' . $product->name . ' hanya ' . $product->stock . ' pcs');
        }

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image,
                "category" => $product->category
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk berhasil ditambah!');
    }

    // Fungsi Kurangi Barang Baru
    public function decrease($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            if($cart[$id]['quantity'] > 1) {
                // Kalau jumlah lebih dari 1, kurangi 1
                $cart[$id]['quantity']--;
            } else {
                // Kalau jumlah cuma 1 dan dikurangi, hapus barang dari keranjang
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }
}