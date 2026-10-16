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
        Schema::create('asesmen', function (Blueprint $table) {
            $table->id('id_asesmen');
            $table->foreignId('id_siswa')->constrained('siswa', 'id_siswa')->onDelete('cascade');
            $table->dateTime('tanggal');
            $table->string('status', 50)->default('selesai');
            
            // tambahan: tidak ada di ERD (hasil & profil Holland RIASEC terpadu)
            $table->string('holland_code', 20)->nullable(); // tambahan: tidak ada di ERD
            $table->json('tipe_tertinggi')->nullable(); // tambahan: tidak ada di ERD
            $table->text('minat')->nullable(); // tambahan: tidak ada di ERD
            $table->text('bakat')->nullable(); // tambahan: tidak ada di ERD
            $table->text('potensi')->nullable(); // tambahan: tidak ada di ERD
            $table->json('detail_skor')->nullable(); // tambahan: tidak ada di ERD
            $table->boolean('nilai_raport_digunakan')->default(false); // tambahan: tidak ada di ERD
            $table->json('data_raport')->nullable(); // tambahan: tidak ada di ERD
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesmen');
    }
};
