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
        Schema::create('psikolog', function (Blueprint $table) {
            $table->id('id_psikolog');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('kata_sandi');
            $table->string('jenis_kelamin', 20)->nullable();
            $table->string('no_sip')->nullable()->unique();
            $table->string('pendidikan_terakhir')->nullable();
            
            // tambahan: tidak ada di ERD
            $table->string('status', 20)->default('Aktif'); // tambahan: tidak ada di ERD
            $table->string('no_telepon', 25)->nullable(); // tambahan: tidak ada di ERD
            $table->string('spesialisasi')->nullable(); // tambahan: tidak ada di ERD
            $table->rememberToken(); // tambahan: tidak ada di ERD
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psikolog');
    }
};
