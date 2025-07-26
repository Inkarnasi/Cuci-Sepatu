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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('nama_customer');
            $table->string('email_customer');
            $table->string('notelp_customer');
            $table->string('alamat_customer');
            $table->date('tanggal_transaksi');
            $table->time('jam_transaksi');
            $table->string('status')->comment('downpayment, paid');
            $table->foreignId('promosi_id')->nullable()->constrained('promosis')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('membership_id')->nullable()->constrained('members')->onDelete('set null');
            $table->double('total_harga');
            $table->double('downpayment_amount')->nullable(); // Jumlah DP
            $table->double('remaining_payment')->nullable(); // Sisa pembayaran
            $table->double('pelunasan_amount')->nullable(); // Sisa pembayaran
            $table->date('tanggal_pelunasan')->nullable();
            $table->time('jam_pelunasan')->nullable();
            $table->string('status_downpayment')->comment('pending', 'completed')->nullable();
            $table->enum('status_pickup', ['not_picked_up', 'picked_up'])->nullable();
            $table->date('tanggal_pickup')->nullable();
            $table->time('jam_pickup')->nullable();
            $table->string('tracking_number')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
