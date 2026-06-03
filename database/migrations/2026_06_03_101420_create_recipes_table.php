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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category'); // Misal: Resep Olahan Telur
            $table->string('prep_time'); // Misal: 15 Menit
            $table->string('servings'); // Misal: 1 Servings
            $table->text('description'); // Deskripsi singkat di bawah judul
            $table->text('ingredients'); // Daftar bahan-bahan
            $table->text('instructions'); // Langkah-langkah cara penyajian
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
