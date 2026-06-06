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
        // Mengambil pesanan yang sudah dibayar (paid) atau yang sedang dikirim (shipping)
        $orders = Order::with('items.product')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    // 2. Konfirmasi pesanan untuk diproses kirim
    public function shipOrder($id)
    {
        $order = Order::findOrFail($id);
        
        // Ubah status jadi 'shipping' (sedang dikirim)
        $order->update(['status' => 'shipping']);

        return redirect()->back()->with('success', 'Pesanan #' . $id . ' berhasil dikonfirmasi dan sedang dikirim!');
    }

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
        // Validasi input dari admin
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'weight' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'advantages' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
        ]);

        // Proses Upload Gambar
        $imageName = time() . '_' . $request->image->getClientOriginalName();
        // Pindahkan gambar dari memori sementara ke folder public/images/produk
        $request->image->move(public_path('images/produk'), $imageName);

        // Bikin URL ramah (slug) otomatis dari nama produk
        $slug = Str::slug($request->name) . '-' . time();

        // Simpan semua data ke database
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Di sini dibuat nullable (boleh kosong)
        ]);

        $product = Product::findOrFail($id);
        $imageName = $product->image; // Default pakai gambar lama

        // Jika admin mengunggah gambar baru
        if ($request->hasFile('image')) {
            // Hapus fisik gambar lama dari folder public agar tidak menumpuk sampah
            if (file_exists(public_path('images/produk/' . $product->image))) {
                @unlink(public_path('images/produk/' . $product->image));
            }
            
            // Upload gambar baru
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

        // Hapus fisik gambar dari folder public
        if (file_exists(public_path('images/produk/' . $product->image))) {
            @unlink(public_path('images/produk/' . $product->image));
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Produk berhasil dihapus dari katalog.');
    }
    // 10. Nampilin Halaman Kelola Pelanggan
    public function users()
    {
        // Ambil semua user kecuali admin itu sendiri
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

    // 12. Nampilin Halaman Laporan Sementara
    public function reports()
    {
        // Tarik semua laporan refund, diurutkan dari yang paling baru
        $reports = \App\Models\RefundReport::with(['user', 'order'])->orderBy('created_at', 'desc')->get();
        
        return view('admin.reports', compact('reports'));
    }

    public function updateReportStatus(\Illuminate\Http\Request $request, $id)
    {
        $report = \App\Models\RefundReport::findOrFail($id);

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
}