<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Sesuai ERD: SOAL ASESMEN (Id_Asesmen PK, Id_Siswa FK, Tanggal, Status, Pertanyaan, Tipe_Riasec)
     */
    public function up(): void
    {
        Schema::create('soal_asesmen', function (Blueprint $table) {
            $table->id('id_asesmen'); // Sesuai ERD: Id_Asesmen (PK)
            $table->foreignId('id_siswa')->nullable()->constrained('siswa', 'id_siswa')->onDelete('cascade'); // Sesuai ERD: Id_Siswa (FK)
            $table->dateTime('tanggal')->nullable(); // Sesuai ERD: Tanggal
            $table->string('status', 50)->default('aktif'); // Sesuai ERD: Status
            $table->text('pertanyaan')->nullable(); // Sesuai ERD: Pertanyaan
            $table->string('tipe_riasec', 50)->nullable(); // Sesuai ERD: Tipe_Riasec
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
