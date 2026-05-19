@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
    <!-- <div class="bg-cover bg-center h-[180px] flex items-center justify-center text-white font-bold text-3xl shadow-inner" style="background-image: linear-gradient(rgba(71, 96, 36, 0.7), rgba(71, 96, 36, 0.7)), url('https://images.unsplash.com/photo-1516467508483-a7212febe31a?q=80&w=1200');">
        Katalog Produk Mitra Hidup Sehat
    </div> -->

    <div class="max-w-7xl mx-auto px-4 mt-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex space-x-3 text-sm">
            <button class="bg-primary text-white px-4 py-2 rounded-full font-medium">Semua Produk</button>
            <button class="bg-white border border-gray-300 text-gray-600 px-4 py-2 rounded-full font-medium hover:bg-gray-50">Ayam Probiotik</button>
            <button class="bg-white border border-gray-300 text-gray-600 px-4 py-2 rounded-full font-medium hover:bg-gray-50">Telur Organik</button>
        </div>
        <div class="relative w-full md:w-80">
            <input type="text" placeholder="Cari produk sehat anda..." class="w-full border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
            <span class="absolute right-4 top-2.5 text-gray-400">🔍</span>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-2 md:grid-cols-4 gap-6">
        
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm flex flex-col justify-between group">
            <div class="relative bg-gray-100 p-4 h-48 flex items-center justify-center">
                <span class="absolute top-2 left-2 bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded">Ekspor Singapura</span>
                <span class="absolute top-2 right-2 cursor-pointer text-gray-400 group-hover:text-red-500">❤️</span>
                <img src="https://images.unsplash.com/photo-1604503468506-a8da13d82791?q=80&w=200" alt="Boneless Paha" class="object-cover max-h-full">
            </div>
            <div class="p-4 flex-grow flex flex-col justify-between">
                <div>
                    <p class="text-xs text-gray-400 font-medium">Ayam Probiotik</p>
                    <h4 class="font-bold text-sm text-gray-800 mb-1">Boneless Paha Cut (Skin On)</h4>
                    <p class="text-xs text-yellow-500 font-bold mb-3">⭐ 5.0</p>
                </div>
                <div class="flex items-center justify-between mt-2">
                    <span class="text-primary font-bold text-sm">Rp76.000,00</span>
                    <button class="bg-primary text-white text-xs px-3 py-1.5 rounded hover:bg-darkGreen transition">Beli</button>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm flex flex-col justify-between group">
            <div class="relative bg-gray-100 p-4 h-48 flex items-center justify-center">
                <span class="absolute top-2 left-2 bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded">Best Seller</span>
                <span class="absolute top-2 right-2 cursor-pointer text-gray-400">❤️</span>
                <img src="https://images.unsplash.com/photo-1604503468506-a8da13d82791?q=80&w=200" alt="Paha Bawah" class="object-cover max-h-full">
            </div>
            <div class="p-4 flex-grow flex flex-col justify-between">
                <div>
                    <p class="text-xs text-gray-400 font-medium">Ayam Probiotik</p>
                    <h4 class="font-bold text-sm text-gray-800 mb-1">Paha Bawah / Drumstick</h4>
                    <p class="text-xs text-yellow-500 font-bold mb-3">⭐ 5.0</p>
                </div>
                <div class="flex items-center justify-between mt-2">
                    <span class="text-primary font-bold text-sm">Rp65.500,00</span>
                    <button class="bg-primary text-white text-xs px-3 py-1.5 rounded hover:bg-darkGreen transition">Beli</button>
                </div>
            </div>
        </div>

        </div>

    <div class="max-w-7xl mx-auto px-4 pb-16 flex justify-center items-center space-x-2 text-sm text-gray-600">
        <button class="p-2 border rounded hover:bg-gray-100">◀</button>
        <button class="px-3 py-1 border bg-primary text-white rounded">1</button>
        <button class="px-3 py-1 border rounded hover:bg-gray-100">2</button>
        <button class="px-3 py-1 border rounded hover:bg-gray-100">3</button>
        <span>...</span>
        <button class="px-3 py-1 border rounded hover:bg-gray-100">150</button>
        <button class="p-2 border rounded hover:bg-gray-100">▶</button>
    </div>
@endsection