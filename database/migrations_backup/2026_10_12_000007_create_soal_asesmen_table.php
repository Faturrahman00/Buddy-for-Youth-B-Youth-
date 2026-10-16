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
        Schema::create('soal_asesmen', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_urut')->default(1);
            $table->string('kategori'); // MINAT, BAKAT, POTENSI
            $table->text('pertanyaan');
            $table->json('pilihan_jawaban')->nullable();
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_asesmen');
    }
};
