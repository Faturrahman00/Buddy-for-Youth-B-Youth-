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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('siswa')->after('email'); // admin, psikolog, siswa
            $table->string('status')->default('Aktif')->after('role'); // Aktif, Nonaktif
            $table->string('no_telepon')->nullable()->after('status');
            $table->string('avatar')->nullable()->after('no_telepon');
            $table->string('spesialisasi')->nullable()->after('avatar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'status', 'no_telepon', 'avatar', 'spesialisasi']);
        });
    }
};
