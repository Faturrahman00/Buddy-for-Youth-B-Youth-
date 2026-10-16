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
            $table->id('id_konsultasi');
            $table->foreignId('id_psikolog')->constrained('psikolog', 'id_psikolog')->onDelete('cascade');
            $table->foreignId('id_siswa')->nullable()->constrained('siswa', 'id_siswa')->onDelete('cascade');
            $table->dateTime('tanggal_pengajuan')->nullable();
            $table->date('tanggal_konsultasi');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('status_booking', 50)->default('tersedia'); // tersedia, menunggu, disetujui, ditolak, selesai
            $table->string('link_zoom')->nullable();
            $table->text('catatan')->nullable();
            $table->text('alasan_tolak')->nullable();
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
