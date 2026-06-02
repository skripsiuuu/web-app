<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            // Nyambungin ke tabel orders (struk yang mana)
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            // Nyambungin ke produk (ayam yang mana)
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity'); // Jumlah beli
            $table->integer('price');    // Harga saat dibeli (biar aman kalau besok harga ayam naik)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
