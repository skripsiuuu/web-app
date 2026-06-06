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
        Schema::create('refund_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Terhubung ke user
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Terhubung ke invoice pesanan
            $table->text('description'); // Penjelasan refund dari user
            $table->string('proof_image'); // Menyimpan nama/path file foto bukti refund
            $table->string('status')->default('pending'); // Status: pending, approved, rejected (biar elit!)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_reports');
    }
};
