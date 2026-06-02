<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Nyambungin ke tabel users (siapa yang beli)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Nyimpen total harga belanjaan
            $table->integer('total_price');
            // Status pesanan: pending, success, dibatalkan, dll
            $table->string('status')->default('pending');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE orders AUTO_INCREMENT = 100001;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
