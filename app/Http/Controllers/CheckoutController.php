<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Cart; // Tambahkan ini buat manggil tabel Cart
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class CheckoutController extends Controller
{
    public function process()
    {
        // 1. Ambil data keranjang dari DATABASE, bukan session lagi
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        // 2. Cek apakah keranjang kosong
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang Anda masih kosong');
        }

        // 3. Hitung Total Harga dari database
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
        }

        $user = Auth::user();

        // --- SATPAM VALIDASI ALAMAT ---
        if (empty($user->phone) || empty($user->address) || empty($user->postal_code)) {
            return redirect()->back()->with('error', 'Checkout Gagal! Silakan lengkapi data profil Anda pada halaman Detail Profil terlebih dahulu!');
        }

        // ========================================================
        // MULAI SISTEM PENGAMAN TRANSAKSI (PESSIMISTIC LOCKING)
        // ========================================================
        DB::beginTransaction();

        try {
            // 4. Simpan order (Header)
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'status' => 'unpaid',
                'recipient_name' => $user->name,
                'phone_number' => $user->phone, 
                'shipping_address' => $user->address . ', Kode Pos: ' . $user->postal_code, 
            ]);

            // 5. Simpan item dan amankan stok (Detail)
            foreach ($cartItems as $item) {
                
                // MENGUNCI BARIS PRODUK INI DI DATABASE AGAR TIDAK DIGANGGU USER LAIN
                $product = Product::where('id', $item->product_id)->lockForUpdate()->first();

                if (!$product) {
                    throw new Exception("Salah satu produk dalam keranjang tidak ditemukan.");
                }

                // PENGECEKAN FINAL: Apakah stok masih cukup tepat saat detik ini?
                if ($product->stock < $item->quantity) {
                    throw new Exception("Mohon maaf, stok " . $product->name . " tidak mencukupi. Sisa stok saat ini: " . $product->stock);
                }

                // Jika aman, masukkan ke histori Order Item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $product->price, // Ambil harga dari produk langsung
                ]);

                // Ngurangin stok & Nambahin angka terjual
                $product->decrement('stock', $item->quantity);
                $product->increment('sold', $item->quantity);
            }

            // JIKA SEMUA LANCAR, SIMPAN DATA SECARA PERMANEN
            DB::commit();

            // 6. Kosongkan keranjang di DATABASE (Bukan Session lagi)
            Cart::where('user_id', Auth::id())->delete();

            // 7. Arahkan langsung ke halaman pembayaran!
            return redirect()->route('orders.payment', $order->id);

        } catch (Exception $e) {
            // JIKA ADA ERROR (MISAL STOK HABIS), BATALKAN SEMUA PERUBAHAN DATABASE!
            DB::rollBack();

            // Kembalikan user ke halaman keranjang bawa pesan error stoknya
            return redirect()->back()->with('error', 'Checkout Gagal: ' . $e->getMessage());
        }
    }
}