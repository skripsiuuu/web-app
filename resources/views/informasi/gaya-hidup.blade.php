@extends('layouts.public')

@section('title', 'Artikel Gaya Hidup Sehat')

@section('content')
    <div class="relative bg-cover bg-center h-[300px] text-white flex flex-col" 
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('{{ asset('images/informasi/gh/hero.png') }}');"> 
        
        <div class="w-full max-w-7xl mx-auto px-4 md:px-8 relative z-10 h-full flex flex-col pt-6 pb-12">
            
            <nav class="text-xs md:text-sm font-medium opacity-90 mb-auto">
                <a href="{{ route('informasi.index') }}" class="hover:text-green-200 transition">Informasi Menarik</a> 
                <span class="mx-1">|</span> 
                <span class="font-bold">Artikel Gaya Hidup Sehat</span>
            </nav>
            
            <div class="flex flex-col items-center text-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-3 tracking-tight drop-shadow-md">
                    Artikel Gaya Hidup Sehat
                </h1>
                <p class="max-w-2xl text-sm md:text-base leading-relaxed opacity-90 drop-shadow-md text-gray-100">
                    Informasi seputar gaya hidup sehat yang bisa kamu terapkan sehari-hari untuk menjaga kondisi tubuh tetap prima dan bugar.
                </p>
            </div>
            
            <div class="mt-auto"></div>
        </div>
        
    </div>

    <!-- <div class="relative bg-cover bg-center h-[300px] flex flex-col justify-between items-center text-white" style="background-image: url('{{ asset('images/informasi/hero.png') }}');"> 
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <nav class="text-xs mb-4 opacity-80">
                <a href="/informasi" class="hover:underline">Informasi Menarik</a> / <span class="font-semibold">Artikel Gaya Hidup Sehat</span>
            </nav>
            <h1 class="text-3xl md:text-4xl font-bold mb-4 tracking-tight">Artikel Gaya Hidup Sehat</h1>
            <p class="max-w-2xl text-sm leading-relaxed opacity-90">
                Informasi seputar gaya hidup sehat yang bisa kamu terapkan sehari-hari untuk menjaga kondisi tubuh tetap prima dan bugar.
            </p>
        </div>
    </div> -->

    <!-- <div class="max-w-7xl mx-auto px-4 mt-8">
        <div class="bg-white p-4 rounded-xl shadow-lg flex items-center">
            <input type="text" placeholder="Cari judul artikel gaya hidup sehat..." class="w-full px-4 py-2 text-sm border-none focus:ring-0 outline-none font-medium">
            <button class="bg-primary text-white p-2 rounded-lg ml-2 hover:bg-darkGreen transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>
    </div> -->
    <div class="max-w-7xl mx-auto px-4 mt-8">
        <div class="bg-white p-4 rounded-xl shadow-lg flex items-center">
            <input type="text" placeholder="Cari judul artikel gaya hidup sehat..." class="w-full px-4 py-2 text-sm border-none focus:ring-0 outline-none font-medium">
            <button class="bg-primary text-white p-2 rounded-lg ml-2 hover:bg-darkGreen transition flex items-center justify-center">
                <img src="{{ asset('images/icons/search.png') }}" alt="Icon Cari" class="w-7 h-7 object-contain">
            </button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            
            {{-- Data Dummy untuk Simulasi Grid 3x3 --}}
            @php
                $articles = [
                    ['category' => 'Olahraga', 'title' => 'Manfaat lari pagi untuk menjaga kondisi', 'img' => asset('images/informasi/article.png')],
                    ['category' => 'Olahraga', 'title' => 'Manfaat lari pagi untuk menjaga kondisi', 'img' => asset('images/informasi/article.png')],
                    ['category' => 'Olahraga', 'title' => 'Manfaat lari pagi untuk menjaga kondisi', 'img' => asset('images/informasi/article.png')],
                    ['category' => 'Olahraga', 'title' => 'Manfaat lari pagi untuk menjaga kondisi', 'img' => asset('images/informasi/article.png')],
                    ['category' => 'Olahraga', 'title' => 'Manfaat lari pagi untuk menjaga kondisi', 'img' => asset('images/informasi/article.png')],
                    ['category' => 'Olahraga', 'title' => 'Manfaat lari pagi untuk menjaga kondisi', 'img' => asset('images/informasi/article.png')],
                    ['category' => 'Olahraga', 'title' => 'Manfaat lari pagi untuk menjaga kondisi', 'img' => asset('images/informasi/article.png')],
                    ['category' => 'Olahraga', 'title' => 'Manfaat lari pagi untuk menjaga kondisi', 'img' => asset('images/informasi/article.png')],
                    ['category' => 'Olahraga', 'title' => 'Manfaat lari pagi untuk menjaga kondisi', 'img' => asset('images/informasi/article.png')],
                ];
            @endphp

            @foreach($articles as $item)
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                <div class="h-56 overflow-hidden">
                    <img src="{{ $item['img'] }}" alt="Lifestyle" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <span class="text-orange-500 text-xs font-bold uppercase tracking-widest">{{ $item['category'] }}</span>
                    <h3 class="text-gray-800 font-bold text-lg mt-2 leading-tight">
                        {{ $item['title'] }}
                    </h3>
                    <p class="text-gray-500 text-xs mt-3 leading-relaxed">
                        Menjaga kondisi tubuh agar tetap sehat merupakan hal yang sangat penting...
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('informasi.gaya-hidup.detail') }}" class="inline-block border border-orange-500 text-orange-500 text-xs font-bold px-5 py-2.5 rounded-lg hover:bg-orange-500 hover:text-white transition duration-300">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="mt-16 flex justify-center items-center space-x-2">
            <button class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button class="w-10 h-10 flex items-center justify-center rounded-full bg-primary text-white font-bold text-sm shadow-md">1</button>
            <button class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 text-sm hover:bg-gray-50">2</button>
            <button class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 text-sm hover:bg-gray-50">3</button>
            <span class="px-2 text-gray-400 text-sm">...</span>
            <button class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 text-sm hover:bg-gray-50">150</button>
            <button class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
@endsection