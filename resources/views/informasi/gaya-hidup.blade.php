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

    <div class="max-w-7xl mx-auto px-4 mt-8">
        <form action="{{ route('informasi.gaya-hidup') }}" method="GET" class="bg-white p-4 rounded-xl shadow-lg flex items-center border border-gray-100">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul artikel gaya hidup sehat..." class="w-full px-4 py-2 text-sm border-none focus:ring-0 outline-none font-medium text-gray-700">
            <button type="submit" class="bg-[#476024] text-white p-2.5 rounded-lg ml-2 hover:bg-[#364a1b] transition flex items-center justify-center">
                <img src="{{ asset('images/icons/search.png') }}" alt="Icon Cari" class="w-6 h-6 object-contain" style="filter: brightness(0) invert(1);">
            </button>
        </form>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-16">
        
        @if($articles->isEmpty())
            <div class="text-center py-10">
                <p class="text-gray-500 font-medium text-lg">Belum ada artikel yang tersedia saat ini.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                
                @foreach($articles as $item)
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 overflow-hidden group flex flex-col">
                    <div class="h-56 overflow-hidden">
                        <img src="{{ asset('images/artikel/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-orange-500 text-xs font-bold uppercase tracking-widest">{{ $item->category }}</span>
                        
                        <a href="{{ route('informasi.gaya-hidup.detail', $item->slug) }}">
                            <h3 class="text-gray-800 font-bold text-lg mt-2 leading-tight hover:text-[#476024] transition">
                                {{ Str::limit($item->title, 50) }}
                            </h3>
                        </a>
                        
                        <p class="text-gray-500 text-xs mt-3 leading-relaxed flex-grow">
                            {{ Str::limit($item->excerpt ?? strip_tags($item->content), 100) }}
                        </p>
                        
                        <div class="mt-6">
                            <a href="{{ route('informasi.gaya-hidup.detail', $item->slug) }}" class="inline-block border border-orange-500 text-orange-500 text-xs font-bold px-5 py-2.5 rounded-lg hover:bg-orange-500 hover:text-white transition duration-300">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            <div class="mt-16 flex justify-center">
                {{ $articles->links() }}
            </div>
        @endif
        
    </div>
@endsection