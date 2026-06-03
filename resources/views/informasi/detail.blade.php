@extends('layouts.public')

@section('title', $article->title)

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-10 md:py-16">
        
        <nav class="text-xs md:text-sm font-semibold text-gray-800 mb-6 flex items-center space-x-2">
            <a href="{{ route('informasi.index') }}" class="hover:text-gray-500 transition">Informasi Menarik</a>
            <span class="text-gray-400">|</span>
            <span class="text-[#476024]">{{ $article->category }}</span>
        </nav>

        <div class="w-full h-[300px] md:h-[500px] rounded-2xl overflow-hidden mb-8 shadow-sm">
            <img src="{{ asset('images/artikel/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
        </div>

        <div class="mb-10 pb-6 border-b border-gray-100">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                {{ $article->title }}
            </h1>
            <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4 text-sm">
                <span class="text-orange-500 font-bold uppercase tracking-wider">{{ $article->category }}</span>
                <span class="hidden sm:inline text-gray-300">|</span>
                <span class="text-gray-600 font-medium">Oleh : Tim Mitra Hidup Sehat</span>
                <span class="hidden sm:inline text-gray-300">|</span>
                <span class="text-gray-500">{{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y') }}</span>
            </div>
        </div>

        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed article-content">
            {!! $article->content !!}
        </div>

        <div class="mt-16 pt-8 border-t border-gray-100">
            <button onclick="history.back()" class="bg-white border border-[#476024] text-[#476024] px-6 py-2.5 rounded-lg hover:bg-[#476024] hover:text-white transition font-bold text-sm flex items-center">
                Kembali
            </button>
        </div>

    </div>

    <style>
        .article-content p {
            margin-bottom: 1.5rem;
            text-align: justify;
        }
        .article-content h4 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #111827;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
        }
        .article-content ul {
            list-style-type: disc;
            padding-left: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .article-content li {
            margin-bottom: 0.5rem;
        }
    </style>
@endsection