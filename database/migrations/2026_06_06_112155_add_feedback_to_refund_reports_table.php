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
        Schema::table('refund_reports', function (Blueprint $table) {
            $table->text('admin_feedback')->nullable()->after('status');
            $table->string('admin_refund_proof')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('refund_reports', function (Blueprint $table) {
            $table->dropColumn('admin_feedback');
        });
    }
};
