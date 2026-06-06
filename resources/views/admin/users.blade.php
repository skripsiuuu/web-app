<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel Admin: Kelola Pelanggan</h2>
            <div class="space-x-4">
                <a href="{{ route('admin.orders') }}" class="text-sm font-medium text-gray-500 hover:text-green-700">Kelola Pesanan</a>
                <a href="{{ route('admin.products') }}" class="text-sm font-medium text-gray-500 hover:text-green-700">Kelola Stok</a>
                <a href="{{ route('admin.users') }}" class="text-sm font-bold text-green-700 underline">Kelola Pelanggan</a>
                <a href="{{ route('admin.reports') }}" class="text-sm font-medium text-gray-500 hover:text-green-700">Kelola Laporan</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow sm:rounded-xl border border-gray-100 p-6 space-y-6">
                <h3 class="text-lg font-bold text-gray-800 border-b pb-3">Daftar Pengguna Sistem</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($users as $user)
                        <div class="p-5 border border-gray-200 rounded-xl bg-gray-50/50 flex justify-between items-center gap-4 hover:shadow-md transition">
                            
                            <div class="space-y-1">
                                <div class="flex items-center space-x-2">
                                    <span class="text-base font-bold text-gray-800">{{ $user->name }}</span>
                                    <span class="px-2 py-0.5 text-[10px] font-bold bg-gray-200 text-gray-600 rounded-md uppercase">Pelanggan</span>
                                </div>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                <p class="text-xs text-gray-400">Bergabung: {{ $user->created_at->format('d M Y') }}</p>
                            </div>

                            <div class="flex items-center gap-2 mt-4 md:mt-0">
                                <a href="{{ route('admin.users.behavior', $user->id) }}" class="bg-blue-50 text-blue-600 border border-blue-200 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-blue-600 hover:text-white transition shadow-sm">
                                    Tinjau Perilaku
                                </a>

                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Pastikan perilaku pengguna sudah memenuhi kriteria ketentuan penghapusan akun! Semua data terkait pengguna ini akan ikut terhapus.')" class="bg-red-50 text-red-600 border border-red-200 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-red-600 hover:text-white transition shadow-sm">
                                        Hapus Akun
                                    </button>
                                </form>
                            </div>
                            
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-8 text-gray-500">
                            Belum ada user pelanggan yang terdaftar.
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>