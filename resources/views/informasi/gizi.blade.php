@extends('layouts.public')

@section('title', 'Informasi Gizi & Nutrisi')

@section('content')
    <div class="relative bg-cover bg-center h-[300px] text-white flex flex-col" 
         style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/informasi/gizi/hero.png') }}');"> 
        <div class="w-full max-w-7xl mx-auto px-4 md:px-8 relative z-10 h-full flex flex-col pt-6 pb-12">
            <nav class="text-xs md:text-sm font-medium opacity-90 mb-auto">
                <a href="{{ route('informasi.index') }}" class="hover:text-green-200 transition">Informasi Menarik</a> 
                <span class="mx-1">|</span> 
                <span class="font-bold">Informasi Gizi & Nutrisi</span>
            </nav>
            <div class="flex flex-col items-center text-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-3 tracking-tight drop-shadow-md">Informasi Gizi & Nutrisi</h1>
                <p class="max-w-2xl text-sm md:text-base leading-relaxed opacity-90 drop-shadow-md text-gray-100">
                    Edukasi lengkap seputar kandungan gizi, nutrisi seimbang, serta zat-zat esensial yang dibutuhkan oleh tubuh kamu setiap hari.
                </p>
            </div>
            <div class="mt-auto"></div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 mt-8 flex flex-col items-center space-y-6">
        <div class="w-full max-w-xl bg-white p-3 rounded-full shadow-md flex items-center border border-gray-200">
            <input type="text" placeholder="Cari info gizi & nutrisi..." class="w-full px-4 text-sm border-none focus:ring-0 outline-none font-medium">
            <button class="bg-primary text-white p-2 rounded-full ml-2 hover:bg-darkGreen transition flex items-center justify-center w-8 h-8">
                <img src="{{ asset('images/icons/search.png') }}" alt="Cari" class="w-4 h-4 object-contain invert">
            </button>
        </div>

        <div class="flex flex-wrap justify-center gap-3 text-xs md:text-sm font-medium">
            <button class="bg-primary text-white px-5 py-2 rounded-full shadow-sm">Makronutrisi</button>
            <button class="bg-white border border-gray-300 text-gray-600 px-5 py-2 rounded-full hover:bg-gray-50 transition">Mikronutrisi</button>
            <button class="bg-white border border-gray-300 text-gray-600 px-5 py-2 rounded-full hover:bg-gray-50 transition">Tips Diet Sehat</button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @php
            // Membuat 9 data dummy untuk looping artikel gizi
            $nutritions = array_fill(0, 9, [
                'title' => 'Mengenal Karbohidrat : Manfaat, Jenis, dan Sumbernya',
                'category' => 'Makronutrisi',
                'img' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=500' // Gambar Makanan Sehat/Karbo
            ]);
        @endphp

        @foreach($nutritions as $nutrition)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between group hover:shadow-xl transition-shadow duration-300">
            <div class="relative h-64 bg-cover bg-center flex flex-col justify-end items-center pb-8 text-white text-center" 
                 style="background-image: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 60%, transparent 100%), url('{{ $nutrition['img'] }}');">
                <h3 class="font-bold text-lg md:text-xl mb-4 px-6 drop-shadow-md leading-snug">{{ $nutrition['title'] }}</h3>
                <a href="{{ route('informasi.gizi.detail') }}" class="text-orange-500 hover:text-orange-600 text-xs font-bold bg-white px-5 py-2 rounded-full shadow-md transition transform hover:scale-105">
                    Baca Selengkapnya <span class="ml-1">➔</span>
                </a>
            </div>
            <div class="bg-primary text-white text-center py-2.5 text-xs font-semibold tracking-wide">
                {{ $nutrition['category'] }}
            </div>
        </div>
        @endforeach
    </div>

    <div class="max-w-7xl mx-auto px-4 pb-16 flex justify-center items-center space-x-2">
        <button class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 hover:bg-gray-50">◀</button>
        <button class="w-10 h-10 flex items-center justify-center rounded-full bg-primary text-white font-bold text-sm">1</button>
        <button class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 text-sm hover:bg-gray-50">2</button>
        <button class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 text-sm hover:bg-gray-50">3</button>
        <span class="px-1 text-gray-400">...</span>
        <button class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 text-sm hover:bg-gray-50">150</button>
        <button class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 hover:bg-gray-50">▶</button>
    </div>
@endsection