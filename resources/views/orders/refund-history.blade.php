<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Laporan #TEST26-{{ $order->id }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @foreach($reports as $report)
                <div class="bg-white shadow sm:rounded-xl overflow-hidden border border-gray-100 p-6">
                    <div class="flex justify-between items-start border-b pb-4 mb-4">
                        <div>
                            <p class="text-xs text-gray-400">Dilaporkan pada: {{ $report->created_at->format('d M Y, H:i') }}</p>
                            <h3 class="font-bold text-gray-800 mt-1">Detail Keluhan</h3>
                        </div>
                        
                        <!-- Penanda Status -->
                        @if($report->status == 'pending')
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full border border-yellow-200">Menunggu Proses</span>
                        @elseif($report->status == 'revisi')
                            <span class="px-3 py-1 bg-orange-100 text-orange-700 text-xs font-bold rounded-full border border-orange-200">Perlu Direvisi</span>
                        @elseif($report->status == 'approved')
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full border border-green-200">Disetujui (Refund Diproses)</span>
                        @else
                            <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full border border-red-200">Laporan Ditolak</span>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Bukti Foto -->
                        <div class="col-span-1">
                            <p class="text-xs font-bold text-gray-600 mb-2">Foto Bukti:</p>
                            <img src="{{ asset('storage/' . $report->proof_image) }}" class="w-full h-32 object-cover rounded-lg border border-gray-200">
                        </div>
                        
                        <!-- Penjelasan User -->
                        <div class="col-span-2 space-y-4">
                            <div>
                                <p class="text-xs font-bold text-gray-600 mb-1">Penjelasan Anda:</p>
                                <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded border border-gray-100">"{{ $report->description }}"</p>
                            </div>

                            <!-- Pesan/Feedback dari Admin -->
                            @if($report->admin_feedback)
                                <div>
                                    <p class="text-xs font-bold text-purple-700 mb-1">Catatan dari Admin Mitra Hidup Sehat:</p>
                                    <p class="text-sm text-purple-800 bg-purple-50 p-3 rounded border border-purple-200">
                                        {{ $report->admin_feedback }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Peringatan & Tombol Ajukan Ulang -->
            @if($reports->isNotEmpty())
                @if($reports->first()->status == 'revisi')
                    <div class="bg-orange-50 border border-orange-200 p-6 rounded-xl text-center shadow-sm mt-6">
                        <p class="text-sm text-orange-800 mb-4 font-medium">Laporan Anda memerlukan perbaikan. Silakan periksa catatan Admin dan ajukan ulang laporan.</p>
                        <a href="{{ route('orders.refund', $order->id) }}" class="inline-block px-6 py-2.5 bg-orange-600 text-white rounded-lg text-sm font-bold hover:bg-orange-700 transition shadow-sm">
                            Perbaiki Laporan Sekarang
                        </a>
                    </div>
                @elseif($reports->first()->status == 'rejected')
                    <div class="bg-red-50 border border-red-200 p-6 rounded-xl text-center shadow-sm mt-6">
                        <p class="text-sm text-red-800 font-medium">Mohon maaf laporan Anda telah ditolak secara mutlak oleh pihak Mitra Hidup Sehat dan tidak dapat diajukan kembali.</p>
                    </div>
                @elseif($reports->first()->status == 'approved')
                    <div class="bg-green-50 border border-green-200 p-6 rounded-xl text-center shadow-sm mt-6">
                        <p class="text-sm text-green-800 font-medium">Laporan pengajuan pengembalian dana Anda telah disetujui. Proses pengembalian dana sedang ditindaklanjuti oleh tim kami. Dana dikembalikan paling lambat 2 x hari kerja. Terima kasih atas kesabaran Anda.</p>
                    </div>
                @endif
            @endif

            <div class="text-center pt-4">
                <a href="{{ route('orders.show', $order->id) }}" class="text-sm text-gray-500 hover:text-[#476024] font-medium underline transition">
                    Kembali ke Detail Struk
                </a>
            </div>

        </div>
    </div>
</x-app-layout>