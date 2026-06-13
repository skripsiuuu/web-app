<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // 1. Tampilkan semua pesanan masuk di panel admin
    public function orders()
    {
        // Menampilkan pesanan yang lunas (paid), dikirim (shipping), minta batal (cancel_processing), atau udah batal (cancelled)
        $orders = Order::with('items.product')
            ->whereIn('status', ['paid', 'shipping', 'cancel_processing', 'cancelled', 'completed'])
            ->latest()
            ->get();
            
        return view('admin.orders', compact('orders'));
    }

    // 2. Konfirmasi pesanan untuk diproses kirim
    public function shipOrder($id)
    {
        $order = Order::findOrFail($id);
        
        // Ubah status jadi 'shipping' (sedang dikirim)
        $order->update(['status' => 'shipping']);

        return redirect()->back()->with('success', 'Pesanan #INV26-' . $id . ' berhasil dikonfirmasi dan sedang dikirim!');
    }

    // =======================================================
    // FITUR BARU: KONFIRMASI PENGEMBALIAN DANA PEMBATALAN
    // =======================================================
    public function confirmRefundCancel($id)
    {
        // Hanya cari pesanan yang statusnya sedang 'cancel_processing'
        $order = Order::where('status', 'cancel_processing')->findOrFail($id);
        
        // Ubah status jadi batal resmi
        $order->update(['status' => 'cancelled']);

        // Kembalikan stok barang ke etalase
        foreach ($order->items as $item) {
            if ($item->product) {
                $item->product->increment('stock', $item->quantity);
                
                // (Opsional) Kurangin angka terjual (sold) karena barangnya batal dibeli
                if ($item->product->sold >= $item->quantity) {
                    $item->product->decrement('sold', $item->quantity);
                }
            }
        }

        return redirect()->back()->with('success', 'Dana telah dikonfirmasi kembali dan pesanan resmi dibatalkan.');
    }
    // =======================================================

    // 3. Tampilkan daftar produk untuk kelola stok
    public function products()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    // 4. Proses update stok produk
    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|integer|min:0'
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'stock' => $request->stock
        ]);

        return redirect()->back()->with('success', 'Stok produk ' . $product->name . ' berhasil diperbarui!');
    }

    // 5. Tampilkan form tambah produk baru
    public function createProduct()
    {
        return view('admin.create_product');
    }

    // 6. Proses simpan produk dan upload gambar
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'weight' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'advantages' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ]);

        $imageName = time() . '_' . $request->image->getClientOriginalName();
        $request->image->move(public_path('images/produk'), $imageName);

        $slug = Str::slug($request->name) . '-' . time();

        Product::create([
            'name' => $request->name,
            'slug' => $slug,
            'category' => $request->category,
            'price' => $request->price,
            'weight' => $request->weight,
            'stock' => $request->stock,
            'description' => $request->description,
            'advantages' => $request->advantages,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.products')->with('success', 'Mantap! Produk baru berhasil ditambahkan ke katalog.');
    }

    // 7. Tampilkan form edit produk
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    }

    // 8. Proses memperbarui data produk
    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'weight' => 'required|string|max:255',
            'description' => 'required|string',
            'advantages' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ]);

        $product = Product::findOrFail($id);
        $imageName = $product->image; 

        if ($request->hasFile('image')) {
            if (file_exists(public_path('images/produk/' . $product->image))) {
                @unlink(public_path('images/produk/' . $product->image));
            }
            
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images/produk'), $imageName);
        }

        $slug = Str::slug($request->name) . '-' . time();

        $product->update([
            'name' => $request->name,
            'slug' => $slug,
            'category' => $request->category,
            'price' => $request->price,
            'weight' => $request->weight,
            'description' => $request->description,
            'advantages' => $request->advantages,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.products')->with('success', 'Data produk berhasil diperbarui.');
    }

    // 9. Proses menghapus produk
    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);

        if (file_exists(public_path('images/produk/' . $product->image))) {
            @unlink(public_path('images/produk/' . $product->image));
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Produk berhasil dihapus dari katalog.');
    }

    // 10. Nampilin Halaman Kelola Pelanggan
    public function users()
    {
        $users = \App\Models\User::where('role', '!=', 'admin')->orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    // 11. Fungsi Hapus User
    public function deleteUser($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();
        
        return redirect()->back()->with('success', 'User berhasil dihapus dari sistem!');
    }

    // 12. halaman tinjauan perilaku pengguna
    public function userBehavior($id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        $reviews = \App\Models\Review::with('product')
            ->whereHas('order', function ($query) use ($id) {
                $query->where('user_id', $id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.user-behavior', compact('user', 'reviews'));
    }

    // 13. Nampilin Halaman Laporan Sementara
    public function reports()
    {
        $reports = \App\Models\RefundReport::with(['user', 'order'])->orderBy('created_at', 'desc')->get();
        return view('admin.reports', compact('reports'));
    }

    public function updateReportStatus(\Illuminate\Http\Request $request, $id)
    {
        $report = \App\Models\RefundReport::findOrFail($id);
        
        if ($report->status !== 'pending') {
            return redirect()->back()->with('error', 'Laporan ini sudah dievaluasi dan tidak dapat diubah kembali.');
        }

        $request->validate([
            'status' => 'required|in:pending,approved,rejected,revisi',
            'admin_feedback' => 'nullable|string'
        ]);

        $report->update([
            'status' => $request->status,
            'admin_feedback' => $request->admin_feedback
        ]);

        return redirect()->back()->with('success', 'Status laporan dan umpan balik berhasil diperbarui.');
    }

    public function deleteReview($id)
    {
        $review = \App\Models\Review::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Ulasan tersebut berhasil dihapus dari sistem secara permanen.');
    }
}