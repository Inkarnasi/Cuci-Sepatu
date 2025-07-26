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
        Schema::create('qrcodes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('transaksi_id')->constrained('transaksis')->onDelete('cascade');
            $table->enum('category_sepatu', ['Berwarna', 'Putih']);
            $table->string('role')->comment('karyawan', 'karyawan2', 'karyawan3', 'karyawan4', 'karyawan5', 'karyawan6');
            $table->string('qrcode')->nullable();
            $table->string('code')->unique();
            $table->date('create_code_date')->nullable();
            $table->time('create_code_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qrcodes');
    }
};
