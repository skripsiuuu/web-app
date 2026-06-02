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
        Schema::table('orders', function (Blueprint $table) {
            // Kita taruh kolomnya setelah kolom 'status' biar rapi
            $table->string('recipient_name')->after('status');
            $table->string('phone_number')->after('recipient_name');
            $table->text('shipping_address')->after('phone_number');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Hapus kolom kalau migrasinya di-rollback
            $table->dropColumn(['recipient_name', 'phone_number', 'shipping_address']);
        });
    }
};
