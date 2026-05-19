<!DOCTYPE html>
<html lang="id">
<!-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitra Hidup Sehat - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#476024', // Warna hijau khas Mitra Hidup Sehat
                        darkGreen: '#2d3e17',
                        footerBg: '#1e2515',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen"> -->

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
                    // 2. Tambahkan pengaturan fontFamily di sini
                    fontFamily: {
                        // Ini akan mengubah font default Tailwind menjadi Amiko
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
                <!-- <div class="bg-white p-1 rounded-full w-10 h-10 flex items-center justify-center font-bold text-primary">MHS</div> -->
                <!-- <div class="w-20 h-10 flex items-center justify-center" style="background-image:url('{{ asset('images/LogoMHS.png') }}" alt="LogoMHS');"></div> -->
                <div class="flex items-center justify-center bg-transparent">
                    <img src="{{ asset('images/LogoMHS.png') }}" alt="Logo Mitra Hidup Sehat" class="h-12 w-auto object-contain">
                </div>
                <!-- <span class="font-bold text-lg tracking-wider">Mitra Hidup Sehat</span> -->
            </div>
            <div class="hidden md:flex space-x-6 text-sm font-medium">
                <a href="/" class="hover:text-green-600 transition">Tentang Kami</a>
                <a href="/produk" class="hover:text-green-600 transition">Produk</a>
                <a href="/informasi" class="hover:text-green-600 transition">Informasi Menarik</a>
                <!-- <a href="/distribusi" class="hover:text-green-600 transition">Distribusi Kami</a> -->
                <a href="{{ route('distribusi.index') }}" class="hover:text-green-600 transition">Distribusi Kami</a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/produk" class="bg-darkGreen border border-white px-4 py-2 rounded text-sm font-semibold hover:bg-white hover:text-primary transition">Beli Sekarang</a>
                <!-- <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center cursor-pointer">👤</div> -->
                <!-- <div class="w-10 h-10 rounded-full flex items-center justify-center cursor-pointer transition hover:opacity-80">
                    <img src="{{ asset('images/icons/profile.png') }}" class="w-full h-full object-contain" alt="User Profile">
                </div> -->
                <a href="{{ route('profile.edit') }}" class="inline-block transition transform hover:scale-105">
                    <!-- <div class="w-10 h-10 rounded-full border-2 border-white/20 flex items-center justify-center bg-[#2A4418]">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div> -->
                    <div class="w-10 h-10 rounded-full flex items-center justify-center cursor-pointer transition hover:opacity-80">
                        <img src="{{ asset('images/icons/profile.png') }}" class="w-full h-full object-contain" alt="User Profile">
                    </div>
                </a>
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
                    <!-- <div class="bg-white p-1 rounded-full w-8 h-8 flex items-center justify-center text-primary text-xs">MHS</div> -->
                    <div class="flex items-center justify-center bg-transparent">
                        <img src="{{ asset('images/LogoMHS2.png') }}" alt="Logo Mitra Hidup Sehat 2" class="h-12 w-auto object-contain">
                    </div>
                    <!-- <span>Mitra Hidup Sehat</span> -->
                </div>
                <ul class="space-y-2">
                    <li><a href="/" class="hover:underline">Tentang Kami</a></li>
                    <li><a href="/distribusi" class="hover:underline">Distribusi Kami</a></li>
                    <li><a href="/produk" class="hover:underline">Beli Sekarang</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Produk</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:underline">Telur Ayam Probiotik</a></li>
                    <li><a href="#" class="hover:underline">Ayam Sehat Organik</a></li>
                    <li><a href="#" class="hover:underline">Sayuran Hidroponik</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Informasi Menarik</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:underline">Kumpulan Resep Inovatif</a></li>
                    <li><a href="#" class="hover:underline">Artikel Gaya Hidup Sehat</a></li>
                    <li><a href="#" class="hover:underline">Informasi Gizi & Nutrisi</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Cari kami di platform lainnya!</h4>
                <div class="space-y-2">
                    <!-- <p class="flex items-center space-x-2"><span>@honestchicken</span></p> -->
                    <div class="flex items-center bg-transparent space-x-2">
                        <img src="{{ asset('images/Logo Instagram.png') }}" alt="Logo IG" class="h-6 w-auto object-contain"> <span>@honestchicken</span>
                    </div>
                    <!-- <p class="flex items-center space-x-2">🛍️ <span>honestchicken</span></p> -->
                    <div class="flex items-center bg-transparent space-x-2">
                        <img src="{{ asset('images/Logo Shopee.png') }}" alt="Logo Shopee" class="h-6 w-auto object-contain"> <span>@honestchicken</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700 pt-4 text-center text-xs text-gray-500">
            Copyright © 2026 PT. Mitra Hidup Sehat | <a href="#" class="underline">Help & FAQ</a>
        </div>
    </footer>

</body>
</html>