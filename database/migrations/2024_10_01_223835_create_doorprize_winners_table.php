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
        Schema::create('doorprize_winners', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('transaksi_id')->constrained('transaksis')->onDelete('cascade'); // Mengaitkan dengan transaksi (pemenang)
            $table->foreignId('hadiah_id')->constrained('hadiahs')->onDelete('cascade'); // Mengaitkan dengan hadiah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doorprize_winners');
    }
};
