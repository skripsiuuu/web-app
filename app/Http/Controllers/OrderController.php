<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // 1. Nampilin semua daftar pesanan user
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('orders.index', compact('orders'));
    }

    // 2. Nampilin detail satu struk belanja (Invoice)
    public function show($id)
    {
        // Eager loading 'items.product' biar kaga berat pas narik data ayamnya
        $order = Order::with('items.product')->where('user_id', Auth::id())->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    // 3. Nampilin Halaman Dummy Pembayaran
    public function payment($id)
    {
        // Cari pesanan yang milik user ini dan statusnya masih 'unpaid'
        $order = Order::where('user_id', Auth::id())->where('status', 'unpaid')->findOrFail($id);
        return view('orders.payment', compact('order'));
    }

    // 4. Proses Tombol "Bayar Sekarang"
    public function pay($id)
    {
        $order = Order::where('user_id', Auth::id())->where('status', 'unpaid')->findOrFail($id);
        
        // Ubah status pesanan jadi 'paid' (Sudah Dibayar, tunggu admin)
        $order->update(['status' => 'paid']);

        return redirect()->route('orders.index')->with('success', 'Pembayaran Berhasil! Pesanan Anda akan dikonfirmasi oleh Admin.');
    }

    // 5. Proses Tombol "Pesanan Diterima" oleh Pembeli
    public function completeOrder($id)
    {
        // Pastiin pesanan ini punya user yang lagi login dan statusnya emang lagi dikirim (shipping)
        $order = Order::where('user_id', Auth::id())->where('status', 'shipping')->findOrFail($id);
        
        // Ubah status jadi 'completed'
        $order->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Mantap! Pesanan Anda sudah selesai. Yuk, kasih rating dan ulasan produk kami!');
    }
}