<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dasbor Akun Saya') }}
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

                            <div class="border-t border-gray-100 mt-2"></div>

                            @if(auth()->user()->role == 'admin')
                                <a href="{{ route('admin.orders') }}" class="px-5 py-4 border-l-4 border-transparent text-[#476024] font-bold hover:bg-green-50 hover:border-[#476024] transition flex items-center space-x-3">
                                    <span>Masuk Panel Admin</span>
                                </a>
                            @endif

                            <a href="/produk" class="px-5 py-4 border-l-4 border-transparent text-gray-600 font-medium hover:bg-gray-50 hover:text-green-600 transition flex items-center space-x-3">
                                <span>Kembali ke katalog</span>
                            </a>
                            
                        </div>
                    </div>
                </div>
                
                <div class="md:col-span-3 space-y-6">
                    
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border border-gray-100">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border border-gray-100">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border border-gray-100">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
    </div>
</x-app-layout>