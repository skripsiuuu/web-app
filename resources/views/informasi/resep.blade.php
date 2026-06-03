@extends('layouts.public')

@section('title', 'Kumpulan Resep Inovatif')

@section('content')
    <div class="relative bg-cover bg-center h-[300px] text-white flex flex-col" 
         style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('images/informasi/resep/hero.png') }}');"> 
        <div class="w-full max-w-7xl mx-auto px-4 md:px-8 relative z-10 h-full flex flex-col pt-6 pb-12">
            
            <nav class="text-xs md:text-sm font-medium opacity-90 mb-auto">
                <a href="{{ route('informasi.index') }}" class="hover:text-green-200 transition">Informasi Menarik</a> 
                <span class="mx-1">|</span> 
                <span class="font-bold">Kumpulan Resep Inovatif</span>
            </nav>

            <div class="flex flex-col items-center text-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-3 tracking-tight">Kumpulan Resep Inovatif</h1>
                <p class="max-w-2xl text-sm md:text-base opacity-90">
                    Berbagai pilihan resep inovatif untuk mengolah produk dari kami menjadi hidangan untuk disajikan di meja makan Anda.
                </p>
            </div>
            
            <div class="mt-auto"></div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 mt-8 flex flex-col items-center">
        <form action="{{ route('informasi.resep') }}" method="GET" class="relative w-full max-w-xl mb-6">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari resep..." class="w-full border border-gray-300 rounded-full pl-4 pr-12 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#476024] shadow-sm">
            <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 opacity-50 hover:opacity-100 transition">
                <img src="{{ asset('images/icons/search.png') }}" alt="Cari" class="w-5 h-5">
            </button>
        </form> 

        <div class="flex flex-wrap justify-center gap-3 text-xs font-bold mb-10">
            @php $currentCat = request('category'); @endphp
            
            <a href="{{ route('informasi.resep') }}" class="px-5 py-2.5 rounded-full transition shadow-sm {{ empty($currentCat) ? 'bg-[#476024] text-white border border-[#476024]' : 'bg-white border border-gray-300 text-gray-600 hover:bg-gray-50' }}">Semua Resep</a>
            
            <a href="{{ route('informasi.resep', ['category' => 'Resep Olahan Telur']) }}" class="px-5 py-2.5 rounded-full transition shadow-sm {{ $currentCat == 'Resep Olahan Telur' ? 'bg-[#476024] text-white border border-[#476024]' : 'bg-white border border-gray-300 text-gray-600 hover:bg-gray-50' }}">Resep Olahan Telur</a>
            
            <a href="{{ route('informasi.resep', ['category' => 'Resep Olahan Ayam']) }}" class="px-5 py-2.5 rounded-full transition shadow-sm {{ $currentCat == 'Resep Olahan Ayam' ? 'bg-[#476024] text-white border border-[#476024]' : 'bg-white border border-gray-300 text-gray-600 hover:bg-gray-50' }}">Resep Olahan Ayam</a>
            
            <a href="{{ route('informasi.resep', ['category' => 'Resep Olahan Sayuran']) }}" class="px-5 py-2.5 rounded-full transition shadow-sm {{ $currentCat == 'Resep Olahan Sayuran' ? 'bg-[#476024] text-white border border-[#476024]' : 'bg-white border border-gray-300 text-gray-600 hover:bg-gray-50' }}">Resep Olahan Sayuran</a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 pb-16">
        @if($recipes->isEmpty())
            <div class="text-center py-10 text-gray-500">Belum ada resep yang tersedia.</div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($recipes as $item)
                <div class="relative rounded-2xl overflow-hidden shadow-md group h-[280px]">
                    <img src="{{ asset('images/resep/' . $item->image) }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 z-0">
                    <div class="absolute inset-0 bg-black/60 z-10"></div>
                    
                    <div class="absolute inset-0 z-20 flex flex-col justify-center items-center p-6 text-center">
                        <h3 class="text-white font-bold text-xl md:text-2xl mb-4">{{ $item->title }}</h3>
                        <a href="{{ route('informasi.resep.detail', $item->slug) }}" class="bg-white text-orange-600 font-bold text-[10px] px-4 py-2 rounded-full hover:bg-orange-50 transition tracking-wide">
                            Baca Selengkapnya
                        </a>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 bg-[#3a4f1c] text-white text-center py-2.5 text-xs font-semibold z-20">
                        {{ $item->category }}
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $recipes->links('paginasi') }}
            </div>
        @endif
    </div>
@endsection