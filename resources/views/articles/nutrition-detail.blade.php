@extends('layouts.public')

@section('title', 'Mengenal Karbohidrat : Manfaat, Jenis, dan Sumbernya')

@section('content')
    <div class="bg-[#F4F4F4] min-h-screen pb-24">
        <div class="max-w-6xl mx-auto px-4 md:px-8 pt-8">
            
            <nav class="text-xs md:text-sm font-semibold text-gray-800 mb-6">
                <a href="{{ route('informasi.index') }}" class="hover:text-primary transition">Informasi Menarik</a> 
                <span class="mx-1">|</span> 
                <a href="{{ route('informasi.gizi') }}" class="hover:text-primary transition">Informasi Gizi & Nutrisi</a>
            </nav>

            <div class="bg-[#EBE5D9] rounded-2xl p-6 md:p-8 flex flex-col md:flex-row gap-6 md:gap-8 items-center shadow-sm mb-10">
                <div class="w-full md:w-2/5 h-56 md:h-64 rounded-xl overflow-hidden shadow-sm">
                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=500" alt="Karbohidrat" class="w-full h-full object-cover">
                </div>
                <div class="w-full md:w-3/5 flex flex-col justify-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-primary mb-3">
                        Mengenal Karbohidrat : Manfaat, Jenis, dan Sumbernya
                    </h1>
                    <div class="flex items-center space-x-4 text-xs font-bold mb-4">
                        <span class="text-[#E76F51]">Makronutrisi</span>
                        <span class="text-gray-400">|</span>
                        <span class="text-gray-600">Oleh : Dupon</span>
                    </div>
                    <p class="text-gray-700 text-sm leading-relaxed text-justify">
                        Karbohidrat sering kali dianggap sebagai pemicu kenaikan berat badan, padahal zat gizi makro ini memegang peranan krusial sebagai sumber energi utama tubuh...
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
                
                <div class="md:col-span-4 bg-[#EBE5D9] rounded-2xl p-6 md:p-8 shadow-sm h-full min-h-[450px]">
                    <h2 class="text-lg font-bold text-primary tracking-wide text-center border-b border-gray-300 pb-3 mb-6">
                        POIN UTAMA
                    </h2>
                    <ul class="text-gray-800 text-sm font-semibold space-y-4 pl-2">
                        <li>• Apa itu Karbohidrat?</li>
                        <li>• Fungsi Utama Bagi Tubuh</li>
                        <li>• Karbohidrat Sederhana</li>
                        <li>• Karbohidrat Kompleks</li>
                        <li>• Sumber Terbaik Sehari-hari</li>
                    </ul>
                </div>

                <div class="hidden md:flex md:col-span-1 justify-center h-full min-h-[450px]">
                    <div class="w-[2px] bg-primary/40 h-full rounded-full"></div>
                </div>

                <div class="md:col-span-7 p-2">
                    <h2 class="text-xl font-bold text-primary tracking-wide mb-6 border-b border-gray-200 pb-3 md:text-left text-center">
                        PEMBAHASAN ARTIKEL
                    </h2>
                    <div class="text-gray-800 text-sm leading-relaxed space-y-6 text-justify">
                        <div>
                            <h3 class="font-bold text-base text-primary mb-1">1. Apa itu Karbohidrat?</h3>
                            <p>Karbohidrat adalah senyawa organik yang terdiri dari karbon, hidrogen, dan oksigen yang menjadi bahan bakar biologis bagi metabolisme tubuh manusia.</p>
                        </div>
                        <div>
                            <h3 class="font-bold text-base text-primary mb-1">2. Fungsi Utama Bagi Tubuh</h3>
                            <p>Selain memasok energi untuk otak dan otot, karbohidrat juga berfungsi menjaga massa otot agar tubuh tidak memecah protein otot sebagai sumber energi cadangan.</p>
                        </div>
                        <div>
                            <h3 class="font-bold text-base text-primary mb-1">3. Karbohidrat Kompleks vs Sederhana</h3>
                            <p>Karbohidrat kompleks (seperti beras merah dan oatmeal) membutuhkan waktu lebih lama untuk dicerna, sehingga memberikan rasa kenyang lebih lama dan menjaga gula darah tetap stabil dibandingkan karbohidrat sederhana.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection