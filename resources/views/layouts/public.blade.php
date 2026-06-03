<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitra Hidup Sehat - @yield('title')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiko:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Amiko', 'sans-serif'], 
                    },
                    colors: {
                        primary: '#476024',
                        darkGreen: '#2d3e17',
                        footerBg: '#1e2515',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 text-gray-800 font-sans flex flex-col min-h-screen">
    
    <nav class="bg-primary text-white sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            
            <div class="flex items-center space-x-2">
                <div class="flex items-center justify-center bg-transparent">
                    <img src="{{ asset('images/LogoMHS.png') }}" alt="Logo Mitra Hidup Sehat" class="h-12 w-auto object-contain">
                </div>
            </div>
            
            <div class="flex items-center space-x-8"> 
                
                <div class="hidden md:flex space-x-10 text-sm font-medium items-center">
                    <a href="/" class="hover:text-green-600 transition text-center">Tentang<br>Kami</a>
                    <a href="/produk" class="hover:text-green-600 transition">Produk</a>
                    <a href="/informasi" class="hover:text-green-600 transition text-center">Informasi<br>Menarik</a>
                    <a href="/distribusi-kami" class="hover:text-green-600 transition text-center">Distribusi<br>Kami</a>
                </div>
                
                <!-- <div class="flex items-center space-x-4">
                    <a href="/produk" class="bg-darkGreen border border-white px-4 py-2 rounded text-sm font-semibold hover:bg-white hover:text-primary transition">Beli Sekarang</a>
                    <a href="{{ route('profile.edit') }}" class="inline-block transition transform hover:scale-105">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center cursor-pointer transition hover:opacity-80">
                            <img src="{{ asset('images/icons/profile.png') }}" class="w-full h-full object-contain" alt="User Profile">
                        </div>
                    </a>
                </div> -->
                
                <div class="flex items-center space-x-4">
                    
                    @auth
                        <a href="{{ route('cart.index') }}" class="bg-darkGreen border border-white px-4 py-2 rounded text-sm font-semibold hover:bg-white hover:text-primary transition">
                            Keranjang Saya
                        </a>
                        
                        <a href="{{ route('profile.edit') }}" class="inline-block transition transform hover:scale-105">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center cursor-pointer transition hover:opacity-80">
                                <img src="{{ asset('images/icons/profile.png') }}" class="w-full h-full object-contain" alt="User Profile">
                            </div>
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="m-0 p-0 inline-block">
                            @csrf
                            <button type="submit" class="text-xs text-white hover:text-red-300 ml-2 font-medium">Logout</button>
                        </form>

                    @else
                        <a href="{{ route('login.kembali') }}" class="bg-darkGreen border border-white px-4 py-2 rounded text-sm font-semibold hover:bg-white hover:text-primary transition">
                            Beli Sekarang
                        </a>
                        
                        <a href="{{ route('login') }}" class="inline-block transition transform hover:scale-105">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center cursor-pointer transition hover:opacity-80">
                                <img src="{{ asset('images/icons/profile.png') }}" class="w-full h-full object-contain" alt="Guest Profile">
                            </div>
                        </a>
                    @endauth

                </div>

            </div>
            
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-footerBg text-gray-300 pt-10 pb-4 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/Background footer.png') }}');">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8 mb-8 text-sm">
            <div>
                <div class="flex items-center space-x-2 mb-4 text-white font-bold">
                    <div class="flex items-center justify-center bg-transparent">
                        <img src="{{ asset('images/LogoMHS2.png') }}" alt="Logo Mitra Hidup Sehat 2" class="h-12 w-auto object-contain">
                    </div>
                </div>
                <ul class="space-y-2">
                    <li><a href="/" class="hover:underline">Tentang Kami</a></li>
                    <li><a href="/distribusi-kami" class="hover:underline">Distribusi Kami</a></li>
                    <li><a href="/produk" class="hover:underline">Beli Sekarang</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Produk</h4>
                <ul class="space-y-2">
                    <li><a href="/produk?category=Ayam%20Probiotik" class="hover:underline">Ayam Probiotik</a></li>
                    <li><a href="/produk?category=Telur%20Organik" class="hover:underline">Telur Ayam Organik </a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Informasi Menarik</h4>
                <ul class="space-y-2">
                    <li><a href="/informasi-menarik/kumpulan-resep" class="hover:underline">Kumpulan Resep Inovatif</a></li>
                    <li><a href=/informasi-menarik/gaya-hidup-sehat class="hover:underline">Artikel Gaya Hidup Sehat</a></li>
                    <li><a href=/informasi-menarik/gizi-nutrisi class="hover:underline">Artikel Gizi & Nutrisi</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Cari kami di platform lainnya!</h4>
                <div class="space-y-2">
                    <div class="flex items-center bg-transparent space-x-2">
                        <img src="{{ asset('images/Logo Instagram.png') }}" alt="Logo IG" class="h-6 w-auto object-contain"> <a href="https://www.instagram.com/mitrahidupsehat.id">@mitrahidupsehat.id</a>
                    </div>
                    <div class="flex items-center bg-transparent space-x-2">
                        <img src="{{ asset('images/Logo Shopee.png') }}" alt="Logo Shopee" class="h-6 w-auto object-contain"> <a href="https://id.shp.ee/fZWngfio">@Honest Chicken Official</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700 pt-4 text-center text-xs text-gray-500">
            Copyright © 2026 PT. Mitra Hidup Sehat | <a href="https://linktr.ee/honestegg" class="underline">Help & FAQ</a>
        </div>
    </footer>

</body>
</html>