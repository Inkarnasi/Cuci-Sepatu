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
        Schema::create('tracking_statuses', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('transaksi_id')->constrained('transaksis')->onDelete('cascade'); // Hubungkan ke transaksi
            $table->foreignId('status_id')->constrained('statuses')->onDelete('cascade');     // Hubungkan ke status
            $table->longText('description')->nullable();
            $table->date('tanggal_status');
            $table->time('jam_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_statuses');
    }
};
