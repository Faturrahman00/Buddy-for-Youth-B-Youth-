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
        Schema::create('program_studi', function (Blueprint $table) {
            $table->id('id_prodi');
            $table->string('nama_prodi');
            $table->text('deskripsi_prodi');
            $table->text('prospek_karier')->nullable();
            $table->string('akreditasi', 50)->nullable();
            $table->string('fakultas')->nullable();
            $table->string('tipe_riasec', 50)->nullable();
            
            // tambahan: tidak ada di ERD
            $table->string('kode_prodi', 50)->nullable()->unique(); // tambahan: tidak ada di ERD
            $table->string('jenjang', 10)->default('S1'); // tambahan: tidak ada di ERD
            $table->string('kampus_rekomendasi')->nullable(); // tambahan: tidak ada di ERD
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_studi');
    }
};
