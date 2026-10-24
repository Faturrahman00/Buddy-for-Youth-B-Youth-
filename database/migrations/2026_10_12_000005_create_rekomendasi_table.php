<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Sesuai ERD: REKOMENDASI (Id_Rekomendasi PK, Id_Asesmen FK, Id_Prodi FK, Skor, Alasan, Prospek_Karier)
     */
    public function up(): void
    {
        Schema::create('rekomendasi', function (Blueprint $table) {
            $table->id('id_rekomendasi');
            $table->foreignId('id_asesmen')->constrained('soal_asesmen', 'id_asesmen')->onDelete('cascade');
            $table->foreignId('id_prodi')->constrained('program_studi', 'id_prodi')->onDelete('cascade');
            $table->decimal('skor', 5, 2)->default(0);
            $table->text('alasan')->nullable();
            $table->text('prospek_karier')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekomendasi');
    }
};
