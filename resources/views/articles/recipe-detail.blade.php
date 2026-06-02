@extends('layouts.public')

@section('title', 'Resep Omurice Khas Jepang')

@section('content')
    <div class="bg-[#F4F4F4] min-h-screen pb-24">
        <div class="max-w-6xl mx-auto px-4 md:px-8 pt-8">
            
            <nav class="text-xs md:text-sm font-semibold text-gray-800 mb-6">
                <a href="{{ route('informasi.index') }}" class="hover:text-primary transition">Informasi Menarik</a> 
                <span class="mx-1">|</span> 
                <a href="{{ route('informasi.resep') }}" class="hover:text-primary transition">Kumpulan Resep Inovatif</a>
            </nav>

            <div class="bg-[#EBE5D9] rounded-2xl p-6 md:p-8 flex flex-col md:flex-row gap-6 md:gap-8 items-center shadow-sm mb-10">
                <div class="w-full md:w-2/5 h-56 md:h-64 rounded-xl overflow-hidden shadow-sm">
                    <img src="{{ asset('images/informasi/resep/resep.png')}}" alt="Omurice" class="w-full h-full object-cover">
                </div>
                <div class="w-full md:w-3/5 flex flex-col justify-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-primary mb-3">Omurice khas Jepang</h1>
                    <div class="flex items-center space-x-6 text-xs text-gray-600 font-semibold mb-4">
                        <div class="flex items-center space-x-1.5">
                            <span>⏱️</span>
                            <span>Waktu Penyajian : 15 Menit</span>
                        </div>
                        <div class="flex items-center space-x-1.5">
                            <span>🍳</span>
                            <span>1 Servings</span>
                        </div>
                    </div>
                    <p class="text-gray-700 text-sm leading-relaxed text-justify">
                        Omurice khas Jepang merupakan hidangan berbasis telur dan nasi yang biasanya disajikan dengan cara membungkus nasi goreng saus tomat di dalam omelet telur yang lembut dan gurih...
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
                
                <div class="md:col-span-4 bg-[#EBE5D9] rounded-2xl p-6 md:p-8 shadow-sm h-full min-h-[450px]">
                    <h2 class="text-xl font-bold text-primary tracking-wide text-center border-b border-gray-300 pb-3 mb-6">
                        BAHAN-BAHAN
                    </h2>
                    <ul class="text-gray-800 text-sm font-semibold space-y-4 pl-2">
                        <li>• 3 butir telur</li>
                        <li>• 1 sdm garam</li>
                        <li>• 1 sdm penyedap rasa</li>
                        </ul>
                </div>

                <div class="hidden md:flex md:col-span-1 justify-center h-full min-h-[450px]">
                    <div class="w-[2px] bg-primary/40 h-full rounded-full"></div>
                </div>

                <div class="md:col-span-7 p-2">
                    <h2 class="text-xl font-bold text-primary tracking-wide mb-6 border-b border-gray-200 pb-3 md:text-left text-center">
                        CARA PENYAJIAN
                    </h2>
                    <ol class="text-gray-800 text-sm font-medium space-y-4">
                        <li class="flex items-start"><span class="font-bold text-primary mr-2">1.)</span> Persiapkan bahan-bahan utama dan kocok lepas telur.</li>
                        <li class="flex items-start"><span class="font-bold text-primary mr-2">2.)</span> Panaskan sedikit minyak di wajan anti lengket.</li>
                        <li class="flex items-start"><span class="font-bold text-primary mr-2">3.)</span> ...</li>
                        <li class="flex items-start"><span class="font-bold text-primary mr-2">4.)</span> ...</li>
                        <li class="flex items-start"><span class="font-bold text-primary mr-2">5.)</span> ...</li>
                        <li class="flex items-start"><span class="font-bold text-primary mr-2">6.)</span> ...</li>
                        <li class="flex items-start"><span class="font-bold text-primary mr-2">7.)</span> ...</li>
                        <li class="flex items-start"><span class="font-bold text-primary mr-2">8.)</span> ...</li>
                        <li class="flex items-start"><span class="font-bold text-primary mr-2">9.)</span> ...</li>
                        <li class="flex items-start"><span class="font-bold text-primary mr-2">10.)</span> Hidangkan Omurice selagi hangat dengan saus di atasnya.</li>
                    </ol>
                </div>

            </div>

        </div>
    </div>
@endsection