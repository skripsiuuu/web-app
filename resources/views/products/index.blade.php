@extends('layouts.public')

@section('title', 'Katalog Produk')

@section('content')

    <div class="relative bg-cover bg-center h-[180px] flex flex-col justify-end items-center justify-center text-white font-bold text-3xl shadow-inner" style="background-image: linear-gradient(rgba(71, 96, 36, 0.7), rgba(71, 96, 36, 0.7)), url('{{ asset('images/informasi/home/gaya-hidup-sehat.png') }}') ;">
        Katalog Produk Mitra Hidup Sehat
        <div class="absolute inset-0 flex flex-col justify-between pb-24">
            <div class="w-full max-w-7xl mx-auto px-6 md:px-12 pt-8">
                <span class="text-sm font-semibold text-white/80">Produk</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 mt-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        
        <!-- Filter Kategori (Kiri) -->
        <div class="flex flex-wrap gap-3 text-sm mb-4 md:mb-0">
            @php
                // Tangkap kategori apa yang lagi dipilih di URL saat ini
                $currentCategory = request('category');
            @endphp

            <a href="{{ route('products.index', request()->except('category')) }}" 
               class="px-4 py-2 rounded-full font-medium transition-colors shadow-sm {{ empty($currentCategory) ? 'bg-[#476024] border border-[#476024] text-white' : 'bg-white border border-gray-300 text-gray-600 hover:bg-gray-50' }}">
                Semua Produk
            </a>

            <a href="{{ route('products.index', array_merge(request()->query(), ['category' => 'Ayam Probiotik'])) }}" 
               class="px-4 py-2 rounded-full font-medium transition-colors shadow-sm {{ $currentCategory == 'Ayam Probiotik' ? 'bg-[#476024] border border-[#476024] text-white' : 'bg-white border border-gray-300 text-gray-600 hover:bg-gray-50' }}">
                Ayam Probiotik
            </a>

            <a href="{{ route('products.index', array_merge(request()->query(), ['category' => 'Telur Organik'])) }}" 
               class="px-4 py-2 rounded-full font-medium transition-colors shadow-sm {{ $currentCategory == 'Telur Organik' ? 'bg-[#476024] border border-[#476024] text-white' : 'bg-white border border-gray-300 text-gray-600 hover:bg-gray-50' }}">
                Telur Organik
            </a>
        </div>
        
        <!-- Area Kanan: Dropdown Sortir & Search Bar (Sudah Digabung dalam Form) -->
        <form action="{{ route('products.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
            
            <!-- Input Tersembunyi buat nyimpen filter kategori saat nyortir -->
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif

            <!-- Dropdown Sortir Modern (Pakai Vanilla JS 100% Aman) -->
            @php
                $sortLabels = [
                    'terbaru' => 'Terbaru',
                    'harga_terendah' => 'Harga Terendah',
                    'harga_tertinggi' => 'Harga Tertinggi',
                    'terlaris' => 'Terlaris',
                    'rating_terbaik' => 'Rating Terbaik' // <--- TAMBAHAN BARU
                ];
                $currentSort = request('sort', 'terbaru');
            @endphp

            <!-- Input tersembunyi buat nangkep nilai sortir -->
            <input type="hidden" name="sort" id="sortInput" value="{{ $currentSort }}">

            <div class="relative w-full sm:w-48">
                <!-- Tombol Utama -->
                <button 
                    type="button" 
                    onclick="toggleSortMenu()"
                    class="w-full flex items-center justify-between border border-gray-300 rounded-full text-sm text-gray-600 bg-white px-4 py-2 hover:border-[#476024] focus:ring-2 focus:ring-[#476024] focus:outline-none transition-all shadow-sm"
                >
                    <span class="font-medium">{{ $sortLabels[$currentSort] ?? 'Terbaru' }}</span>
                    <svg id="sortArrow" class="w-4 h-4 ml-2 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <!-- Isi Dropdown (Menu Melayang) -->
                <div 
                    id="sortMenu"
                    class="hidden absolute right-0 sm:left-0 mt-2 w-full sm:w-48 bg-white border border-gray-100 rounded-xl shadow-lg z-50 overflow-hidden"
                >
                    <div class="py-1 flex flex-col">
                        <button type="button" onclick="pilihSortir('terbaru')" class="text-left px-4 py-2.5 text-sm transition-colors {{ $currentSort == 'terbaru' ? 'bg-[#f9fbf7] text-[#476024] font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                            Terbaru
                        </button>
                        <button type="button" onclick="pilihSortir('harga_terendah')" class="text-left px-4 py-2.5 text-sm transition-colors {{ $currentSort == 'harga_terendah' ? 'bg-[#f9fbf7] text-[#476024] font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                            Harga Terendah
                        </button>
                        <button type="button" onclick="pilihSortir('harga_tertinggi')" class="text-left px-4 py-2.5 text-sm transition-colors {{ $currentSort == 'harga_tertinggi' ? 'bg-[#f9fbf7] text-[#476024] font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                            Harga Tertinggi
                        </button>
                        <button type="button" onclick="pilihSortir('terlaris')" class="text-left px-4 py-2.5 text-sm transition-colors {{ $currentSort == 'terlaris' ? 'bg-[#f9fbf7] text-[#476024] font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                            Terlaris
                        </button>
                        <button type="button" onclick="pilihSortir('rating_terbaik')" class="text-left px-4 py-2.5 text-sm transition-colors {{ $currentSort == 'rating_terbaik' ? 'bg-[#f9fbf7] text-[#476024] font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                            Rating Terbaik
                        </button>
                    </div>
                </div>
            </div>

            <!-- Script Buka Tutup Menu Bawaan -->
            <script>
                function toggleSortMenu() {
                    document.getElementById('sortMenu').classList.toggle('hidden');
                    document.getElementById('sortArrow').classList.toggle('rotate-180');
                }

                function pilihSortir(nilai) {
                    document.getElementById('sortInput').value = nilai;
                    // Langsung otomatis submit/refresh form pas diklik
                    document.getElementById('sortInput').closest('form').submit();
                }

                // Tutup otomatis kalau lu ngeklik layar sembarangan di luar dropdown
                document.addEventListener('click', function(event) {
                    const menu = document.getElementById('sortMenu');
                    const tombol = menu.previousElementSibling;
                    
                    if (menu && tombol && !tombol.contains(event.target) && !menu.contains(event.target)) {
                        menu.classList.add('hidden');
                        document.getElementById('sortArrow').classList.remove('rotate-180');
                    }
                });
            </script>

            <!-- Search Bar -->
            <div class="relative w-full sm:w-72">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk sehat anda..." class="w-full border border-gray-300 rounded-full pl-4 pr-12 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm">
                <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 opacity-50 hover:opacity-100 transition">
                    <img src="{{ asset('images/icons/search.png') }}" alt="Cari" class="w-6 h-6">
                </button>
            </div>
        </form>

    </div>

    <div class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-2 md:grid-cols-4 gap-6">
        
       @foreach($products as $produk)
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm flex flex-col justify-between group">
            <div class="relative bg-gray-100 p-4 h-48 flex items-center justify-center">
                
                <span class="absolute top-2 left-2 z-10 bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded">Ekspor Singapura</span>
                
                @auth
                    @php
                        $wishlist = session()->get('wishlist', []);
                        $isWishlisted = isset($wishlist[$produk->id]);
                    @endphp

                    <a href="{{ route('wishlist.toggle', $produk->id) }}" class="absolute top-2 right-2 z-10 transition-transform hover:scale-110">
                        <img 
                            src="{{ asset('images/icons/' . ($isWishlisted ? 'fav2.png' : 'fav1.png')) }}" 
                            alt="Wishlist" 
                            class="w-8 h-8"
                        >
                    </a>
                @else
                    <a href="{{ route('login.kembali') }}" class="absolute top-2 right-2 z-10 transition-transform hover:scale-110">
                        <img src="{{ asset('images/icons/fav1.png') }}" alt="Wishlist (Harus Login)" class="w-8 h-8">
                    </a>
                @endauth
                
                <a href="{{ route('products.show', $produk->slug) }}" class="w-full">
                    <img src="{{ asset('images/produk/' . $produk->image) }}" alt="{{ $produk->name }}" class="w-full h-56 object-cover object-center rounded-t-lg">
                </a>
                
            </div>
            <div class="p-4 flex-grow flex flex-col justify-between">
                <div>
                    <p class="text-xs text-gray-400 font-medium">{{ $produk->category }}</p>
                    
                    <a href="{{ route('products.show', $produk->slug) }}">
                        <h4 class="font-bold text-sm text-gray-800 mb-1 hover:text-primary transition">{{ $produk->name }}</h4>
                    </a>
                    
                    @php
                        $avgRating = $produk->reviews->avg('rating') ?? 5.0;
                        $avgRating = number_format($avgRating, 1);
                    @endphp
                    <div class="flex items-center space-x-1 mb-3">
                        <img src="{{ asset('images/icons/star.png') }}" alt="Star" class="w-3.5 h-3.5 object-contain -mt-[2px]">
                        <span class="text-xs text-gray-600 font-bold leading-none">{{ $avgRating }}</span>
                        <span class="text-[10px] text-gray-400 ml-1">({{ $produk->reviews->count() }})</span>
                    </div>
                </div> 
                <div class="flex items-center justify-between mt-2">
                    <span class="text-primary font-bold text-sm">Rp {{ number_format($produk->price, 0, ',', '.') }}</span>
                    
                    @php
                        // Cek apakah produk ini sudah ada di dalam keranjang (session)
                        $cart = session()->get('cart', []);
                        $qtyInCart = isset($cart[$produk->id]) ? $cart[$produk->id]['quantity'] : 0;
                    @endphp

                    @if($qtyInCart > 0)
                        <div class="flex items-center bg-gray-100 rounded-lg border border-gray-200 z-10 relative shadow-sm">
                            <a href="{{ route('cart.decrease', $produk->id) }}" class="px-2.5 py-1 text-gray-600 hover:bg-gray-200 hover:text-red-500 rounded-l-lg transition font-bold text-sm">-</a>
                            <span class="px-2 py-1 text-xs font-bold text-gray-800 bg-white border-x border-gray-200">{{ $qtyInCart }}</span>
                            <a href="{{ route('cart.add', $produk->id) }}" class="px-2.5 py-1 text-gray-600 hover:bg-gray-200 hover:text-green-600 rounded-r-lg transition font-bold text-sm">+</a>
                        </div>
                    @else
                        <a href="{{ route('cart.add', $produk->id) }}" class="bg-primary text-white text-xs px-4 py-1.5 rounded hover:bg-darkGreen transition inline-block text-center relative z-10 shadow-sm">
                            Beli
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        
    </div>

    <!-- Paginasi (Asli Bawaan Lu) -->
    <div class="max-w-7xl mx-auto px-4 pb-16 flex justify-center items-center space-x-2 text-sm text-gray-600">
        <!-- <button class="p-2 border rounded hover:bg-gray-100">◀</button>
        <button class="px-3 py-1 border bg-primary text-white rounded">1</button>
        <button class="px-3 py-1 border rounded hover:bg-gray-100">2</button>
        <button class="px-3 py-1 border rounded hover:bg-gray-100">3</button>
        <span>...</span>
        <button class="px-3 py-1 border rounded hover:bg-gray-100">10</button>
        <button class="p-2 border rounded hover:bg-gray-100">▶</button> -->
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

@endsection