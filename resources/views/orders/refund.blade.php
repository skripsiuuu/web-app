<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengajuan Pengembalian Dana (Refund)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow sm:rounded-xl border border-gray-100 p-6 sm:p-10">
                
                <div class="mb-6 border-b border-gray-200 pb-4">
                    <h3 class="text-lg font-bold text-gray-800">Formulir Keluhan Pesanan #{{ $order->id }}</h3>
                    <p class="text-sm text-gray-500 mt-1">Silakan jelaskan kendala yang Anda alami dan unggah bukti berupa foto agar kami dapat segera memproses pengembalian dana Anda.</p>
                </div>

                <form action="{{ route('orders.refund.store', $order->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Penjelasan Kendala <span class="text-red-500">*</span></label>
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm" placeholder="Contoh: Ayam yang saya terima kondisinya sudah tidak segar dan kemasannya rusak..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="proof_image" class="block text-sm font-medium text-gray-700">Unggah Bukti Foto <span class="text-red-500">*</span></label>
                        <input type="file" id="proof_image" name="proof_image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" required>
                        <p class="mt-1 text-xs text-gray-400">Format yang diizinkan: JPG, JPEG, PNG. Ukuran maksimal: 2MB.</p>
                        @error('proof_image')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end space-x-3 pt-4">
                        <a href="{{ route('orders.show', $order->id) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">Batal</a>
                        <button type="submit" class="px-5 py-2 text-sm font-bold text-white bg-[#476024] hover:bg-[#364a1b] rounded-lg shadow-sm transition">Kirim Pengajuan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>