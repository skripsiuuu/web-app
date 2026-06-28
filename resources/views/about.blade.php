@extends('layouts.public')

@section('title', 'Tentang Kami')

@section('content')
    <div class="relative bg-cover bg-center h-[700px] flex flex-col justify-between items-center text-white" style="background-image: url('{{ asset('images/tentangkami/1/ternakAyam.png') }}');">
        <div class="w-full max-w-7xl mx-auto px-6 md:px-12 pt-8 z-10">
            <span class="text-sm font-semibold text-white/80">Tentang Kami</span>
        </div>
            <div class="max-w-5xl mx-auto px-4 w-full text-center my-auto z-10">
                <h1 class="text-3xl font-bold mb-8 text-white">Visi & Misi Perusahaan</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                    <div class="border border-white/40 p-6 rounded-lg bg-black/30 backdrop-blur-sm">
                        <h2 class="text-xl font-bold mb-3 tracking-wider border-b border-white/20 pb-2 text-white">VISI</h2>
                        <p class="text-sm leading-relaxed text-gray-200">
                            Menjadi penyedia pangan sehat dan organik terdepan yang terpercaya, serta berkomitmen penuh dalam meningkatkan kualitas hidup masyarakat melalui produk bernutrisi tinggi, alami, dan ramah lingkungan.
                        </p>
                    </div>

                    <div class="border border-white/40 p-6 rounded-lg bg-black/30 backdrop-blur-sm">
                        <h2 class="text-xl font-bold mb-3 tracking-wider border-b border-white/20 pb-2 text-white">MISI</h2>
                        <ul class="text-sm leading-relaxed text-gray-200 list-disc list-outside ml-4 space-y-3">
                            <li>Menyediakan produk pangan organik dan probiotik berkualitas premium yang terjamin kesegarannya serta bebas dari bahan kimia berbahaya.</li>
                            <li>Memastikan kemudahan akses bagi pelanggan dalam mendapatkan bahan makanan sehat secara cepat dan praktis melalui platform digital yang terintegrasi.</li>
                            <li>Mengedukasi dan menginspirasi masyarakat luas untuk mulai beralih dan konsisten menjalankan gaya hidup sehat yang berkelanjutan.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="max-w-6xl mx-auto px-4 py-32 grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
            <div>
                <h2 class="text-2xl font-bold text-[#476024] mb-4">Profil & Perkembangan<br>Mitra Hidup Sehat</h2>
                
                <p class="text-gray-600 leading-relaxed text-sm mb-4">
                    Mitra Hidup Sehat hadir sebagai jawaban atas kebutuhan masyarakat modern akan bahan pangan yang sehat, aman, dan berkualitas tinggi. Kami berfokus pada penyediaan produk peternakan premium, seperti ayam probiotik dan telur organik, yang dikelola secara profesional tanpa penggunaan bahan kimia maupun antibiotik berbahaya.
                </p>
                <p class="text-gray-600 leading-relaxed text-sm">
                    Seiring berjalannya waktu, perusahaan kami terus berinovasi dengan mengembangkan fasilitas produksi yang modern dan higienis. Melalui standar pengawasan mutu yang ketat, mulai dari proses peternakan, pengemasan, hingga distribusi. Mitra Hidup Sehat berkomitmen untuk selalu menjaga kesegaran gizi produk demi mendukung gaya hidup sehat keluarga Indonesia.
                </p>
            </div>
            <div>
                <img src="{{ asset('images/tentangkami/2/Pabrik Profil Perusahaan.png') }}" class="rounded-lg shadow-lg w-full object-cover h-[400px]" alt="Pabrik Mitra Hidup Sehat">
            </div>
        </div>

    <section class="relative bg-cover bg-center h-auto py-16 md:py-24 flex items-center text-white" style="background-image: url('{{ asset('images/tentangkami/3/BG.png') }}');">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 w-full text-center">
            <div class="mb-12 md:mb-16">
                <h2 class="text-3xl md:text-3xl font-bold mt-1">Nilai Pilar Perusahaan</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12">
                <div class="flex flex-col items-center text-center">
                    <div class="w-20 h-20 md:w-24 md:h-24 flex items-center justify-center mb-4">
                        <img src="{{ asset('images/tentangkami/3/Jaminan kualitas.png') }}" alt="Jaminan Kualitas" class="w-full h-full object-contain">
                    </div>
                    <h4 class="font-semibold text-lg md:text-xl leading-snug">Jaminan Kualitas</h4>
                </div>
                <div class="flex flex-col items-center text-center">
                    <div class="w-20 h-20 md:w-24 md:h-24 flex items-center justify-center mb-4">
                        <img src="{{ asset('images/tentangkami/3/Pasti organik.png') }}" alt="Pasti Organik" class="w-full h-full object-contain">
                    </div>
                    <h4 class="font-semibold text-lg md:text-xl leading-snug">Pasti Organik</h4>
                </div>
                <div class="flex flex-col items-center text-center">
                    <div class="w-20 h-20 md:w-24 md:h-24 flex items-center justify-center mb-4">
                        <img src="{{ asset('images/tentangkami/3/Kepercayaan konsumen.png') }}" alt="Kepercayaan Konsumen" class="w-full h-full object-contain">
                    </div>
                    <h4 class="font-semibold text-lg md:text-xl leading-snug">Kepercayaan Konsumen</h4>
                </div>
                <div class="flex flex-col items-center text-center">
                    <div class="w-20 h-20 md:w-24 md:h-24 flex items-center justify-center mb-4">
                        <img src="{{ asset('images/tentangkami/3/Kemitraan.png') }}" alt="Kemitraan" class="w-full h-full object-contain">
                    </div>
                    <h4 class="font-semibold text-lg md:text-xl leading-snug">Kemitraan</h4>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-20 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            
            <div class="text-center mb-20">
                <span class="text-xs font-bold uppercase tracking-widest text-primary bg-primary/10 px-3 py-1 rounded-full">Komitmen Mutu</span>
                <h2 class="text-3xl font-bold text-gray-800 mt-3 mb-4">Sertifikasi & Standar Resmi</h2>
                <p class="text-gray-500 max-w-2xl mx-auto text-sm">Produk kami diproses melalui pengawasan ketat dan telah memenuhi berbagai standar sertifikasi nasional hingga internasional.</p>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center justify-center mt-12 max-w-5xl mx-auto">
                    <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 flex flex-col items-center justify-center h-40 group">
                        <img src="{{ asset('images/sertifikasi/nkv.png') }}" alt="Sertifikat NKV" class="h-16 object-contain filter grayscale group-hover:grayscale-0 transition duration-300">
                        <span class="text-xs font-semibold text-gray-500 mt-4 group-hover:text-primary transition">Sertifikasi NKV</span>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 flex flex-col items-center justify-center h-40 group">
                        <img src="{{ asset('images/sertifikasi/halal.png') }}" alt="Halal Indonesia" class="h-16 object-contain filter grayscale group-hover:grayscale-0 transition duration-300">
                        <span class="text-xs font-semibold text-gray-500 mt-4 group-hover:text-primary transition">100% Halal Indonesia</span>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 flex flex-col items-center justify-center h-40 group">
                        <img src="{{ asset('images/sertifikasi/fssc22000.png') }}" alt="FSSC 22000" class="h-12 object-contain filter grayscale group-hover:grayscale-0 transition duration-300">
                        <span class="text-xs font-semibold text-gray-500 mt-4 group-hover:text-primary transition">FSSC 22000 Food Safety</span>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 flex flex-col items-center justify-center h-40 group">
                        <img src="{{ asset('images/sertifikasi/bangga-buatan-indonesia.png') }}" alt="Bangga Buatan Indonesia" class="h-16 object-contain filter grayscale group-hover:grayscale-0 transition duration-300">
                        <span class="text-xs font-semibold text-gray-500 mt-4 group-hover:text-primary transition">Bangga Buatan Indonesia</span>
                    </div>
                </div>
            </div>

            <div class="mt-24">
                <div class="text-center mb-12">
                    <span class="text-xs font-bold uppercase tracking-widest text-green-600 bg-green-50 px-3 py-1 rounded-full">Jaminan Kualitas Produk</span>
                    <h2 class="text-3xl font-bold text-gray-800 mt-3">Mengapa Memilih Produk Kami?</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-5 gap-6 max-w-6xl mx-auto">
                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200 transition-all duration-300 flex flex-col items-center text-center group">
                        <!-- <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                        </div> -->
                        <div class="w-16 h-16 bg-green-50 text-green-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                            <img src="{{ asset('images/tentangkami/5/bebassuntik.png') }}" class="w-full h-full object-contain p-3">
                        </div>  
                        <h3 class="font-bold text-gray-800 text-base mb-2">Bebas Suntik Hormon</h3>
                        <p class="text-gray-500 text-xs leading-relaxed">Tumbuh alami tanpa rekayasa hormon, jauh lebih aman dikonsumsi jangka panjang.</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200 transition-all duration-300 flex flex-col items-center text-center group">
                        <!-- <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div> -->
                         <div class="w-16 h-16 bg-green-50 text-green-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                            <img src="{{ asset('images/tentangkami/5/bebasresidu.png') }}" class="w-full h-full object-contain p-3">
                        </div>
                        <h3 class="font-bold text-gray-800 text-base mb-2">Bebas Residu Antibiotik</h3>
                        <p class="text-gray-500 text-xs leading-relaxed">Menghindari risiko resistensi bakteri pada tubuh Anda melalui pemeliharaan alami.</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200 transition-all duration-300 flex flex-col items-center text-center group">
                        <!-- <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div> -->
                         <div class="w-16 h-16 bg-green-50 text-green-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                            <img src="{{ asset('images/tentangkami/5/bebasflu.png') }}" class="w-full h-full object-contain p-3">
                        </div>
                        <h3 class="font-bold text-gray-800 text-base mb-2">Bebas Flu Burung</h3>
                        <p class="text-gray-500 text-xs leading-relaxed">Lingkungan peternakan bio-sekuriti tinggi memastikan hewan ternak bebas dari virus berbahaya.</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200 transition-all duration-300 flex flex-col items-center text-center group">
                        <!-- <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div> -->
                        <div class="w-16 h-16 bg-green-50 text-green-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                            <img src="{{ asset('images/tentangkami/5/bebasformalin.png') }}" class="w-full h-full object-contain p-3">
                        </div>
                        <h3 class="font-bold text-gray-800 text-base mb-2">Bebas Formalin</h3>
                        <p class="text-gray-500 text-xs leading-relaxed">Produk segar langsung didistribusikan tanpa pengawet kimia berbahaya.</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200 transition-all duration-300 flex flex-col items-center text-center group">
                        <!-- <div class="w-16 h-16 bg-green-50 text-green-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div> -->
                        <div class="w-16 h-16 bg-green-50 text-green-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                            <img src="{{ asset('images/tentangkami/5/vet.png') }}" alt="Ikon DrH" class="w-full h-full object-contain p-3">
                        </div>
                        <h3 class="font-bold text-gray-800 text-base mb-2">Diawasi Dokter Hewan</h3>
                        <p class="text-gray-500 text-xs leading-relaxed">Kesehatan hewan dipantau ketat secara medis di setiap prosesnya.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <div class="max-w-7xl mx-auto px-4 py-16 text-center">
        <h2 class="text-3xl font-bold text-primary mb-12">Produk Unggulan Kami</h2>
        <!-- Bungkus Utama (Atur jadi 2 kolom, ditaruh di tengah pakai max-w-5xl dan mx-auto) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-5xl mx-auto px-4 mt-8">
            
            <!-- Kartu 1: Telur Probiotik -->
            <div class="relative rounded-xl overflow-hidden shadow-lg h-[300px] flex flex-col justify-end p-6 text-white text-left bg-cover bg-center" style="background-image:linear-gradient(transparent, rgba(0,0,0,0.8)), url('{{ asset('images/tentangkami/4/Telur ayam probiotik.png') }}');">
                <h3 class="font-bold text-lg mb-2">Telur Ayam Organik</h3>
                <p class="text-xs text-gray-300 mb-4">Telur organik merupakan produk telur yang telah melewati serangkaian proses...</p>
                <a href="/produk?category=Telur%20Organik" class="bg-white text-[#476024] text-xs font-semibold px-4 py-2 rounded self-start hover:bg-gray-100 transition">Lihat Produk</a>
            </div>

            <!-- Kartu 2: Ayam Organik -->
            <div class="relative rounded-xl overflow-hidden shadow-lg h-[300px] flex flex-col justify-end p-6 text-white text-left bg-cover bg-center" style="background-image: linear-gradient(transparent, rgba(0,0,0,0.8)), url('{{ asset('images/tentangkami/4/Ayam sehat organik.png') }}');">
                <h3 class="font-bold text-lg mb-2">Ayam Probiotik</h3>
                <p class="text-xs text-gray-300 mb-4">Ayam potong segar organik, yang kami jaga sebaik mungkin dengan proses untuk menjamin...</p>
                <a href="/produk?category=Ayam%20Probiotik" class="bg-white text-[#476024] text-xs font-semibold px-4 py-2 rounded self-start hover:bg-gray-100 transition">Lihat Produk</a>
            </div>

        </div>
    </div>

 @endsection