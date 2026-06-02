<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel Admin: Tambah Produk Baru</h2>
            <a href="{{ route('admin.products') }}" class="text-sm font-medium text-gray-500 hover:text-[#476024]">Kembali ke Kelola Stok</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow sm:rounded-xl border border-gray-100 p-8">
                
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                        <strong class="font-bold">Waduh, Gagal Simpan!</strong>
                        <span class="block sm:inline">Ada inputan yang masih salah nih:</span>
                        <ul class="list-disc mt-2 ml-4 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Produk</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="w-full border-gray-300 rounded-lg focus:ring-[#476024] focus:border-[#476024]" placeholder="Contoh: Ayam Kampung Utuh">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                            <select name="category" required class="w-full border-gray-300 rounded-lg focus:ring-[#476024] focus:border-[#476024]">
                                <option value="Ayam Probiotik" {{ old('category') == 'Ayam Probiotik' ? 'selected' : '' }}>Ayam Probiotik</option>
                                <option value="Telur Organik" {{ old('category') == 'Telur Organik' ? 'selected' : '' }}>Telur Organik</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Harga (Rp)</label>
                            <input type="number" name="price" value="{{ old('price') }}" required min="0" class="w-full border-gray-300 rounded-lg focus:ring-[#476024] focus:border-[#476024]" placeholder="Contoh: 75000">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Stok Awal</label>
                            <input type="number" name="stock" value="{{ old('stock') }}" required min="0" class="w-full border-gray-300 rounded-lg focus:ring-[#476024] focus:border-[#476024]" placeholder="Contoh: 50">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Berat / Kemasan</label>
                            <input type="text" name="weight" value="{{ old('weight') }}" required class="w-full border-gray-300 rounded-lg focus:ring-[#476024] focus:border-[#476024]" placeholder="Contoh: 900 - 1.000 gram">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Foto Produk</label>
                            <input type="file" name="image" accept="image/*" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-green-50 file:text-[#476024] hover:file:bg-green-100 border border-gray-300 rounded-lg">
                            <p class="text-xs text-gray-400 mt-1">Format: JPG/PNG, Maksimal 2MB</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Keunggulan Produk (Opsional)</label>
                        <input type="text" name="advantages" value="{{ old('advantages') }}" class="w-full border-gray-300 rounded-lg focus:ring-[#476024] focus:border-[#476024]" placeholder="Contoh: Bebas Residu, Kaya Protein (Pisahkan dengan koma)">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Lengkap</label>
                        <textarea name="description" rows="4" required class="w-full border-gray-300 rounded-lg focus:ring-[#476024] focus:border-[#476024]" placeholder="Tuliskan deskripsi produk secara detail...">{{ old('description') }}</textarea>
                    </div>

                    <div class="border-t border-gray-100 pt-6 flex justify-end">
                        <button type="submit" class="bg-[#476024] text-white px-8 py-3 rounded-lg font-bold hover:bg-[#364a1b] transition shadow-sm">
                            Simpan Produk Baru
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>