<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel Admin: Kelola Laporan</h2>
            <div class="space-x-4">
                <a href="{{ route('admin.orders') }}" class="text-sm font-medium text-gray-500 hover:text-green-700">Kelola Pesanan</a>
                <a href="{{ route('admin.products') }}" class="text-sm font-medium text-gray-500 hover:text-green-700">Kelola Stok</a>
                <a href="{{ route('admin.users') }}" class="text-sm font-medium text-gray-500 hover:text-green-700">Kelola Pengguna</a>
                <a href="{{ route('admin.reports') }}" class="text-sm font-bold text-green-700 underline">Kelola Laporan</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="bg-white overflow-hidden shadow sm:rounded-xl border border-gray-100 p-6 space-y-6">
                <h3 class="text-lg font-bold text-gray-800 border-b pb-3">Daftar Pengajuan Pengembalian Dana (Refund)</h3>
                
                <div class="flex flex-col gap-4">
                    @forelse($reports as $report)
                        <div class="p-6 border border-gray-200 rounded-xl bg-gray-50/50 hover:shadow-md transition flex flex-col">
                            
                            <!-- Bagian Atas: Rincian Laporan -->
                            <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                                <div class="flex-1 space-y-3">
                                    <div class="flex items-center gap-3">
                                        <span class="text-sm font-black text-purple-700 bg-purple-50 px-2.5 py-1 rounded-md border border-purple-100">
                                            Invoice: #{{ $report->order_id }}
                                        </span>
                                        <span class="text-xs text-gray-400">Waktu Laporan: {{ $report->created_at->format('d M Y, H:i') }} WIB</span>
                                        
                                        <!-- Indikator Status -->
                                        @if($report->status == 'pending')
                                            <span class="text-[10px] font-bold px-2 py-0.5 bg-yellow-100 text-yellow-700 rounded border border-yellow-200">Menunggu</span>
                                        @elseif($report->status == 'revisi')
                                            <span class="text-[10px] font-bold px-2 py-0.5 bg-orange-100 text-orange-700 rounded border border-orange-200">Perlu Revisi</span>
                                        @elseif($report->status == 'approved')
                                            <span class="text-[10px] font-bold px-2 py-0.5 bg-green-100 text-green-700 rounded border border-green-200">Disetujui</span>
                                        @else
                                            <span class="text-[10px] font-bold px-2 py-0.5 bg-red-100 text-red-700 rounded border border-red-200">Ditolak</span>
                                        @endif
                                    </div>

                                    <div class="text-xs text-gray-600 bg-white p-3 rounded-lg border border-gray-100 shadow-sm space-y-1">
                                        <p><strong>Nama Pelapor:</strong> {{ $report->user?->name ?? 'Pengguna Telah Dihapus' }}</p>
                                        <p><strong>Alamat Email:</strong> {{ $report->user?->email ?? '-' }}</p>
                                        <p><strong>Nomor Telepon:</strong> {{ $report->order?->phone_number ?? '-' }}</p>
                                    </div>

                                    <div class="space-y-1">
                                        <strong class="text-sm text-gray-700 block">Alasan & Penjelasan:</strong>
                                        <p class="text-xs text-gray-500 leading-relaxed bg-white p-3 rounded-lg border border-gray-100 italic">
                                            "{{ $report->description }}"
                                        </p>
                                    </div>
                                </div>

                                <div class="w-full md:w-64 flex flex-col items-start md:items-end gap-2">
                                    <strong class="text-xs text-gray-700">Bukti Foto Produk:</strong>
                                    <div class="w-full h-40 bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm flex items-center justify-center">
                                        <img src="{{ asset('storage/' . $report->proof_image) }}" alt="Bukti Pengembalian Dana" class="w-full h-full object-cover hover:scale-105 transition duration-300 cursor-pointer">
                                    </div>
                                </div>
                            </div>

                            <!-- Bagian Bawah: Formulir Evaluasi Admin -->
                            <div class="w-full mt-6 pt-6 border-t border-gray-200">
                                @if($report->status == 'pending')
                                    <form action="{{ route('admin.reports.update', $report->id) }}" method="POST" class="bg-white p-4 rounded-lg border border-purple-100 flex flex-col gap-3 shadow-sm">
                                        @csrf
                                        <div class="flex flex-col md:flex-row gap-4">
                                            <div class="w-full md:w-1/3">
                                                <label class="block text-xs font-bold text-gray-700 mb-1">Status Laporan</label>
                                                <select name="status" class="w-full text-sm border-gray-300 rounded focus:ring-purple-500 focus:border-purple-500" required>
                                                    <option value="" disabled selected>-- Pilih Keputusan --</option>
                                                    <option value="revisi">Revisi Bukti</option>
                                                    <option value="approved">Setujui Refund(Final)</option>
                                                    <option value="rejected">Tolak Laporan(Final)</option>
                                                </select>
                                            </div>
                                            <div class="w-full md:w-2/3">
                                                <label class="block text-xs font-bold text-gray-700 mb-1">Tanggapan / Umpan Balik (Opsional)</label>
                                                <input type="text" name="admin_feedback" placeholder="Contoh: Bukti kurang jelas, mohon ajukan ulang dengan foto terang." class="w-full text-sm border-gray-300 rounded focus:ring-purple-500 focus:border-purple-500">
                                            </div>
                                        </div>
                                        <div class="text-right mt-2">
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin dengan keputusan ini? Evaluasi yang sudah disimpan tidak dapat diubah kembali.')" class="bg-purple-700 text-white px-5 py-2 rounded-lg text-xs font-bold hover:bg-purple-800 transition shadow-sm">
                                                Simpan Evaluasi
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 flex flex-col gap-3 shadow-sm">
                                        <div class="flex flex-col md:flex-row gap-4 items-start">
                                            <div class="w-full md:w-1/3">
                                                <span class="block text-xs font-bold text-gray-500 mb-2">Keputusan Akhir Admin</span>
                                                @if($report->status == 'approved')
                                                    <span class="inline-block px-3 py-1.5 bg-green-100 text-green-700 font-bold text-sm rounded-lg border border-green-200 cursor-not-allowed opacity-80">Disetujui</span>
                                                @elseif($report->status == 'rejected')
                                                    <span class="inline-block px-3 py-1.5 bg-red-100 text-red-700 font-bold text-sm rounded-lg border border-red-200 cursor-not-allowed opacity-80">Ditolak</span>
                                                @elseif($report->status == 'revisi')
                                                    <span class="inline-block px-3 py-1.5 bg-orange-100 text-orange-700 font-bold text-sm rounded-lg border border-orange-200 cursor-not-allowed opacity-80">Revisi Diminta</span>
                                                @endif
                                            </div>
                                            <div class="w-full md:w-2/3">
                                                <span class="block text-xs font-bold text-gray-500 mb-2">Tanggapan / Umpan Balik Admin</span>
                                                <div class="w-full text-sm bg-white border border-gray-200 rounded p-2.5 min-h-[42px] text-gray-600 cursor-not-allowed">
                                                    {{ $report->admin_feedback ?? 'Tidak ada catatan tambahan.' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                    @empty
                        <div class="text-center py-12 text-gray-500">
                            <p class="font-medium text-sm">Belum ada laporan keluhan atau pengajuan pengembalian dana yang masuk dari pelanggan.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>