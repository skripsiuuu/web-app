<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Struk #{{ $order->id }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-xl overflow-hidden border border-gray-100">
                <div class="p-8 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-black text-darkGreen">MITRA HIDUP SEHAT</h1>
                        <p class="text-sm text-gray-500">Nomor Invoice: <strong>#{{ $order->id }}</strong></p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Tanggal Transaksi:</p>
                        <p class="font-bold text-gray-800">{{ $order->created_at->format('d F Y') }}</p>
                    </div>
                </div>

                <div class="p-8">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-gray-100">
                                <th class="pb-4">Produk</th>
                                <th class="pb-4 text-center">Jumlah</th>
                                <th class="pb-4 text-right">Harga</th>
                                <th class="pb-4 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="py-4 align-top">
                                        <p class="font-bold text-gray-800">{{ $item->product->name }}</p>
                                        <p class="text-xs text-gray-400 mb-3">Kode: PRD-{{ str_pad($item->product_id, 4, '0', STR_PAD_LEFT) }}</p>

                                        @if($order->status == 'completed')
                                            @php
                                                // Cek manual apakah ulasan sudah ada di database
                                                $review = \App\Models\Review::where('order_id', $order->id)
                                                                            ->where('product_id', $item->product_id)
                                                                            ->first();
                                            @endphp

                                            @if($review)
                                                <div class="bg-gray-50 border border-gray-200 p-3 rounded-lg mt-2 w-full max-w-sm">
                                                    <p class="text-xs font-bold text-gray-600 mb-1">Ulasan Anda (Nilai: {{ $review->rating }} / 5)</p>
                                                    <p class="text-sm text-gray-800">"{{ $review->comment }}"</p>
                                                </div>
                                            @else
                                                <div class="bg-green-50/50 border border-green-100 p-4 rounded-lg mt-2 w-full max-w-sm">
                                                    <p class="text-xs font-bold text-[#476024] mb-2">Beri Ulasan Produk Ini</p>
                                                    <form action="{{ route('reviews.store') }}" method="POST" class="space-y-2">
                                                        @csrf
                                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                                        
                                                        <select name="rating" class="w-full text-sm border-gray-300 rounded-lg focus:ring-[#476024] focus:border-[#476024]" required>
                                                            <option value="">-- Pilih Nilai --</option>
                                                            <option value="5">Sangat Bagus (5/5)</option>
                                                            <option value="4">Bagus (4/5)</option>
                                                            <option value="3">Biasa Aja (3/5)</option>
                                                            <option value="2">Kurang (2/5)</option>
                                                            <option value="1">Sangat Kurang (1/5)</option>
                                                        </select>
                                                        
                                                        <textarea name="comment" rows="2" placeholder="Tulis pengalaman Anda..." class="w-full text-sm border-gray-300 rounded-lg focus:ring-[#476024] focus:border-[#476024]" required></textarea>
                                                        
                                                        <button type="submit" class="bg-[#476024] text-white px-4 py-1.5 rounded text-xs font-bold hover:bg-[#364a1b] transition">
                                                            Kirim Ulasan
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="py-4 text-center text-gray-600 align-top">{{ $item->quantity }} pcs</td>
                                    <td class="py-4 text-right text-gray-600 align-top">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="py-4 text-right font-bold text-gray-800 align-top">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-8 bg-gray-50 flex justify-between items-center">
                    <p class="font-bold text-gray-500 uppercase tracking-widest text-sm">Total Pembayaran</p>
                    <h2 class="text-3xl font-black text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h2>
                </div>
            </div>
            
            <div class="mt-6 text-center">
                <a href="{{ route('orders.index') }}" class="text-sm text-gray-500 hover:text-primary font-medium">Kembali ke Riwayat Pesanan</a>
            </div>
        </div>
    </div>
</x-app-layout>