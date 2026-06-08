<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Wishlist Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                
                <div class="md:col-span-1">
                    <div class="bg-white shadow sm:rounded-lg overflow-hidden sticky top-6 border border-gray-100">
                        <div class="p-4 bg-gray-50 border-b border-gray-100">
                            <p class="text-sm font-bold text-gray-600 uppercase tracking-wider">Menu Navigasi</p>
                        </div>
                        <div class="flex flex-col">
                            
                            <a href="{{ route('profile.edit') }}" class="px-5 py-4 border-l-4 transition flex items-center space-x-3 {{ request()->routeIs('profile.edit') ? 'border-green-600 bg-green-50 text-green-700 font-bold' : 'border-transparent text-gray-600 font-medium hover:bg-gray-50 hover:border-gray-300' }}">
                                <span>Detail Profil</span>
                            </a>

                            <a href="{{ route('cart.index') }}" class="px-5 py-4 border-l-4 transition flex items-center space-x-3 {{ request()->routeIs('cart.index') ? 'border-green-600 bg-green-50 text-green-700 font-bold' : 'border-transparent text-gray-600 font-medium hover:bg-gray-50 hover:border-gray-300' }}">
                                <span>Keranjang Saya</span>
                            </a>

                            <a href="{{ route('orders.index') }}" class="px-5 py-4 border-l-4 transition flex items-center space-x-3 {{ request()->routeIs('orders.*') ? 'border-green-600 bg-green-50 text-green-700 font-bold' : 'border-transparent text-gray-600 font-medium hover:bg-gray-50 hover:border-gray-300' }}">
                                <span>Pesanan Saya</span>
                            </a>

                            <a href="{{ route('wishlist.index') }}" class="px-5 py-4 border-l-4 transition flex items-center space-x-3 {{ request()->routeIs('wishlist.index') ? 'border-green-600 bg-green-50 text-green-700 font-bold' : 'border-transparent text-gray-600 font-medium hover:bg-gray-50 hover:border-gray-300' }}">
                                <span>Wishlist Saya</span>
                            </a>

                            <div class="border-t border-gray-100"></div>

                            <a href="/produk" class="px-5 py-4 border-l-4 border-transparent text-gray-600 font-medium hover:bg-gray-50 hover:text-green-600 transition flex items-center space-x-3">
                                <span>Kembali ke katalog</span>
                            </a>
                            
                        </div>
                    </div>
                </div>

                <div class="md:col-span-3 space-y-6">
                    
                    {{-- UBAH: Cek ke variable object $wishlists --}}
                    @if($wishlists->isNotEmpty())
                        <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6 border border-gray-100">
                            <h3 class="text-lg font-bold text-gray-800 border-b border-gray-100 pb-4 mb-4">Produk Tersimpan (Wishlist)</h3>
                            
                            <div class="divide-y divide-gray-200">
                                {{-- UBAH: Looping dari object database --}}
                                @foreach($wishlists as $item)
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between py-5 gap-4">
                                        <div class="flex items-center space-x-4">
                                            <a href="{{ route('products.show', $item->product->slug ?? '') }}">
                                                <img src="{{ asset('images/produk/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-24 h-24 object-cover rounded-lg border border-gray-100 hover:opacity-80 transition">
                                            </a>
                                            <div>
                                                <span class="text-xs text-gray-400 font-medium">{{ $item->product->category }}</span>
                                                <a href="{{ route('products.show', $item->product->slug ?? '') }}" class="hover:text-primary transition">
                                                    <h3 class="font-bold text-gray-800 text-base mb-1">{{ $item->product->name }}</h3>
                                                </a>
                                                <span class="font-bold text-primary text-sm block">Rp {{ number_format($item->product->price, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center space-x-3 mt-2 sm:mt-0">
                                            {{-- UBAH: Menggunakan ID produk dari relasi --}}
                                            <a href="{{ route('wishlist.toggle', $item->product_id) }}" class="text-red-500 hover:text-red-700 font-bold text-sm bg-red-50 hover:bg-red-100 px-4 py-2 rounded-xl transition">
                                                Hapus
                                            </a>
                                            <a href="{{ route('cart.add', $item->product_id) }}" class="bg-[#476024] text-white px-5 py-2 rounded-xl font-bold hover:bg-[#2d3e17] transition shadow-md text-sm whitespace-nowrap">
                                                + Keranjang
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="bg-white p-12 text-center sm:rounded-lg shadow border border-gray-100">
                            <img src="{{ asset('images/icons/fav3.png') }}" alt="Wishlist Kosong" class="w-20 h-20 mx-auto mb-4 object-contain">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Yah.. Wishlist Anda masih kosong</h3>
                            <p class="text-gray-500 mb-6">Simpan produk impian Anda di sini</p>
                            <a href="/produk" class="mt-4 text-[#476024] font-bold hover:underline">Lihat Produk</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div id="toast-wishlist" class="fixed bottom-6 right-6 z-50 flex items-center w-full max-w-xs p-4 text-gray-700 bg-white rounded-xl shadow-xl border border-gray-100 transform transition-all duration-500 translate-y-0 opacity-100" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                </svg>
            </div>
            <div class="ms-3 text-sm font-semibold">{{ session('success') }}</div>
        </div>

        <script>
            setTimeout(() => {
                const toast = document.getElementById('toast-wishlist');
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
</x-app-layout>