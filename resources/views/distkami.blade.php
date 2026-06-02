@extends('layouts.public')

@section('title', 'Distribusi Kami')

@section('content')
<div class="bg-[#F4F4F4] min-h-screen font-sans antialiased text-[#1E352F]">

    <div class="relative bg-cover bg-center h-[420px] w-full text-white" 
     style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(0,0,0,0.3)), url('{{ asset('images/distribusi/hero-distribusi.png') }}');">
    
    <div class="absolute inset-0 flex flex-col justify-between pb-24">
        <div class="w-full max-w-7xl mx-auto px-6 md:px-12 pt-8">
            <span class="text-sm font-semibold text-white/80">Distribusi Kami</span>
        </div>

        <div class="max-w-4xl mx-auto text-center px-4 mt-6 mb-auto">
            <h1 class="text-2xl md:text-4xl font-bold leading-tight drop-shadow-md">
                Kami Disini Menghadirkan<br>Produk Organik Terjangkau Untuk Anda
            </h1>
        </div>
    </div>

    <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 w-full max-w-5xl px-4 z-20">
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 border border-gray-100 text-[#1E352F]">
            <h3 class="text-xl font-bold mb-4 text-[#3A5A40]">Alamat Kami</h3>
            <div class="flex flex-col md:flex-row gap-6 items-center">
                <div class="w-full md:w-1/3 h-28 rounded-lg overflow-hidden shadow-sm border border-gray-200">
                    <img src="{{ asset('images/distribusi/map-placeholder.png') }}" class="w-full h-full object-cover" alt="Maps">
                </div>
                <div class="w-full md:w-2/3">
                    <h4 class="font-bold text-lg">PT Mitra Hidup Sehat</h4>
                    <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                        92 Avenix, Jl. Raya Jl. Raya Serpong - Lapan No.12, Sampora, Kec. Cisauk, Kabupaten Tangerang, Banten 15345
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="h-32 md:h-24"></div>

    <!-- <div class="relative bg-cover bg-center h-[420px] flex flex-col justify-between text-white" 
         style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(0,0,0,0.3)), url('{{ asset('images/distribusi/hero-distribusi.png') }}');">
        
        <div class="w-full max-w-7xl mx-auto px-6 md:px-12 pt-8 z-10">
            <span class="text-sm font-semibold text-white/80">Distribusi Kami</span>
        </div>

        <div class="max-w-4xl mx-auto text-center px-4 mb-24 -mt-10 z-10">
            <h1 class="text-2xl md:text-4xl font-bold leading-tight drop-shadow-md">
                Kami Disini Menghadirkan<br>Produk Organik Terjangkau Untuk Anda
            </h1>
        </div>

        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 w-full max-w-5xl px-4 z-20">
            <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl p-6 md:p-8 border border-gray-100 text-[#1E352F]">
                <h3 class="text-xl font-bold mb-4 text-[#3A5A40]">Alamat Kami</h3>
                <div class="flex flex-col md:flex-row gap-6 items-center">
                    <div class="w-full md:w-1/3 h-28 rounded-lg overflow-hidden shadow-sm border border-gray-200">
                        <img src="{{ asset('images/distribusi/map-placeholder.png') }}" class="w-full h-full object-cover" alt="Maps">
                    </div>
                    <div class="w-full md:w-2/3">
                        <h4 class="font-bold text-lg">PT Mitra Hidup Sehat</h4>
                        <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                            B2, Aventix, Jl. Raya Jl. Raya Serpong - Lapan No.12, Sampora, Kec. Cisauk, Kabupaten Tangerang, Banten 15345
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="h-32 md:h-24"></div>

    <div class="max-w-6xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-200">
            <img src="{{ asset('images/distribusi/kemitraan.png') }}" class="w-full h-[280px] object-cover" alt="Kemitraan Terbuka">
        </div>
        <div>
            <h2 class="text-2xl font-bold text-[#3A5A40] mb-4">Kemitraan Terbuka</h2>
            <p class="text-gray-600 leading-relaxed text-sm text-justify">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisi malesuada lacinia integer nunc posuere.
            </p>
        </div>
    </div>

    <div class="relative bg-cover bg-center py-16 text-white text-center" 
         style="background-image: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), url('{{ asset('images/distribusi/bg-mitra.png') }}');">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-2xl font-bold mb-10">Mitra Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="flex flex-col justify-between items-center h-full">
                    <p class="text-xs text-gray-200 leading-relaxed italic px-4">
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis."
                    </p>
                    <h4 class="font-bold tracking-wider mt-6 uppercase border-t border-white/20 pt-2 w-1/2 text-center">Partner</h4>
                </div>
                <div class="flex flex-col justify-between items-center h-full">
                    <p class="text-xs text-gray-200 leading-relaxed italic px-4">
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis."
                    </p>
                    <h4 class="font-bold tracking-wider mt-6 uppercase border-t border-white/20 pt-2 w-1/2 text-center">Partner</h4>
                </div>
                <div class="flex flex-col justify-between items-center h-full">
                    <p class="text-xs text-gray-200 leading-relaxed italic px-4">
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis."
                    </p>
                    <h4 class="font-bold tracking-wider mt-6 uppercase border-t border-white/20 pt-2 w-1/2 text-center">Partner</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-20 text-center">
        <h2 class="text-2xl font-bold text-[#3A5A40] mb-12">Benefit Kemitraan</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-[#EAEAEA] rounded-2xl overflow-hidden shadow-sm h-[320px] flex flex-col">
                <div class="h-2/3 overflow-hidden">
                    <img src="{{ asset('images/distribusi/benefit-telur.png') }}" class="w-full h-full object-cover" alt="Benefit 1">
                </div>
                <div class="h-1/3 flex items-center justify-center p-4">
                    </div>
            </div>
            <div class="bg-[#EAEAEA] rounded-2xl overflow-hidden shadow-sm h-[320px] flex flex-col">
                <div class="h-2/3 overflow-hidden">
                    <img src="{{ asset('images/distribusi/benefit-telur.png') }}" class="w-full h-full object-cover" alt="Benefit 2">
                </div>
                <div class="h-1/3 flex items-center justify-center p-4">
                </div>
            </div>
            <div class="bg-[#EAEAEA] rounded-2xl overflow-hidden shadow-sm h-[320px] flex flex-col">
                <div class="h-2/3 overflow-hidden">
                    <img src="{{ asset('images/distribusi/benefit-telur.png') }}" class="w-full h-full object-cover" alt="Benefit 3">
                </div>
                <div class="h-1/3 flex items-center justify-center p-4">
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-6 pb-24">
        <div class="bg-[#E5E5E5] rounded-2xl py-16 flex flex-col items-center justify-center shadow-inner">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/LogoMHS.png') }}" class="w-160 h-160 object-contain" alt="Logo Mitra Hidup Sehat">
            </div>
        </div>
    </div>

</div>
@endsection