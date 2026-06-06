<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel Admin: Kelola Stok</h2>
            <div class="space-x-4">
                <a href="{{ route('admin.orders') }}" class="text-sm font-medium text-gray-500 hover:text-green-700">Kelola Pesanan</a>
                <a href="{{ route('admin.products') }}" class="text-sm font-bold text-green-700 underline">Kelola Stok</a>
                <a href="{{ route('admin.users') }}" class="text-sm font-medium text-gray-500 hover:text-green-700">Kelola Pelanggan</a>
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

            <div class="mb-6 text-right">
                <a href="{{ route('admin.products.create') }}" class="bg-[#476024] text-white px-5 py-2.5 rounded-lg text-sm font-bold hover:bg-[#364a1b] transition shadow-sm inline-flex items-center gap-2">
                    <span>+</span> Tambah Produk Baru
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow sm:rounded-xl border border-gray-100 p-6">
                <div class="grid grid-cols-1 divide-y divide-gray-100">
                    @foreach($products as $product)
                        <div class="py-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-gray-100 last:border-0">
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset('images/produk/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-lg border flex-shrink-0">
                                <div>
                                    <h4 class="font-bold text-gray-800 text-sm">{{ $product->name }}</h4>
                                    <p class="text-xs text-gray-400">Kode: PRD-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    <p class="text-xs font-bold text-green-700 mt-1">Stok Saat Ini: {{ $product->stock }} pcs</p>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-4 w-full sm:w-auto justify-between sm:justify-end">
                                <form action="{{ route('admin.update-stock', $product->id) }}" method="POST" class="flex items-center space-x-2">
                                    @csrf
                                    <input type="number" name="stock" value="{{ $product->stock }}" min="0" class="w-20 border-gray-300 rounded-lg text-sm px-2 py-1 text-center focus:ring-green-500 focus:border-green-500">
                                    <button type="submit" class="bg-gray-800 text-white px-3 py-1.5 rounded-lg text-xs font-medium hover:bg-gray-700 transition">
                                        Simpan Stok
                                    </button>
                                </form>

                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-xs font-bold text-[#476024] bg-green-50 px-3 py-2 rounded-lg border border-transparent hover:bg-[#476024] hover:text-white transition">
                                        Edit Detail
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini dari katalog?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold text-red-600 bg-red-50 px-3 py-2 rounded-lg hover:bg-red-600 hover:text-white transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>