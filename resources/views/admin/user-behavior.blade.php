<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.users') }}" class="text-gray-400 hover:text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tinjauan Perilaku: {{ $user->name }}</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 shadow-sm sm:rounded-xl border border-gray-100 flex flex-col md:flex-row items-center gap-6">
                <div class="w-16 h-16 bg-green-100 text-green-700 flex items-center justify-center rounded-full text-2xl font-black uppercase border border-green-200">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div class="flex-1 text-center md:text-left">
                    <h3 class="text-xl font-bold text-gray-800">{{ $user->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                </div>
                <div class="text-center md:text-right">
                    <p class="text-xs text-gray-400">Tanggal Bergabung</p>
                    <p class="text-sm font-bold text-gray-700">{{ $user->created_at->format('d F Y') }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6">
                <h4 class="text-lg font-bold text-gray-800 border-b pb-3 mb-4">Riwayat Ulasan Produk</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($reviews as $review)
                        <div class="p-5 border border-gray-200 rounded-xl bg-gray-50/50 hover:shadow-md transition flex flex-col justify-between">
                            
                            <div class="flex justify-between items-start mb-3 gap-2">
                                <div>
                                    <p class="text-sm font-bold text-gray-800">{{ $review->product->name ?? 'Produk Dihapus' }}</p>
                                    <p class="text-xs text-gray-400">{{ $review->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                
                                <div class="flex items-center gap-2">
                                    <div class="flex items-center bg-yellow-50 px-2 py-1 rounded border border-yellow-100">
                                        <span class="text-xs font-bold text-yellow-700">⭐ {{ $review->rating }} / 5</span>
                                    </div>

                                    <form action="{{ route('admin.reviews.delete', $review->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus ulasan ini secara permanen?')" class="text-red-400 hover:text-red-700 hover:bg-red-50 p-1.5 rounded-md transition" title="Hapus Ulasan">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="bg-white p-3 rounded-lg border border-gray-100 mt-auto">
                                <p class="text-sm text-gray-700 italic">"{{ $review->comment }}"</p>
                            </div>
                            
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-8 text-gray-500">
                            <p class="font-medium text-sm">Pengguna ini belum pernah memberikan ulasan produk apa pun.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>