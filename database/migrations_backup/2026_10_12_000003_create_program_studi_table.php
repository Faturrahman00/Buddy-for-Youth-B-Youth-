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
            $table->id();
            $table->string('kode_prodi')->nullable()->unique();
            $table->string('nama_prodi');
            $table->string('jenjang')->default('S1'); // S1, D3, D4
            $table->string('fakultas')->nullable();
            $table->string('akreditasi')->nullable();
            $table->text('deskripsi');
            $table->text('prospek_karier')->nullable();
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
