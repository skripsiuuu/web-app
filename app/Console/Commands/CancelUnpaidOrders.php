<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;

class CancelUnpaidOrders extends Command
{
    /**
     * Nama dan tanda tangan dari perintah konsol.
     *
     * @var string
     */
    protected $signature = 'app:cancel-unpaid-orders';

    /**
     * Deskripsi dari perintah konsol.
     *
     * @var string
     */
    protected $description = 'Membatalkan pesanan yang belum dibayar melewati batas waktu 24 jam dan mengembalikan stok produk.';

    /**
     * Eksekusi perintah konsol.
     */
    public function handle()
    {
        // Mencari pesanan dengan status 'pending' (Belum Bayar) yang usianya lebih dari 30menit
        $expiredOrders = Order::where('status', 'unpaid')
                              ->where('created_at', '<', Carbon::now()->subMinutes(30))
                              ->get();

        $count = 0;

        foreach ($expiredOrders as $order) {
            // 1. Mengembalikan stok produk ke dalam database
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->increment('stock', $item->quantity);
                }
            }

            // 2. Mengubah status pesanan menjadi dibatalkan
            $order->update([
                'status' => 'cancelled' // atau gunakan status baku Anda, misal: 'batal'
            ]);

            $count++;
        }

        $this->info("Berhasil membatalkan {$count} pesanan yang kedaluwarsa.");
    }
}