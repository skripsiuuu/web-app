<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Selesaikan Pembayaran</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-xl overflow-hidden border border-gray-100 p-8 text-center">
                
                <h3 class="text-gray-500 font-bold tracking-widest text-sm uppercase mb-2">Total Tagihan</h3>
                <h1 class="text-4xl font-black text-darkGreen mb-8">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h1>
                
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 text-left mb-8">
                    <p class="text-sm font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">Metode Pembayaran</p>
                    <div class="flex items-center justify-between bg-white p-4 border border-green-500 rounded-lg ring-1 ring-green-500">
                        <div class="flex items-center space-x-3">
                            <span class="text-2xl">💳</span>
                            <div>
                                <p class="font-bold text-gray-800">E-Payment (Mitra Pay)</p>
                                <p class="text-xs text-gray-500">Verifikasi instan, bebas biaya admin</p>
                            </div>
                        </div>
                        <span class="text-green-600 font-bold text-xl">✓</span>
                    </div>
                </div>

                <p class="text-sm text-gray-500 mb-6">Klik tombol di bawah ini untuk mensimulasikan pembayaran yang berhasil.</p>

                <form action="{{ route('orders.pay', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-[#476024] text-white py-4 rounded-xl font-bold text-lg hover:bg-[#2d3e17] transition shadow-lg flex justify-center items-center space-x-2">
                        <span>Bayar Sekarang</span>
                        <!-- <span>➔</span> -->
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>