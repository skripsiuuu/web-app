<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Cart; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class CheckoutController extends Controller
{
    public function process()
    {
        // 1. Ambil data keranjang dari DATABASE
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        // 2. Cek apakah keranjang kosong
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang Anda masih kosong');
        }

        // 3. HITUNG SUB TOTAL DULU (Taruh di atas biar PHP tau angkanya)
        $sub_total = 0;
        foreach ($cartItems as $item) {
            $sub_total += $item->product->price * $item->quantity;
        }

        // 4. Hitung Total Akhir dengan Ongkir & Admin
        $shipping_cost = 1; // Contoh Ongkir
        $admin_fee = 1;      // Contoh Biaya Admin
        $totalPrice = $sub_total + $shipping_cost + $admin_fee;

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
            // 5. Simpan order (Header) - WAJIB MASUKIN ONGKIR & ADMIN
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'shipping_cost' => $shipping_cost, // <-- Tambahan Wajib
                'admin_fee' => $admin_fee,         // <-- Tambahan Wajib
                'status' => 'unpaid',
                'recipient_name' => $user->name,
                'phone_number' => $user->phone, 
                'shipping_address' => $user->address . ', Kode Pos: ' . $user->postal_code, 
            ]);

            // 6. Simpan item dan amankan stok (Detail)
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
                    'price' => $product->price, 
                ]);

                // Ngurangin stok & Nambahin angka terjual
                $product->decrement('stock', $item->quantity);
                $product->increment('sold', $item->quantity);
            }

            // JIKA SEMUA LANCAR, SIMPAN DATA SECARA PERMANEN
            DB::commit();

            // 7. Kosongkan keranjang di DATABASE
            Cart::where('user_id', Auth::id())->delete();

            // 8. Arahkan langsung ke halaman pembayaran!
            return redirect()->route('orders.payment', $order->id);

        } catch (Exception $e) {
            // JIKA ADA ERROR (MISAL STOK HABIS), BATALKAN SEMUA PERUBAHAN DATABASE!
            DB::rollBack();

            // Kembalikan user ke halaman keranjang bawa pesan error stoknya
            return redirect()->back()->with('error', 'Checkout Gagal: ' . $e->getMessage());
        }
    }
}