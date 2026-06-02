@extends('layouts.public')

@section('title', 'Kumpulan Resep Inovatif')

@section('content')
    <div class="relative bg-cover bg-center h-[300px] text-white flex flex-col" 
         style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/informasi/resep/hero.png')}}');"> 
        <div class="w-full max-w-7xl mx-auto px-4 md:px-8 relative z-10 h-full flex flex-col pt-6 pb-12">
            <nav class="text-xs md:text-sm font-medium opacity-90 mb-auto">
                <a href="{{ route('informasi.index') }}" class="hover:text-green-200 transition">Informasi Menarik</a> 
                <span class="mx-1">|</span> 
                <span class="font-bold">Kumpulan Resep Inovatif</span>
            </nav>
            <div class="flex flex-col items-center text-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-3 tracking-tight drop-shadow-md">Kumpulan Resep Inovatif</h1>
                <p class="max-w-2xl text-sm md:text-base leading-relaxed opacity-90 drop-shadow-md text-gray-100">
                    Berbagai pilihan resep inovatif untuk mengolah produk dari kami menjadi hidangan untuk disajikan di meja makan anda.
                </p>
            </div>
            <div class="mt-auto"></div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 mt-8 flex flex-col items-center space-y-6">
        <div class="w-full max-w-xl bg-white p-3 rounded-full shadow-md flex items-center border border-gray-200">
            <input type="text" placeholder="Cari judul resep..." class="w-full px-4 text-sm border-none focus:ring-0 outline-none font-medium">
            <button class="bg-primary text-white p-2 rounded-full ml-2 hover:bg-darkGreen transition flex items-center justify-center w-8 h-8">
                <img src="{{ asset('images/icons/search.png') }}" alt="Cari" class="w-4 h-4 object-contain invert">
            </button>
        </div>

        <div class="flex flex-wrap justify-center gap-3 text-xs md:text-sm font-medium">
            <button class="bg-primary text-white px-5 py-2 rounded-full shadow-sm">Resep Olahan Telur</button>
            <button class="bg-white border border-gray-300 text-gray-600 px-5 py-2 rounded-full hover:bg-gray-50 transition">Resep Olahan Ayam</button>
            <button class="bg-white border border-gray-300 text-gray-600 px-5 py-2 rounded-full hover:bg-gray-50 transition">Resep Olahan Sayuran</button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @php
            // Menyiapkan 9 data dummy untuk looping grid resep
            $recipes = array_fill(0, 9, [
                'title' => 'Omurice khas Jepang',
                'category' => 'Resep Olahan Telur',
                'img' => asset('images/informasi/resep/resep.png')
            ]);
        @endphp

        @foreach($recipes as $recipe)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between group hover:shadow-xl transition-shadow duration-300">
            <div class="relative h-64 bg-cover bg-center flex flex-col justify-end items-center pb-8 text-white text-center" 
                 style="background-image: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 60%, transparent 100%), url('{{ $recipe['img'] }}');">
                <h3 class="font-bold text-xl md:text-2xl mb-4 px-4 drop-shadow-md">{{ $recipe['title'] }}</h3>
                <a href="{{ route('informasi.resep.detail') }}" class="text-orange-500 hover:text-orange-600 text-xs font-bold bg-white px-5 py-2 rounded-full shadow-md transition transform hover:scale-105">
                    Baca Selengkapnya <span class="ml-1">➔</span>
                </a>
            </div>
            <div class="bg-primary text-white text-center py-2.5 text-xs font-semibold tracking-wide">
                {{ $recipe['category'] }}
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