@extends('layouts.public')

@section('title', $product->name)

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <a href="/produk" class="text-sm text-gray-500 hover:text-primary flex items-center space-x-1 mb-6 transition">
        <span>Kembali ke Katalog</span>
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 bg-white p-6 md:p-10 rounded-2xl border border-gray-100 shadow-sm">
        
        <div class="rounded-2xl overflow-hidden bg-gray-100 border border-gray-200 h-[500px] w-full shadow-sm">
            <img src="{{ asset('images/produk/' . $product->image) }}" 
                alt="{{ $product->name }}" 
                class="w-full h-full object-cover object-center transition-transform duration-500 hover:scale-105">
        </div>

        <div class="flex flex-col justify-between">
            <div>
                <span class="text-xs font-bold text-primary bg-green-50 px-2.5 py-1 rounded-full uppercase tracking-wider">
                    {{ $product->category }}
                </span>
                
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mt-3 mb-4 leading-tight">
                    {{ $product->name }}
                </h1>

                <div class="flex flex-col gap-2.5 mb-6 text-sm">
                    <div class="text-gray-500">
                        Berat: <span class="text-gray-800 font-bold">{{ $product->weight ?? 'N/A' }}</span>
                    </div>

                    <div class="flex flex-wrap items-center gap-4">
                        
                        <div class="flex items-center gap-1.5">
                            <img src="{{ asset('images/icons/star.png') }}" alt="Star" class="w-4 h-4 object-contain -mt-0.5">
                            <span class="text-gray-800 font-bold">{{ $averageRating }}</span>
                            <span class="text-gray-500">({{ $product->reviews->count() }} Ulasan)</span>
                        </div>

                        <div class="w-px h-4 bg-gray-300"></div>

                        <div class="text-gray-500">
                            Terjual <span class="text-gray-800 font-bold">{{ $totalSold }}</span> pcs
                        </div>

                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl mb-6">
                    <span class="text-2xl font-extrabold text-primary">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                </div>

                @if($product->advantages)
                <div class="mb-6">
                    <h4 class="font-bold text-sm text-gray-800 mb-2"> Keunggulan Produk:</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $product->advantages) as $adv)
                            <span class="text-xs bg-gray-100 text-gray-700 px-3 py-1.5 rounded-lg font-semibold border border-gray-200">
                                {{ trim($adv) }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="border-t border-gray-100 pt-4">
                    <h4 class="font-bold text-sm text-gray-800 mb-2">Deskripsi Produk:</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        {{ $product->description }}
                    </p>
                </div>
            </div>

            <div class="mt-8 pt-4 border-t border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400">Stok Tersedia:</p>
                    <p class="text-sm font-bold text-gray-700">{{ $product->stock }} pcs</p>
                </div>
                
                @php
                    // MENGAMBIL DATA KERANJANG DARI DATABASE, BUKAN SESSION
                    $qtyInCart = 0;
                    if(Auth::check()) {
                        $qtyInCart = \App\Models\Cart::where('user_id', Auth::id())
                                       ->where('product_id', $product->id)
                                       ->value('quantity') ?? 0;
                    }
                @endphp

                @if($qtyInCart > 0)
                    <div class="flex items-center bg-gray-100 rounded-xl border border-gray-200 shadow-sm h-11">
                        <a href="{{ route('cart.decrease', $product->id) }}" class="px-5 text-gray-600 hover:bg-gray-200 hover:text-red-500 rounded-l-xl transition font-bold text-lg h-full flex items-center justify-center">-</a>
                        <span class="px-6 text-base font-bold text-gray-800 bg-white border-x border-gray-200 h-full flex items-center justify-center">{{ $qtyInCart }}</span>
                        <a href="{{ route('cart.add', $product->id) }}" class="px-5 text-gray-600 hover:bg-gray-200 hover:text-green-600 rounded-r-xl transition font-bold text-lg h-full flex items-center justify-center">+</a>
                    </div>
                @else
                    <a href="{{ route('cart.add', $product->id) }}" class="bg-primary text-white text-sm font-bold px-8 py-3 rounded-xl hover:bg-darkGreen transition shadow-md shadow-green-900/10 text-center">
                        Beli
                    </a>
                @endif
            </div>

        </div>

    </div>
</div>

    @if(session('success'))
        <div id="toast-success" class="fixed bottom-6 right-6 z-50 flex items-center w-full max-w-xs p-4 text-gray-700 bg-white rounded-xl shadow-xl border border-gray-100 transform transition-all duration-500 translate-y-0 opacity-100" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
            </div>
            <div class="ms-3 text-sm font-semibold">{{ session('success') }}</div>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('toast-success');
                if (toast) {
                    toast.classList.add('translate-y-4', 'opacity-0');
                    setTimeout(() => toast.remove(), 500); 
                }
            }, 3000);
        </script>
    @endif

    @if(session('error'))
        <div id="toast-error" class="fixed bottom-6 right-6 z-50 flex items-center w-full max-w-xs p-4 text-gray-700 bg-white rounded-xl shadow-xl border border-gray-100 transform transition-all duration-500 translate-y-0 opacity-100" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
            </div>
            <div class="ms-3 text-sm font-semibold">{{ session('error') }}</div>
        </div>
        <script>
            setTimeout(() => {
                const toastError = document.getElementById('toast-error');
                if (toastError) {
                    toastError.classList.add('translate-y-4', 'opacity-0');
                    setTimeout(() => toastError.remove(), 500); 
                }
            }, 3500);
        </script>
    @endif

    <div class="mt-16 border-t border-gray-200 pt-12 max-w-7xl mx-auto px-4 pb-12">
    <h3 class="text-xl font-bold text-gray-800 mb-8">Ulasan Pembeli</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-1 bg-gray-50 p-6 rounded-xl border border-gray-200/60 flex flex-col items-center justify-center text-center h-fit">
            <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Rata-rata Rating</p>
            <h1 class="text-6xl font-black text-gray-800 mb-2">{{ $averageRating }}</h1>
            <div class="flex items-center justify-center bg-green-50 px-3 py-1 rounded-full border border-green-100 mb-3">
                <img src="{{ asset('images/icons/star.png') }}" alt="Star" class="w-3.5 h-3.5 object-contain mr-1 -mt-[2px]">
                <span class="text-xs font-black text-[#476024]">Skor Kepuasan</span>
            </div>
            <p class="text-xs text-gray-400">Berdasarkan {{ $product->reviews->count() }} ulasan dari pembeli terverifikasi</p>
        </div>

        <div class="md:col-span-2 space-y-4">
            @forelse($product->reviews as $review)
                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start border-b border-gray-100 pb-3">
                        <div>
                            <span class="font-bold text-sm text-gray-800 block mb-0.5">{{ $review->user->name }}</span>
                            <span class="text-[11px] text-gray-400 block">{{ $review->created_at->format('d F Y') }}</span>
                        </div>
                        <div class="flex items-center space-x-1 bg-amber-50 px-2.5 py-1 rounded-lg border border-amber-200">
                            <img src="{{ asset('images/icons/star.png') }}" alt="Star" class="w-3 h-3 object-contain -mt-[2px]">
                            <span class="text-xs font-black text-amber-700">{{ $review->rating }}.0</span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mt-3 italic leading-relaxed">
                        "{{ $review->comment }}"
                    </p>
                </div>
            @empty
                <div class="text-center py-12 bg-gray-50 rounded-xl border border-dashed border-gray-200 flex flex-col items-center justify-center">
                    <p class="text-sm text-gray-400 font-medium">Belum ada ulasan untuk produk ini.</p>
                    <p class="text-xs text-gray-400 mt-1">Ulasan hanya dapat diberikan oleh pembeli yang transaksinya telah selesai.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection