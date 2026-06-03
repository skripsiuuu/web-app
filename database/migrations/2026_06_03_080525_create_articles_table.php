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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // Buat URL ramah SEO
            $table->string('category'); // Misal: Olahraga, Diet, dll
            $table->text('content'); // Isi lengkap artikelnya
            $table->text('excerpt')->nullable(); // Rangkuman singkat buat di halaman depan
            $table->string('image')->nullable(); // Foto artikel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
