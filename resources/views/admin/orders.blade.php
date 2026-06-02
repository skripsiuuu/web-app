<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel Admin: Pesanan Masuk</h2>
            <div class="space-x-4">
                <a href="{{ route('admin.orders') }}" class="text-sm font-bold text-green-700 underline">Kelola Pesanan</a>
                <a href="{{ route('admin.products') }}" class="text-sm font-medium text-gray-500 hover:text-green-700">Kelola Stok</a>
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
                        <div class="space-y-1">
                            <div class="flex items-center space-x-3">
                                <span class="text-sm font-bold text-gray-700">Invoice: #{{ $order->id }}</span>
                                <span class="px-2.5 py-0.5 text-xs font-bold rounded-full {{ $order->status == 'paid' ? 'bg-blue-100 text-blue-700' : ($order->status == 'shipping' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-700') }}">
                                    {{ strtoupper($order->status) }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-400">Waktu: {{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                            <div class="pt-2 text-sm text-gray-600">
                                <strong>Rincian Item:</strong>
                                <ul class="list-disc list-inside text-xs mt-1 text-gray-500">
                                    @foreach($order->items as $item)
                                        <li>{{ $item->product->name }} ({{ $item->quantity }} pcs)</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="text-right w-full md:w-auto flex flex-col items-end">
                            <span class="text-lg font-black text-gray-800 block mb-3">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            
                            @if($order->status == 'paid')
                                <form action="{{ route('admin.ship', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-blue-700 transition shadow-md">
                                        Proses & Kirim Barang
                                    </button>
                                </form>
                            @elseif($order->status == 'shipping')
                                <span class="text-xs font-medium text-purple-600 bg-purple-50 px-3 py-1.5 rounded-lg border border-purple-200">Barang Sedang di Jalan</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>