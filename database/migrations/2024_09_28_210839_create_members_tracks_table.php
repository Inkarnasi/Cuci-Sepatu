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
        Schema::create('members_tracks', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('membership_id')->nullable()->constrained('members')->onDelete('set null');
            $table->string('buktiPembayaran');
            $table->double('totalPembayaran');
            $table->date('tanggalPembayaran');
            $table->time('jamPembayaran');
            $table->date('start_membership')->nullable();
            $table->date('end_membership')->nullable();
            $table->enum('status', ['active', 'expired', 'waiting'])->default('waiting');
            $table->enum('kelas_membership', ['standard', 'gold', 'premium'])->default('standard');
            $table->double('discount')->default(0.10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members_tracks');
    }
};
