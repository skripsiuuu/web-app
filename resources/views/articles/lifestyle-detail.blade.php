@extends('layouts.public')

@section('title', 'Manfaat lari pagi untuk menjaga cardio')

@section('content')
    <div class="bg-[#F8F9FA] min-h-screen pb-24">
        
        <div class="max-w-5xl mx-auto px-6 md:px-8 pt-8">
            
            <nav class="text-xs md:text-sm font-semibold text-gray-800 mb-6 flex items-center space-x-2">
                <a href="{{ route('informasi.index') }}" class="hover:text-primary transition">Informasi Menarik</a>
                <span>|</span>
                <a href="{{ route('informasi.gaya-hidup') }}" class="hover:text-primary transition">Artikel Gaya Hidup Sehat</a>
            </nav>

            <div class="w-full h-[300px] md:h-[500px] overflow-hidden mb-8 rounded-2xl shadow-sm">
                <img src="{{ asset('images/informasi/article.png')}}"
                    alt="Orang Lari Pagi" 
                    class="w-full h-full object-cover">
            </div>

            <div class="mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-[#2d3e17] tracking-tight mb-2">
                    Manfaat lari pagi untuk menjaga cardio
                </h1>
                <p class="text-[#E76F51] font-bold text-sm mb-1">
                    Olahraga
                </p>
                <p class="text-gray-600 font-semibold text-xs md:text-sm">
                    Oleh : Dupon
                </p>
            </div>

            <div class="text-gray-700 leading-loose space-y-6 text-sm md:text-base text-justify">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere.
                </p>
                <p>
                    Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos. Suspendisse potenti. Nam nec ante nec diam pellentesque laoreet. Phasellus eleifend, libero at sagittis sodales, lectus felis convallis ligula, vitae fermentum sapien neque ut nisi.
                </p>
                <p>
                    Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed sodales aliquam nisl, sit amet feugiat enim convallis eu. Nullam ultricies, lorem in scelerisque facilisis, felis lorem vestibulum erat, eget elementum mi nunc nec diam.
                </p>
            </div>

        </div>
    </div>
@endsection