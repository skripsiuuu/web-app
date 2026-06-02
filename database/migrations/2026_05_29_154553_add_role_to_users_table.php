<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema; // Pastikan ini ada

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // UBAH JADI Schema::table
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // UBAH JADI Schema::table
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};