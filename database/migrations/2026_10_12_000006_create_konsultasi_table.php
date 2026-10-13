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
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('booking_konsultasi')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('link_zoom')->nullable();
            $table->text('catatan')->nullable();
            $table->string('status_konsultasi')->default('menjadwalkan'); // menjadwalkan, berlangsung, selesai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsultasi');
    }
};
