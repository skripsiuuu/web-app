@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center space-x-2">
        
        {{-- Tombol "Previous" (Mundur) --}}
        @if ($paginator->onFirstPage())
            <span class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 text-gray-400 bg-gray-50 cursor-not-allowed">
                &laquo;
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 text-gray-600 bg-white hover:bg-gray-50 hover:text-[#476024] transition">
                &laquo;
            </a>
        @endif

        {{-- Nomor Halaman --}}
        @foreach ($elements as $element)
            
            {{-- Kalau ada jarak (Titik Tiga "...") --}}
            @if (is_string($element))
                <span class="w-10 h-10 flex items-center justify-center text-gray-400 text-sm">
                    {{ $element }}
                </span>
            @endif

            {{-- Deretan Angka --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        {{-- Halaman yang lagi aktif (Warna Hijau) --}}
                        <span class="w-10 h-10 flex items-center justify-center rounded-full bg-[#476024] text-white font-bold text-sm shadow-md" aria-current="page">
                            {{ $page }}
                        </span>
                    @else
                        {{-- Halaman lain yang belum diklik --}}
                        <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 text-sm text-gray-600 hover:bg-gray-50 hover:text-[#476024] transition border-transparent hover:border-gray-300">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Tombol "Next" (Maju) --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 text-gray-600 bg-white hover:bg-gray-50 hover:text-[#476024] transition">
                &raquo;
            </a>
        @else
            <span class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 text-gray-400 bg-gray-50 cursor-not-allowed">
                &raquo;
            </span>
        @endif
        
    </nav>
@endif