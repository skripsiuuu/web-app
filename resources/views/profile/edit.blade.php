@extends('layouts.app')

@section('title', 'Profil Anda')

@section('content')
    <div class="relative bg-cover bg-center h-[320px] flex flex-col justify-center items-center text-white" 
         style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('{{ asset('images/profile/banner-ayam.png') }}');">
        <div class="max-w-5xl mx-auto px-4 w-full text-center z-10">
            <h1 class="text-3xl font-bold mb-4 tracking-wide">Profil Anda</h1>
            <p class="text-sm font-medium text-gray-200 tracking-wide max-w-md mx-auto leading-relaxed">
                Ubah informasi profil akun sesuai dengan kebutuhan anda !
            </p>
        </div>
    </div>

    <div class="bg-[#F0F0F0] py-16 px-4">
        <div class="max-w-3xl mx-auto">
            <form action="#" method="POST" class="space-y-5">
                @csrf
                @method('PUT') {{-- Digunakan jika Anda memproses update data di Laravel --}}

                <div>
                    <label for="name" class="block text-xs font-semibold text-gray-600 mb-2">Nama</label>
                    <input type="text" id="name" name="name" value="Ahmad Ramadhan" 
                           class="w-full bg-white text-gray-700 text-xs px-4 py-3 rounded border border-transparent focus:outline-none focus:border-green-700 shadow-sm transition">
                </div>

                <div>
                    <label for="phone" class="block text-xs font-semibold text-gray-600 mb-2">Nomor Handphone</label>
                    <input type="text" id="phone" name="phone" value="0812xxxxxxxxxx" 
                           class="w-full bg-white text-gray-700 text-xs px-4 py-3 rounded border border-transparent focus:outline-none focus:border-green-700 shadow-sm transition">
                </div>

                <div>
                    <label for="address" class="block text-xs font-semibold text-gray-600 mb-2">Alamat Lengkap</label>
                    <input type="text" id="address" name="address" value="Jl. Raden KH. Hasyim Asyari" 
                           class="w-full bg-white text-gray-700 text-xs px-4 py-3 rounded border border-transparent focus:outline-none focus:border-green-700 shadow-sm transition">
                </div>

                <div>
                    <label for="postal_code" class="block text-xs font-semibold text-gray-600 mb-2">Kode Pos</label>
                    <input type="text" id="postal_code" name="postal_code" value="1234567" 
                           class="w-full bg-white text-gray-700 text-xs px-4 py-3 rounded border border-transparent focus:outline-none focus:border-green-700 shadow-sm transition">
                </div>

                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-600 mb-2">E-mail</label>
                    <input type="email" id="email" name="email" value="sixseven67@gmail.com" 
                           class="w-full bg-white text-gray-700 text-xs px-4 py-3 rounded border border-transparent focus:outline-none focus:border-green-700 shadow-sm transition">
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-gray-600 mb-2">Password</label>
                    <input type="password" id="password" name="password" value="xxxxxxxxxxxxxxxxxxxx" 
                           class="w-full bg-white text-gray-700 text-xs px-4 py-3 rounded border border-transparent focus:outline-none focus:border-green-700 shadow-sm transition">
                </div>

                <div class="pt-8 flex justify-center">
                    <button type="submit" 
                            class="w-full max-w-xl bg-[#2A4418] hover:bg-[#203412] text-white font-semibold text-sm py-3.5 rounded-xl shadow-md transition-all duration-300 transform hover:-translate-y-0.5 text-center">
                        Ubah Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <footer class="bg-[#1A1A1A] text-white relative overflow-hidden" style="background-image: linear-gradient(rgba(26, 26, 26, 0.92), rgba(26, 26, 26, 0.92)), url('{{ asset('images/footer/bg-leaves.png') }}'); bg-repeat: repeat;">
        <div class="max-w-7xl mx-auto px-6 md:px-12 py-16 grid grid-cols-1 md:grid-cols-4 gap-10 items-start relative z-10">
            
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo-white.png') }}" alt="Mitra Hidup Sehat" class="h-12 object-contain">
                    <div class="leading-tight">
                        <span class="block font-bold text-lg tracking-wide">Mitra</span>
                        <span class="block font-semibold text-sm text-gray-300">Hidup Sehat</span>
                    </div>
                </div>
                <ul class="space-y-4 text-sm font-medium text-gray-300 pt-4">
                    <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-white transition">Distribusi Kami</a></li>
                    <li><a href="#" class="hover:text-white transition">Beli Sekarang</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-base mb-6 tracking-wide text-white">Produk</h4>
                <ul class="space-y-4 text-sm text-gray-300">
                    <li><a href="#" class="hover:text-white transition">Telur Ayam Probiotik</a></li>
                    <li><a href="#" class="hover:text-white transition">Ayam Sehat Organik</a></li>
                    <li><a href="#" class="hover:text-white transition">Sayuran Hidroponik</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-base mb-6 tracking-wide text-white">Informasi Menarik</h4>
                <ul class="space-y-4 text-sm text-gray-300">
                    <li><a href="#" class="hover:text-white transition">Kumpulan Resep Inovatif</a></li>
                    <li><a href="#" class="hover:text-white transition">Artikel Gaya Hidup Sehat</a></li>
                    <li><a href="#" class="hover:text-white transition">Informasi Gizi & Nutrisi</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-base mb-6 tracking-wide text-white">Cari kami di platform lainnya !</h4>
                <div class="space-y-4 text-xs text-gray-300">
                    <a href="https://instagram.com/honestchicken" target="_blank" class="flex items-center space-x-3 group">
                        <img src="{{ asset('images/footer/instagram.png') }}" alt="Instagram" class="w-7 h-7 object-contain">
                        <span class="group-hover:text-white transition">@honestchicken</span>
                    </a>
                    <a href="#" target="_blank" class="flex items-center space-x-3 group">
                        <img src="{{ asset('images/footer/shopee.png') }}" alt="Shopee" class="w-7 h-7 object-contain">
                        <span class="group-hover:text-white transition">honestchicken</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-[#466B2E] text-center py-4 text-xs font-medium text-gray-100 border-t border-white/10 relative z-10 tracking-wide">
            Copyright © 2026 PT. Mitra Hidup Sehat | <a href="#" class="underline hover:text-white transition">Help & FAQ</a>
        </div>
    </footer>
@endsection