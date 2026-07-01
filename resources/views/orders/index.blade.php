<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pesanan Saya</h2>
    </x-slot>

    <style>
        @keyframes trukJalan {
            0% { right: -20px; opacity: 0; }
            15% { opacity: 1; }
            85% { opacity: 1; }
            100% { right: 100%; opacity: 0; }
        }
        .animasi-truk {
            position: absolute;
            animation: trukJalan 4s infinite linear;
            right: -20px; /* Standby di kanan layar */
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-[#476024] px-4 py-3 rounded-xl shadow-sm flex items-center gap-3">
                    <span class="text-lg"></span>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                
                <div class="md:col-span-1">
                    <div class="bg-white shadow-sm sm:rounded-xl overflow-hidden sticky top-6 border border-gray-100">
                        <div class="p-4 bg-gray-50 border-b border-gray-100">
                            <p class="text-sm font-bold text-gray-600 uppercase tracking-wider">Menu Navigasi</p>
                        </div>
                        <div class="flex flex-col divide-y divide-gray-50">

                            <a href="{{ route('profile.edit') }}" class="px-5 py-4 border-l-4 transition flex items-center space-x-3 {{ request()->routeIs('profile.edit') ? 'border-[#476024] bg-green-50 text-[#476024] font-bold' : 'border-transparent text-gray-600 font-medium hover:bg-gray-50 hover:border-gray-300' }}">
                                <span>Detail Profil</span>
                            </a>

                            <a href="{{ route('cart.index') }}" class="px-5 py-4 border-l-4 transition flex items-center space-x-3 {{ request()->routeIs('cart.index') ? 'border-[#476024] bg-green-50 text-[#476024] font-bold' : 'border-transparent text-gray-600 font-medium hover:bg-gray-50 hover:border-gray-300' }}">
                                <span>Keranjang Saya</span>
                            </a>

                            <a href="{{ route('orders.index') }}" class="px-5 py-4 border-l-4 transition flex items-center space-x-3 {{ request()->routeIs('orders.*') ? 'border-[#476024] bg-green-50 text-[#476024] font-bold' : 'border-transparent text-gray-600 font-medium hover:bg-gray-50 hover:border-gray-300' }}">
                                <span>Pesanan Saya</span>
                            </a>

                            <a href="{{ route('wishlist.index') }}" class="px-5 py-4 border-l-4 transition flex items-center space-x-3 {{ request()->routeIs('wishlist.index') ? 'border-[#476024] bg-green-50 text-[#476024] font-bold' : 'border-transparent text-gray-600 font-medium hover:bg-gray-50 hover:border-gray-300' }}">
                                <span>Wishlist Saya</span>
                            </a>

                            <a href="/produk" class="px-5 py-4 border-l-4 border-transparent text-gray-600 font-medium hover:bg-gray-50 hover:text-[#476024] transition flex items-center space-x-3">
                                <span>Kembali ke katalog</span>
                            </a>

                        </div>
                    </div>
                </div>

                <div class="md:col-span-3 flex flex-col gap-4">
                    @forelse($orders as $order)
                        <div class="bg-white p-6 shadow-sm rounded-xl border border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 hover:shadow-md transition-shadow duration-300">
                            
                            <div class="flex flex-col min-w-[200px]">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-sm font-bold text-gray-800 uppercase tracking-wider">#TEST26-{{ $order->id }}</span>
                                    
                                    <span class="px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider rounded-md
                                        {{ $order->status == 'unpaid' ? 'bg-red-50 text-red-600 border border-red-100' : '' }}
                                        {{ $order->status == 'paid' ? 'bg-blue-50 text-blue-600 border border-blue-100' : '' }}
                                        {{ $order->status == 'shipping' ? 'bg-purple-50 text-purple-600 border border-purple-100' : '' }}
                                        {{ $order->status == 'completed' ? 'bg-green-50 text-[#476024] border border-green-200' : '' }}
                                        {{ $order->status == 'cancel_processing' ? 'bg-orange-50 text-orange-600 border border-orange-100' : '' }}
                                        {{ $order->status == 'cancelled' ? 'bg-gray-100 text-gray-500 border border-gray-200' : '' }}">
                                        
                                        @if($order->status == 'unpaid')
                                            Belum Bayar
                                        @elseif($order->status == 'paid')
                                            Terbayar
                                        @elseif($order->status == 'shipping')
                                            Dikirim
                                        @elseif($order->status == 'completed')
                                            Selesai
                                        @elseif($order->status == 'cancel_processing')
                                            Proses Pembatalan
                                        @elseif($order->status == 'cancelled')
                                            Dibatalkan
                                        @else
                                            {{ $order->status }}
                                        @endif

                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 mb-4">{{ $order->created_at->format('d F Y, H:i') }} WIB</p>
                                
                                <div>
                                    <p class="text-xs text-gray-400 mb-0.5">Total Belanja</p>
                                    <h3 class="text-xl font-black text-gray-800">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h3>
                                </div>
                            </div>

                            <div class="flex-1 w-full flex justify-center items-center py-4 md:py-0">
                                @if($order->status == 'shipping')
                                    <div class="flex flex-col items-center w-full max-w-[220px]">
                                        <span class="text-[11px] font-bold text-purple-600 mb-1 uppercase tracking-wider">Barang Sedang di Jalan</span>
                                        <div class="w-full relative h-8 border-b-2 border-dashed border-purple-200 overflow-hidden">
                                            <div class="animasi-truk bottom-0 text-2xl">
                                                🚚
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="flex flex-col w-full md:w-auto gap-3 min-w-[180px]">
                                
                                @if($order->status == 'unpaid')
                                    <a href="{{ route('orders.payment', $order->id) }}" class="w-full text-center px-5 py-2.5 text-sm font-bold text-white bg-[#476024] rounded-lg hover:bg-[#364a1b] transition shadow-sm border border-[#476024]">
                                        Bayar Sekarang
                                    </a>
                                @endif

                                @if($order->status == 'shipping')
                                    <form action="{{ route('orders.complete', $order->id) }}" method="POST" class="w-full">
                                        @csrf
                                        <button type="submit" onclick="return confirm('Pastikan pesanan Anda sudah diterima dengan baik.')" class="w-full bg-[#476024] text-white px-5 py-2.5 rounded-lg text-sm font-bold hover:bg-[#364a1b] transition shadow-sm border border-[#476024] flex justify-center items-center gap-2">
                                            <span>Pesanan Diterima</span>
                                        </button>
                                    </form>
                                @endif
                                
                                <a href="{{ route('orders.show', $order->id) }}" class="w-full text-center px-5 py-2.5 text-sm font-bold text-[#476024] bg-green-50 rounded-lg hover:bg-[#476024] hover:text-white transition border border-transparent">
                                    Lihat Detail Struk
                                </a>
                                
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-12 text-center rounded-xl border border-gray-100 flex flex-col items-center justify-center">
                            <img src="{{ asset('images/icons/receipt.png') }}" alt="Wishlist Kosong" class="w-20 h-20 mx-auto mb-4 object-contain">
                            <p class="text-gray-500 font-medium">Anda belum memiliki riwayat pesanan.</p>
                            <a href="/produk" class="mt-4 text-[#476024] font-bold hover:underline">Mulai Belanja</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>