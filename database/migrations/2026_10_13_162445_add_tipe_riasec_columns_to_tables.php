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
        if (Schema::hasTable('soal_asesmen') && !Schema::hasColumn('soal_asesmen', 'tipe_riasec')) {
            Schema::table('soal_asesmen', function (Blueprint $table) {
                $table->string('tipe_riasec', 10)->nullable()->after('kategori');
            });
        }

        if (Schema::hasTable('program_studi') && !Schema::hasColumn('program_studi', 'tipe_riasec')) {
            Schema::table('program_studi', function (Blueprint $table) {
                $table->string('tipe_riasec', 50)->nullable()->after('nama_prodi');
                $table->string('kampus_rekomendasi')->nullable()->after('prospek_karier');
            });
        }

        if (Schema::hasTable('hasil_asesmen')) {
            Schema::table('hasil_asesmen', function (Blueprint $table) {
                if (!Schema::hasColumn('hasil_asesmen', 'holland_code')) {
                    $table->string('holland_code', 20)->nullable()->after('asesmen_id');
                }
                if (!Schema::hasColumn('hasil_asesmen', 'tipe_tertinggi')) {
                    $table->json('tipe_tertinggi')->nullable()->after('holland_code');
                }
                if (!Schema::hasColumn('hasil_asesmen', 'nilai_raport_digunakan')) {
                    $table->boolean('nilai_raport_digunakan')->default(false)->after('detail_skor');
                }
                if (!Schema::hasColumn('hasil_asesmen', 'data_raport')) {
                    $table->json('data_raport')->nullable()->after('nilai_raport_digunakan');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('soal_asesmen') && Schema::hasColumn('soal_asesmen', 'tipe_riasec')) {
            Schema::table('soal_asesmen', function (Blueprint $table) {
                $table->dropColumn('tipe_riasec');
            });
        }

        if (Schema::hasTable('program_studi')) {
            Schema::table('program_studi', function (Blueprint $table) {
                if (Schema::hasColumn('program_studi', 'tipe_riasec')) {
                    $table->dropColumn('tipe_riasec');
                }
                if (Schema::hasColumn('program_studi', 'kampus_rekomendasi')) {
                    $table->dropColumn('kampus_rekomendasi');
                }
            });
        }

        if (Schema::hasTable('hasil_asesmen')) {
            Schema::table('hasil_asesmen', function (Blueprint $table) {
                $columns = ['holland_code', 'tipe_tertinggi', 'nilai_raport_digunakan', 'data_raport'];
                foreach ($columns as $column) {
                    if (Schema::hasColumn('hasil_asesmen', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }
};
