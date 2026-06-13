<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Batalkan Pesanan #INV26-{{ $order->id }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-xl overflow-hidden border border-gray-100 p-8">
                
                <form action="{{ route('orders.processCancel', $order->id) }}" method="POST">
                    @csrf
                    
                    <div class="mb-5">
                        <label for="reason" class="block text-sm font-bold text-gray-700 mb-2">Pilih Alasan Pembatalan</label>
                        <select name="reason" id="reason" class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 shadow-sm" onchange="toggleOtherReason(this)" required>
                            <option value="">-- Pilih Alasan --</option>
                            <option value="Ingin mengubah alamat pengiriman">Ingin mengubah alamat pengiriman</option>
                            <option value="Berubah pikiran">Berubah pikiran</option>
                            <option value="Lupa memasukkan voucher/promo">Lupa memasukkan voucher/promo</option>
                            <option value="Lainnya">Lainnya...</option>
                        </select>
                    </div>

                    <div class="mb-5" id="other_reason_box" style="display: none;">
                        <label for="other_reason" class="block text-sm font-bold text-gray-700 mb-2">Tuliskan Alasan Lainnya</label>
                        <textarea name="other_reason" id="other_reason" class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 shadow-sm" rows="3" placeholder="Ceritakan secara singkat alasan Anda..."></textarea>
                    </div>

                    <div class="bg-orange-50 border-l-4 border-orange-400 p-4 mb-6 rounded-r-lg">
                        <strong class="text-sm text-orange-800">Syarat dan Ketentuan:</strong><br>
                        <span class="text-xs text-orange-700">Setelah Anda mengisi formulir ini dan ajukan pembatalan, Tim kami akan segera menghubungi Anda. Proses pengembalian dana akan memakan waktu paling lambat 1x24 jam kerja.</span>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <a href="{{ route('orders.show', $order->id) }}" class="text-sm text-gray-500 hover:text-gray-700 font-medium underline transition">
                            Kembali
                        </a>
                        <button type="submit" class="bg-red-600 text-white px-6 py-2.5 rounded-lg text-sm font-bold hover:bg-red-700 transition shadow-md">
                            Ajukan Pembatalan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
    function toggleOtherReason(select) {
        var box = document.getElementById('other_reason_box');
        var textArea = document.getElementById('other_reason');
        if(select.value === 'Lainnya') {
            box.style.display = 'block';
            textArea.setAttribute('required', 'required');
        } else {
            box.style.display = 'none';
            textArea.removeAttribute('required');
            textArea.value = ''; // Kosongkan text area kalau batal milih lainnya
        }
    }
    </script>
</x-app-layout>