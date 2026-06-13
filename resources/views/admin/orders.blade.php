<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel Admin: Pesanan Masuk</h2>
            <div class="space-x-4">
                <a href="{{ route('admin.orders') }}" class="text-sm font-bold text-green-700 underline">Kelola Pesanan</a>
                <a href="{{ route('admin.products') }}" class="text-sm font-medium text-gray-500 hover:text-green-700">Kelola Stok</a>
                <a href="{{ route('admin.users') }}" class="text-sm font-medium text-gray-500 hover:text-green-700">Kelola Pelanggan</a>
                <a href="{{ route('admin.reports') }}" class="text-sm font-medium text-gray-500 hover:text-green-700">Kelola Laporan</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow sm:rounded-xl border border-gray-100 p-6 space-y-6">
                <h3 class="text-lg font-bold text-gray-800 border-b pb-3">Daftar Transaksi Masuk</h3>
                
                @foreach($orders as $order)
                    <div class="p-6 border border-gray-200 rounded-xl bg-gray-50/50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div class="space-y-1 w-full md:w-2/3">
                            <div class="flex items-center space-x-3">
                                <span class="text-sm font-bold text-gray-700">#INV26-{{ $order->id }}</span>
                                    <span class="px-2.5 py-0.5 text-xs font-bold rounded-full 
                                        {{ $order->status == 'unpaid' ? 'bg-gray-200 text-gray-700' : '' }}
                                        {{ $order->status == 'paid' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $order->status == 'shipping' ? 'bg-purple-100 text-purple-700' : '' }}
                                        {{ $order->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $order->status == 'cancel_processing' ? 'bg-orange-100 text-orange-700' : '' }}
                                        {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                        
                                        @if($order->status == 'unpaid')
                                            BELUM BAYAR
                                        @elseif($order->status == 'paid')
                                            TERBAYAR
                                        @elseif($order->status == 'shipping')
                                            DIKIRIM
                                        @elseif($order->status == 'completed')
                                            SELESAI
                                        @elseif($order->status == 'cancel_processing')
                                            PROSES PEMBATALAN
                                        @elseif($order->status == 'cancelled')
                                            DIBATALKAN
                                        @else
                                            {{ strtoupper($order->status) }}
                                        @endif
                                    </span>
                            </div>
                            <p class="text-xs text-gray-400">Waktu: {{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                            
                            <div class="pt-2 text-sm text-gray-600">
                                <strong>Rincian Item:</strong>
                                <ul class="list-disc list-inside text-xs mt-1 mb-3 text-gray-500">
                                    @foreach($order->items as $item)
                                        <li>{{ $item->product->name }} ({{ $item->quantity }} pcs)</li>
                                    @endforeach
                                </ul>

                                <strong>Informasi Pembeli:</strong>
                                <div class="text-xs text-gray-500 mt-1 bg-white p-3 rounded-lg border border-gray-100 shadow-sm">
                                    <p class="mb-1"><strong>Nama:</strong> {{ $order->recipient_name }}</p>
                                    <p class="mb-1"><strong>No. Telp:</strong> {{ $order->phone_number }}</p>
                                    <p><strong>Alamat:</strong> {{ $order->shipping_address }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-right w-full md:w-1/3 flex flex-col items-end border-t md:border-t-0 md:border-l border-gray-200 pt-4 md:pt-0 md:pl-4">
                            <span class="text-lg font-black text-gray-800 block mb-3">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            
                            @if($order->status == 'paid')
                                <form action="{{ route('admin.ship', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-blue-700 transition shadow-md w-full">
                                        Proses & Kirim Barang
                                    </button>
                                </form>
                                
                            @elseif($order->status == 'shipping')
                                <span class="text-xs font-medium text-purple-600 bg-purple-50 px-3 py-1.5 rounded-lg border border-purple-200 block text-center">Barang Sedang di Jalan</span>
                                
                            @elseif($order->status == 'cancel_processing')
                                <div class="w-full bg-orange-50 border border-orange-200 rounded-lg p-3 text-left mb-3 shadow-sm">
                                    <p class="text-xs font-bold text-orange-800 mb-1">Alasan Pembatalan:</p>
                                    <p class="text-xs text-orange-700 italic">"{{ $order->cancel_reason }}"</p>
                                </div>

                                <form action="{{ route('admin.orders.refund', $order->id) }}" method="POST" onsubmit="return confirm('PENTING: Pastikan dana sebesar Rp {{ number_format($order->total_price, 0, ',', '.') }} sudah dikembalikan ke pelanggan. Lanjutkan pembatalan?');" class="w-full">
                                    @csrf
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-red-700 transition shadow-md w-full">
                                        Dana Sudah Dikembalikan (Konfirmasi Batal)
                                    </button>
                                </form>
                                
                            @elseif($order->status == 'cancelled')
                                <span class="text-xs font-medium text-red-600 bg-red-50 px-3 py-1.5 rounded-lg border border-red-200 block text-center w-full">Pesanan Selesai Dibatalkan</span>
                            @endif
                            
                        </div>
                    </div>
                @endforeach
                
                @if($orders->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        Belum ada transaksi masuk.
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>