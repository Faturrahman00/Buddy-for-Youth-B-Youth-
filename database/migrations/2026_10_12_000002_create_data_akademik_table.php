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
        Schema::create('data_akademik', function (Blueprint $table) {
            $table->id('id_akademik');
            $table->foreignId('id_siswa')->constrained('siswa', 'id_siswa')->onDelete('cascade');
            $table->string('mapel_semester', 50);
            $table->string('mata_pelajaran');
            $table->decimal('pengetahuan', 5, 2);
            $table->decimal('keterampilan', 5, 2);
            $table->decimal('rata_rata_nilai', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_akademik');
    }
};
