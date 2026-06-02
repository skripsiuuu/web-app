<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process()
    {
        $cart = session()->get('cart');

        if (!$cart || count($cart) == 0) {
            return redirect()->back()->with('error', 'Keranjang Anda masih kosong');
        }

        $totalPrice = 0;
        foreach ($cart as $id => $details) {
            $totalPrice += $details['price'] * $details['quantity'];
        }

        // Ambil data user yang lagi login buat ngisi alamat
        $user = Auth::user();

        // --- SATPAM VALIDASI ---
        // Cek apakah nomor telepon, alamat, atau kode pos masih kosong
        // Note: Sesuaikan 'kode_pos' dengan nama kolom di tabel users lu (misal: postal_code atau kodepos)
        if (empty($user->phone) || empty($user->address) || empty($user->postal_code)) {
            // Tolak dan kembalikan ke halaman sebelumnya bawa pesan error
            return redirect()->back()->with('error', 'Checkout Gagal! Silakan lengkapi data profil Anda pada halaman Detail Profil terlebih dahulu!');
        }
        // -----------------------

        // 1. Simpan order beserta detail pengiriman
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $totalPrice,
            'status' => 'unpaid',
            
            // --- TAMBAHAN DATA ALAMAT PENGIRIMAN ---
            'recipient_name' => $user->name,
            
            // Karena udah divalidasi di atas, kita kaga butuh lagi tanda ?? '-'
            'phone_number' => $user->phone, 
            
            // Sekalian kita gabungin alamat sama kode pos biar admin gampang bacanya
            'shipping_address' => $user->address . ', Kode Pos: ' . $user->postal_code, 
        ]);

        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);

            $product = Product::find($id);
            if ($product) {
                // Ngurangin stok barang
                $product->decrement('stock', $details['quantity']);
                
                // Nambahin angka terjual
                $product->increment('sold', $details['quantity']);
            }
        }

        // Kosongkan keranjang setelah berhasil dibeli
        session()->forget('cart');

        // 2. Arahkan langsung ke halaman pembayaran!
        return redirect()->route('orders.payment', $order->id);
    }
}