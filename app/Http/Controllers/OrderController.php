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

    // 2. Nampilin detail satu struk belanja (Invoice) + AUTO CEK STATUS MIDTRANS
    public function show($id)
    {
        $order = Order::with('items.product')->where('user_id', Auth::id())->findOrFail($id);

        // --- JURUS BYPASS: LARAVEL NANYA LANGSUNG KE MIDTRANS ---
        if ($order->status == 'unpaid' && $order->snap_token) {
            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);

            try {
                // Tarik status terbaru langsung dari API Midtrans
                $status = \Midtrans\Transaction::status($order->id);

                // Ubah status di database sesuai jawaban Midtrans
                if ($status->transaction_status == 'settlement' || $status->transaction_status == 'capture') {
                    $order->update(['status' => 'paid']);
                } elseif (in_array($status->transaction_status, ['deny', 'expire', 'cancel'])) {
                    $order->update(['status' => 'cancelled']);
                    // Kembalikan stok produk jika transaksi gagal/batal
                    foreach ($order->items as $item) {
                        if ($item->product) {
                            $item->product->increment('stock', $item->quantity);
                        }
                    }
                }
            } catch (\Exception $e) {
                // Abaikan saja kalau transaksinya belum terdaftar/dibuat di Midtrans
            }
        }
        // --------------------------------------------------------

        return view('orders.show', compact('order'));
    }

    // 3. Nampilin Halaman Dummy Pembayaran (Midtrans)
    public function payment($id)
    {
        $order = \App\Models\Order::where('user_id', \Illuminate\Support\Facades\Auth::id())->findOrFail($id);

        if (!$order->snap_token) {
            
            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    // PENTING: Gunakan ID asli tanpa ada tambahan time() di belakangnya
                    'order_id' => $order->id, 
                    'gross_amount' => $order->total_price,
                ],
                'customer_details' => [
                    'first_name' => $order->recipient_name,
                    'email' => \Illuminate\Support\Facades\Auth::user()->email,
                    'phone' => $order->phone_number,
                    'shipping_address' => [
                        'first_name' => $order->recipient_name,
                        'address' => $order->shipping_address,
                    ]
                ]
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $order->update(['snap_token' => $snapToken]);
        }

        return view('orders.payment', compact('order'));
    }
    
    // 4. Proses Tombol "Bayar Sekarang" (Bila dibutuhkan manual)
    public function pay($id)
    {
        $order = Order::where('user_id', Auth::id())->where('status', 'unpaid')->findOrFail($id);
        $order->update(['status' => 'paid']);
        return redirect()->route('orders.index')->with('success', 'Pembayaran Berhasil! Pesanan Anda akan dikonfirmasi oleh Admin.');
    }

    // 5. Proses Tombol "Pesanan Diterima" oleh Pembeli
    public function completeOrder($id)
    {
        $order = Order::where('user_id', Auth::id())->where('status', 'shipping')->findOrFail($id);
        $order->update(['status' => 'completed']);
        return redirect()->back()->with('success', 'Mantap! Pesanan Anda sudah selesai. Yuk, kasih rating dan ulasan produk kami!');
    }

    public function refundForm($id)
    {
        $order = \App\Models\Order::findOrFail($id);

        if ($order->user_id !== auth()->id()) {
            abort(403, 'Akses tidak diizinkan.');
        }
        if ($order->status !== 'completed') {
            return redirect()->route('orders.show', $order->id)->with('error', 'Pengajuan pengembalian dana hanya berlaku untuk pesanan yang telah selesai.');
        }

        return view('orders.refund', compact('order'));
    }

    public function processRefund(\Illuminate\Http\Request $request, $id)
    {
        $order = \App\Models\Order::findOrFail($id);

        if ($order->user_id !== auth()->id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $request->validate([
            'description' => 'required|string|min:10',
            'proof_image' => 'required|image|mimes:jpeg,png,jpg|max:2048', 
        ], [
            'description.required' => 'Penjelasan keluhan wajib diisi.',
            'description.min' => 'Penjelasan harus terdiri dari minimal 10 karakter.',
            'proof_image.required' => 'Bukti foto wajib diunggah.',
            'proof_image.image' => 'Berkas harus berupa gambar.',
            'proof_image.max' => 'Ukuran foto maksimal adalah 2MB.',
        ]);

        $imagePath = $request->file('proof_image')->store('refunds', 'public');

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

    // Fungsi callback tetap dibiarkan jaga-jaga kalau suatu saat web lu pindah ke hosting berbayar
    public function callback(\Illuminate\Http\Request $request)
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');

        try {
            $notif = new \Midtrans\Notification();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Notifikasi tidak valid'], 400);
        }

        $transactionStatus = $notif->transaction_status;
        $orderIdWithTime = $notif->order_id; 
        
        $orderId = explode('-', $orderIdWithTime)[0];
        $order = \App\Models\Order::find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Data pesanan tidak ditemukan'], 404);
        }

        if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
            $order->update(['status' => 'paid']);
        } elseif ($transactionStatus == 'pending') {
            if (!in_array($order->status, ['paid', 'shipping', 'completed'])) {
                $order->update(['status' => 'unpaid']);
            }
        } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
            if (!in_array($order->status, ['paid', 'shipping', 'completed'])) {
                $order->update(['status' => 'cancelled']);
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

// <!-- 
// namespace App\Http\Controllers;

// use App\Models\Order;
// use App\Models\RefundReport;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class OrderController extends Controller
// {
//     // 1. Nampilin semua daftar pesanan user
//     public function index()
//     {
//         $orders = Order::where('user_id', Auth::id())->latest()->get();
//         return view('orders.index', compact('orders'));
//     }

//     // 2. Nampilin detail satu struk belanja (Invoice)
//     public function show($id)
//     {
//         // Eager loading 'items.product' biar kaga berat pas narik data ayamnya
//         $order = Order::with('items.product')->where('user_id', Auth::id())->findOrFail($id);
//         return view('orders.show', compact('order'));
//     }

//     // 3. Nampilin Halaman Dummy Pembayaran (Midtrans)
//     public function payment($id)
//     {
//         // Cari data order milik user yang sedang login
//         $order = \App\Models\Order::where('user_id', \Illuminate\Support\Facades\Auth::id())->findOrFail($id);

//         // 1. Cek apakah token sudah pernah dibuat sebelumnya di database
//         if (!$order->snap_token) {
            
//             // Konfigurasi Midtrans
//             \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
//             \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
//             \Midtrans\Config::$isSanitized = true;
//             \Midtrans\Config::$is3ds = true;

//             // SOLUSI PERTANYAAN 1: Buat Order ID Unik (Format: ID-Timestamp)
//             $unikOrderId = $order->id . '-' . time();

//             // Parameter wajib Midtrans
//             $params = [
//                 'transaction_details' => [
//                     'order_id' => $unikOrderId, // Gunakan ID Unik di sini
//                     'gross_amount' => $order->total_price,
//                 ],
//                 'customer_details' => [
//                     'first_name' => $order->recipient_name,
//                     // SOLUSI PERTANYAAN 2: Tambahkan baris email ini!
//                     'email' => \Illuminate\Support\Facades\Auth::user()->email,
//                     'phone' => $order->phone_number,
//                     'shipping_address' => [
//                         'first_name' => $order->recipient_name,
//                         'address' => $order->shipping_address,
//                     ]
//                 ]
//             ];

//             // Minta Snap Token ke Midtrans
//             $snapToken = \Midtrans\Snap::getSnapToken($params);

//             // 2. Simpan token yang baru dibuat ke database secara permanen
//             $order->update(['snap_token' => $snapToken]);
//         }

//         // 3. Lempar data order ke view
//         return view('orders.payment', compact('order'));
//     }
    
//     // 4. Proses Tombol "Bayar Sekarang"
//     public function pay($id)
//     {
//         $order = Order::where('user_id', Auth::id())->where('status', 'unpaid')->findOrFail($id);
        
//         // Ubah status pesanan jadi 'paid' (Sudah Dibayar, tunggu admin)
//         $order->update(['status' => 'paid']);

//         return redirect()->route('orders.index')->with('success', 'Pembayaran Berhasil! Pesanan Anda akan dikonfirmasi oleh Admin.');
//     }

//     // 5. Proses Tombol "Pesanan Diterima" oleh Pembeli
//     public function completeOrder($id)
//     {
//         // Pastiin pesanan ini punya user yang lagi login dan statusnya emang lagi dikirim (shipping)
//         $order = Order::where('user_id', Auth::id())->where('status', 'shipping')->findOrFail($id);
        
//         // Ubah status jadi 'completed'
//         $order->update(['status' => 'completed']);

//         return redirect()->back()->with('success', 'Mantap! Pesanan Anda sudah selesai. Yuk, kasih rating dan ulasan produk kami!');
//     }

//     public function refundForm($id)
//     {
//         $order = \App\Models\Order::findOrFail($id);

//         // Memastikan hanya pemilik pesanan yang dapat mengakses halaman ini
//         if ($order->user_id !== auth()->id()) {
//             abort(403, 'Akses tidak diizinkan.');
//         }

//         // Memastikan pengajuan hanya untuk pesanan yang sudah selesai (opsional)
//         if ($order->status !== 'completed') {
//             return redirect()->route('orders.show', $order->id)->with('error', 'Pengajuan pengembalian dana hanya berlaku untuk pesanan yang telah selesai.');
//         }

//         return view('orders.refund', compact('order'));
//     }

//     /**
//      * Memproses data pengajuan refund.
//      */
//     public function processRefund(\Illuminate\Http\Request $request, $id)
//     {
//         $order = \App\Models\Order::findOrFail($id);

//         if ($order->user_id !== auth()->id()) {
//             abort(403, 'Akses tidak diizinkan.');
//         }

//         // Validasi masukan pengguna
//         $request->validate([
//             'description' => 'required|string|min:10',
//             'proof_image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
//         ], [
//             'description.required' => 'Penjelasan keluhan wajib diisi.',
//             'description.min' => 'Penjelasan harus terdiri dari minimal 10 karakter.',
//             'proof_image.required' => 'Bukti foto wajib diunggah.',
//             'proof_image.image' => 'Berkas harus berupa gambar.',
//             'proof_image.max' => 'Ukuran foto maksimal adalah 2MB.',
//         ]);

//         // Menyimpan berkas gambar ke dalam folder storage/app/public/refunds
//         $imagePath = $request->file('proof_image')->store('refunds', 'public');

//         // Menyimpan data laporan ke basis data
//         RefundReport::create([
//             'user_id' => auth()->id(),
//             'order_id' => $order->id,
//             'description' => $request->description,
//             'proof_image' => $imagePath,
//             'status' => 'pending',
//         ]);

//         return redirect()->route('orders.show', $order->id)->with('success', 'Laporan pengajuan pengembalian dana berhasil dikirim. Mohon tunggu konfirmasi dari pihak kami.');
//     }
    
//     public function refundHistory($id)
//     {
//         $order = \App\Models\Order::findOrFail($id);

//         if ($order->user_id !== auth()->id()) {
//             abort(403, 'Akses tidak diizinkan.');
//         }

//         $reports = \App\Models\RefundReport::where('order_id', $order->id)->latest()->get();

//         return view('orders.refund-history', compact('order', 'reports'));
//     }

//     /**
//      * Menangani notifikasi otomatis (Webhook) dari Midtrans.
//      */
//     public function callback(\Illuminate\Http\Request $request)
//     {
//         // Konfigurasi Kunci Midtrans
//         \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
//         \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
//         \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
//         \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');

//         try {
//             // Menangkap notifikasi dari Midtrans
//             $notif = new \Midtrans\Notification();
//         } catch (\Exception $e) {
//             return response()->json(['message' => 'Notifikasi tidak valid'], 400);
//         }

//         $transactionStatus = $notif->transaction_status;
//         $orderIdWithTime = $notif->order_id; // Mengambil kode unik, contoh: "1-1717750000"
        
//         // Sesuai Tahap 4, kita memecah string berdasarkan tanda "-" untuk mengambil ID pesanan asli
//         $orderId = explode('-', $orderIdWithTime)[0];
        
//         // Cari data pesanan di basis data
//         $order = \App\Models\Order::find($orderId);

//         if (!$order) {
//             return response()->json(['message' => 'Data pesanan tidak ditemukan'], 404);
//         }

//         // ... (Kode Midtrans API & pencarian $order di atasnya biarkan sama) ...

//         // Logika Perubahan Status Berdasarkan Respon Midtrans
//         if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
//             // Pembayaran Berhasil (Timpa status jadi paid)
//             $order->update(['status' => 'paid']);
            
//         } elseif ($transactionStatus == 'pending') {
//             // Menunggu Pembayaran
//             // CEGAHAN: Jangan turunkan status jika pesanan sudah lunas/diproses
//             if (!in_array($order->status, ['paid', 'shipping', 'completed'])) {
//                 $order->update(['status' => 'unpaid']);
//             }
            
//         } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
//             // Pembayaran Gagal / Kedaluwarsa / Dibatalkan
//             // CEGAHAN: Abaikan webhook "Batal" jika pesanan aslinya sudah lunas!
//             if (!in_array($order->status, ['paid', 'shipping', 'completed'])) {
//                 $order->update(['status' => 'cancelled']);

//                 // Kembalikan stok produk jika transaksi batal
//                 foreach ($order->items as $item) {
//                     if ($item->product) {
//                         $item->product->increment('stock', $item->quantity);
//                     }
//                 }
//             }
//         }

//         return response()->json(['message' => 'Webhook Midtrans berhasil diproses']);
//     }

// }  -->
