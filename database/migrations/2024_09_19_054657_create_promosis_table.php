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
        Schema::create('promosis', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('nama_promosi');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status')->comment('upcoming, active, expired');
            $table->string('kode');
            $table->double('discount');
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->double('minimum_payment')->nullable();
            $table->longText('terms_conditions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promosis');
    }
};
