@extends('layouts.public')

@section('title', 'Informasi Menarik')

@section('content')
    <div class="bg-[#F4F4F4] min-h-screen font-sans pb-24">
        
        <div class="max-w-7xl mx-auto px-6 md:px-12 pt-8">
            <span class="text-sm font-semibold text-[#3A5A40] opacity-80">Informasi Menarik</span>
        </div>

        <div class="max-w-4xl mx-auto text-center mt-8 mb-16 px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-[#1E352F] leading-tight">
                Berbagai Pilihan Informasi<br>Untuk Menunjang Hidup Anda
            </h1>
        </div>

        <div class="max-w-7xl mx-auto px-4 md:px-8 grid grid-cols-1 md:grid-cols-3 gap-0 overflow-hidden shadow-lg rounded-sm">
            
            <div class="relative h-[450px] bg-cover bg-center flex flex-col justify-end items-center pb-10 text-white text-center group" 
                 style="background-image: linear-gradient(to top, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.2) 60%, transparent 100%), url('{{ asset('images/informasi/home/gaya-hidup-sehat.png') }}');">
                <div class="px-6 mb-6">
                    <h3 class="font-bold text-2xl md:text-3xl tracking-wide leading-tight drop-shadow-md">
                        Artikel<br>Gaya Hidup Sehat
                    </h3>
                </div>
                <a href="{{ route('informasi.gaya-hidup') }}" class="bg-white text-[#1E352F] text-xs font-semibold px-6 py-2.5 rounded-full shadow-md hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                    Baca Selengkapnya
                </a>
            </div>

            <div class="relative h-[450px] bg-cover bg-center flex flex-col justify-end items-center pb-10 text-white text-center group" 
                 style="background-image: linear-gradient(to top, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.2) 60%, transparent 100%), url('{{ asset('images/informasi/home/resep-inovatif.png') }}');">
                <div class="px-6 mb-6">
                    <h3 class="font-bold text-2xl md:text-3xl tracking-wide leading-tight drop-shadow-md">
                        Kumpulan<br>Resep Inovatif
                    </h3>
                </div>
                <a href="{{ route('informasi.resep') }}" class="bg-white text-[#1E352F] text-xs font-semibold px-6 py-2.5 rounded-full shadow-md hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                    Baca Selengkapnya
                </a>
            </div>

            <div class="relative h-[450px] bg-cover bg-center flex flex-col justify-end items-center pb-10 text-white text-center group" 
                 style="background-image: linear-gradient(to top, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.2) 60%, transparent 100%), url('{{ asset('images/informasi/home/gizi-nutrisi.png') }}');">
                <div class="px-6 mb-6">
                    <h3 class="font-bold text-2xl md:text-3xl tracking-wide leading-tight drop-shadow-md">
                        Informasi<br>Gizi & Nutrisi
                    </h3>
                </div>
                <a href="{{ route('informasi.gizi') }}" class="bg-white text-[#1E352F] text-xs font-semibold px-6 py-2.5 rounded-full shadow-md hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                    Baca Selengkapnya
                </a>
            </div>

        </div>
    </div>
@endsection