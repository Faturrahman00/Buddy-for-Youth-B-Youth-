<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalAsesmen extends Model
{
    use HasFactory;

    protected $table = 'soal_asesmen';

    protected $fillable = [
        'nomor_urut',
        'kategori',
        'pertanyaan',
        'pilihan_jawaban',
        'is_aktif',
    ];

    protected function casts(): array
    {
        return [
            'pilihan_jawaban' => 'array',
            'is_aktif' => 'boolean',
        ];
    }
}
