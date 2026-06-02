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
    // Ganti 'table $table' jadi 'Blueprint $table'
    Schema::create('products', function (Blueprint $table) { 
        $table->id();
        $table->string('name');         // Nama produk (ex: Ayam Sehat Organik)
        $table->string('slug')->unique(); // URL ramah SEO (ex: ayam-sehat-organik)
        $table->string('category');
        $table->string('weight')->nullable();       // Buat nyimpen berat (ex: "900 - 1000 gram")
        $table->text('advantages')->nullable();     // Buat nyimpen keunggulan dipisah koma
        $table->text('description');    // Deskripsi produk
        $table->integer('price');       // Harga
        $table->string('image');        // Nama file foto produk
        $table->integer('stock')->default(0); // Jumlah stok barang
        $table->timestamps();           
    });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
