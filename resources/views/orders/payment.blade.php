<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Menunggu Pembayaran</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-xl overflow-hidden border border-gray-100 p-8">
                
                <div class="bg-orange-50 border-l-4 border-orange-400 p-4 mb-8 rounded-r-lg">
                    <div class="flex items-start">
                        <span class="text-orange-500 text-xl mr-3">⏳</span>
                        <div>
                            <h3 class="text-sm font-bold text-orange-800">Selesaikan Pembayaran Anda</h3>
                            <p class="text-xs text-orange-700 mt-1">
                                Pesanan akan dibatalkan otomatis jika tidak dibayar sebelum: <br>
                                <strong class="text-sm">{{ $order->created_at->addMinutes(30)->format('d F Y, H:i') }} WIB</strong>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="text-center mb-8 pb-8 border-b border-gray-100">
                    <h3 class="text-gray-500 font-bold tracking-widest text-sm uppercase mb-2">Total Tagihan</h3>
                    <h1 class="text-4xl font-black text-[#476024]">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h1>
                    <p class="text-xs text-gray-400 mt-2">#INV26-{{ $order->id }}</p>
                </div>
                
                <div class="mb-8">
                    <h4 class="text-sm font-bold text-gray-800 mb-4">Rincian Pembelian:</h4>
                    <div class="bg-gray-50 rounded-lg p-4 text-sm text-gray-600">
                        
                        @foreach($order->items as $item)
                            <div class="flex justify-between items-center mb-2">
                                <span>{{ $item->product->name ?? 'Produk' }} (x{{ $item->quantity }})</span>
                                <span class="font-bold text-gray-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                            </div>
                        @endforeach

                        <div class="border-t border-gray-200 pt-3 mt-3 space-y-2">
                            <div class="flex justify-between text-gray-500 text-xs">
                                <span>Ongkos Kirim</span>
                                <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-500 text-xs">
                                <span>Biaya Admin</span>
                                <span>Rp {{ number_format($order->admin_fee, 0, ',', '.') }}</span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-500 mb-4">Jika jendela pembayaran tidak muncul atau tidak sengaja tertutup, silakan klik tombol di bawah ini:</p>
                    <button type="button" id="pay-button" class="w-full md:w-auto px-8 bg-[#476024] text-white py-3 rounded-lg font-bold hover:bg-[#2d3e17] transition shadow-md">
                        Pilih Metode Pembayaran
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        // Fungsi untuk memanggil popup Midtrans
        function triggerMidtrans() {
            // MENGAMBIL SNAP TOKEN LANGSUNG DARI DATABASE
            window.snap.pay('{{ $order->snap_token }}', {
                onSuccess: function(result){
                    window.location.href = "{{ route('orders.show', $order->id) }}";
                },
                onPending: function(result){
                    window.location.href = "{{ route('orders.show', $order->id) }}";
                },
                onError: function(result){
                    alert("Mohon maaf, pembayaran gagal diproses!");
                },
                onClose: function(){
                    // Hanya notifikasi ringan, karena mereka sudah ada di halaman invoice
                    console.log('User menutup popup.');
                }
            });
        }

        // 1. Memicu popup otomatis saat halaman selesai dimuat (Sakti!)
        document.addEventListener("DOMContentLoaded", function(event) { 
            triggerMidtrans();
        });

        // 2. Memicu popup jika tombol ditekan manual
        document.getElementById('pay-button').onclick = function () {
            triggerMidtrans();
        };
    </script>
</x-app-layout>