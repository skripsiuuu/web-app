<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keranjang Belanja') }}
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
                    
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative shadow-sm">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(count($cart) > 0)
                        <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6 border border-gray-100">
                            
                            <h3 class="text-lg font-bold text-gray-800 border-b border-gray-100 pb-4 mb-4">Daftar Belanjaan Anda</h3>
                            
                            <div class="divide-y divide-gray-200">
                                @php $total = 0; @endphp
                                @foreach($cart as $id => $details)
                                    @php $total += $details['price'] * $details['quantity']; @endphp
                                    
                                    <div class="flex items-center justify-between py-4">
                                        <div class="flex items-center space-x-4">
                                            <img src="{{ asset('images/produk/' . $details['image']) }}" alt="{{ $details['name'] }}" class="w-20 h-20 object-cover rounded-lg border border-gray-100">
                                            <div>
                                                <span class="text-xs text-gray-400 font-medium">{{ $details['category'] }}</span>
                                                <h3 class="font-bold text-gray-800 text-base">{{ $details['name'] }}</h3>
                                                
                                                <div class="flex items-center space-x-3 mt-2">
                                                    <span class="text-sm text-gray-600 font-medium">Rp {{ number_format($details['price'], 0, ',', '.') }}</span>
                                                    <span class="text-gray-300">|</span>
                                                    
                                                    <div class="flex items-center bg-gray-50 rounded-lg border border-gray-200">
                                                        <a href="{{ route('cart.decrease', $id) }}" class="px-3 py-1 text-gray-600 hover:bg-gray-200 hover:text-red-500 rounded-l-lg transition font-bold">-</a>
                                                        <span class="px-3 py-1 text-sm font-bold text-gray-800 bg-white border-x border-gray-200">{{ $details['quantity'] }}</span>
                                                        <a href="{{ route('cart.add', $id) }}" class="px-3 py-1 text-gray-600 hover:bg-gray-200 hover:text-green-600 rounded-r-lg transition font-bold">+</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="font-bold text-primary text-base">
                                                Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-6 pt-4 border-t border-gray-200 flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-500">Total Pembayaran:</p>
                                    <h3 class="text-2xl font-bold text-darkGreen">Rp {{ number_format($total, 0, ',', '.') }}</h3>
                                </div>
                                
                                <form action="{{ route('checkout.process') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-[#476024] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#2d3e17] transition shadow-md">
                                        Lanjut ke Pembayaran
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="bg-white p-12 text-center sm:rounded-lg shadow border border-gray-100">
                            <img src="{{ asset('images/icons/cart.png') }}" alt="Keranjang Kosong" class="w-20 h-20 mx-auto mb-4 object-contain">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Oops.. Keranjang belanja Anda masih kosong</h3>
                            <p class="text-gray-500 mb-6">Temui produk berkualitas hanya di Mitra Hidup Sehat</p>
                            <a href="/produk" class="mt-4 text-[#476024] font-bold hover:underline">Mulai Belanja</a>
                        </div>
                    @endif

                </div>
                </div>
            
        </div>
    </div>
</x-app-layout>