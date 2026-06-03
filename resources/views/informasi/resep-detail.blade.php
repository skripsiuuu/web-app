@extends('layouts.public')

@section('title', $recipe->title)

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-10">
        
        <nav class="text-xs md:text-sm font-medium text-gray-600 mb-8">
            <a href="{{ route('informasi.index') }}" class="hover:text-gray-900">Informasi Menarik</a> 
            <span class="mx-2">|</span> 
            <a href="{{ route('informasi.resep') }}" class="hover:text-gray-900">Kumpulan Resep Inovatif</a>
        </nav>

        <div class="bg-[#f7f4ec] rounded-2xl p-6 md:p-8 flex flex-col md:flex-row gap-8 items-center mb-12 shadow-sm">
            <div class="w-full md:w-5/12 h-64 rounded-xl overflow-hidden shadow-md">
                <img src="{{ asset('images/resep/' . $recipe->image) }}" class="w-full h-full object-cover">
            </div>
            <div class="w-full md:w-7/12">
                <h1 class="text-3xl md:text-4xl font-bold text-[#3a4f1c] mb-4">{{ $recipe->title }}</h1>
                <div class="flex items-center text-xs md:text-sm font-bold text-gray-600 gap-6 mb-4">
                    <span class="text-[#8c564b]">{{ $recipe->category }}</span>
                    <span>|</span>
                    <span>Oleh : Tim Mitra Hidup Sehat</span>
                </div>
                <div class="flex items-center text-xs font-semibold text-gray-500 gap-6 mb-6 bg-white inline-flex px-4 py-2 rounded-lg border border-gray-200">
                    <span>⏱ Waktu Penyajian : {{ $recipe->prep_time }}</span>
                    <span>🍽 {{ $recipe->servings }}</span>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed">
                    {{ $recipe->description }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            
            <div class="md:col-span-1">
                <div class="bg-[#f7f4ec] rounded-2xl p-8 shadow-sm">
                    <h3 class="text-center font-bold text-[#3a4f1c] tracking-widest mb-8">BAHAN-BAHAN</h3>
                    <div class="recipe-ingredients text-sm text-gray-700 leading-loose">
                        {!! $recipe->ingredients !!}
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="mb-8">
                    <h3 class="font-bold text-[#3a4f1c] tracking-widest border-b-2 border-[#3a4f1c] pb-2 inline-block">CARA PENYAJIAN</h3>
                </div>
                <div class="recipe-instructions text-sm text-gray-700 leading-loose">
                    {!! $recipe->instructions !!}
                </div>
            </div>

        </div>
    </div>

    <style>
        /* Desain list bahan-bahan (titik) */
        .recipe-ingredients ul {
            list-style-type: disc;
            padding-left: 1.5rem;
        }
        .recipe-ingredients li {
            margin-bottom: 0.75rem;
            font-weight: 500;
        }
        
        /* Desain list cara masak (angka) */
        .recipe-instructions ol {
            list-style-type: decimal;
            padding-left: 1.5rem;
        }
        .recipe-instructions li {
            margin-bottom: 1.5rem;
            text-align: justify;
        }
        .recipe-instructions li::marker {
            font-weight: bold;
            color: #3a4f1c;
        }
    </style>
@endsection