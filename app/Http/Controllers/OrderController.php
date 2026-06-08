<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\RefundReport;
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

    // 3. Nampilin Halaman Dummy Pembayaran (Midtrans)
    public function payment($id)
    {
        $order = \App\Models\Order::findOrFail($id);

        // Pastikan pesanan milik user yang sedang login dan statusnya belum dibayar
        if ($order->user_id !== auth()->id() || $order->status !== 'unpaid') {
            abort(403, 'Akses tidak diizinkan atau pesanan sudah dibayar.');
        }

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');

        // Setup parameter yang mau dikirim ke Midtrans
        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id . '-' . time(), // Tambah time() biar unik jika user refresh
                'gross_amount' => $order->total_price,
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => $order->phone_number,
            ),
            
            // --- TAMBAHKAN INI BIAR SINKRON SAMA SCHEDULER ---
            'custom_expiry' => array(
                'start_time' => date("Y-m-d H:i:s O", strtotime($order->created_at)),
                'unit' => 'minute', 
                'duration'  => 30 // Samakan dengan subMinutes(30) di scheduler
            )
        );

        // Generate Snap Token
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('orders.payment', compact('order', 'snapToken'));
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

    public function refundForm($id)
    {
        $order = \App\Models\Order::findOrFail($id);

        // Memastikan hanya pemilik pesanan yang dapat mengakses halaman ini
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        // Memastikan pengajuan hanya untuk pesanan yang sudah selesai (opsional)
        if ($order->status !== 'completed') {
            return redirect()->route('orders.show', $order->id)->with('error', 'Pengajuan pengembalian dana hanya berlaku untuk pesanan yang telah selesai.');
        }

        return view('orders.refund', compact('order'));
    }

    /**
     * Memproses data pengajuan refund.
     */
    public function processRefund(\Illuminate\Http\Request $request, $id)
    {
        $order = \App\Models\Order::findOrFail($id);

        if ($order->user_id !== auth()->id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        // Validasi masukan pengguna
        $request->validate([
            'description' => 'required|string|min:10',
            'proof_image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ], [
            'description.required' => 'Penjelasan keluhan wajib diisi.',
            'description.min' => 'Penjelasan harus terdiri dari minimal 10 karakter.',
            'proof_image.required' => 'Bukti foto wajib diunggah.',
            'proof_image.image' => 'Berkas harus berupa gambar.',
            'proof_image.max' => 'Ukuran foto maksimal adalah 2MB.',
        ]);

        // Menyimpan berkas gambar ke dalam folder storage/app/public/refunds
        $imagePath = $request->file('proof_image')->store('refunds', 'public');

        // Menyimpan data laporan ke basis data
        RefundReport::create([
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'description' => $request->description,
            'proof_image' => $imagePath,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.show', $order->id)->with('success', 'Laporan pengajuan pengembalian dana berhasil dikirim. Mohon tunggu konfirmasi dari pihak kami.');
    }
    
    public function refundHistory($id)
    {
        $order = \App\Models\Order::findOrFail($id);

        if ($order->user_id !== auth()->id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $reports = \App\Models\RefundReport::where('order_id', $order->id)->latest()->get();

        return view('orders.refund-history', compact('order', 'reports'));
    }

    /**
     * Menangani notifikasi otomatis (Webhook) dari Midtrans.
     */
    public function callback(\Illuminate\Http\Request $request)
    {
        // Konfigurasi Kunci Midtrans
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');

        try {
            // Menangkap notifikasi dari Midtrans
            $notif = new \Midtrans\Notification();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Notifikasi tidak valid'], 400);
        }

        $transactionStatus = $notif->transaction_status;
        $orderIdWithTime = $notif->order_id; // Mengambil kode unik, contoh: "1-1717750000"
        
        // Sesuai Tahap 4, kita memecah string berdasarkan tanda "-" untuk mengambil ID pesanan asli
        $orderId = explode('-', $orderIdWithTime)[0];
        
        // Cari data pesanan di basis data
        $order = \App\Models\Order::find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Data pesanan tidak ditemukan'], 404);
        }

        // ... (Kode Midtrans API & pencarian $order di atasnya biarkan sama) ...

        // Logika Perubahan Status Berdasarkan Respon Midtrans
        if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
            // Pembayaran Berhasil (Timpa status jadi paid)
            $order->update(['status' => 'paid']);
            
        } elseif ($transactionStatus == 'pending') {
            // Menunggu Pembayaran
            // CEGAHAN: Jangan turunkan status jika pesanan sudah lunas/diproses
            if (!in_array($order->status, ['paid', 'shipping', 'completed'])) {
                $order->update(['status' => 'unpaid']);
            }
            
        } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
            // Pembayaran Gagal / Kedaluwarsa / Dibatalkan
            // CEGAHAN: Abaikan webhook "Batal" jika pesanan aslinya sudah lunas!
            if (!in_array($order->status, ['paid', 'shipping', 'completed'])) {
                $order->update(['status' => 'cancelled']);

                // Kembalikan stok produk jika transaksi batal
                foreach ($order->items as $item) {
                    if ($item->product) {
                        $item->product->increment('stock', $item->quantity);
                    }
                }
            }
        }

        return response()->json(['message' => 'Webhook Midtrans berhasil diproses']);
    }

}
