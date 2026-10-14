<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HasilAsesmen extends Model
{
    use HasFactory;

    protected $table = 'hasil_asesmen';

    protected $fillable = [
        'asesmen_id',
        'holland_code',
        'tipe_tertinggi',
        'minat',
        'bakat',
        'potensi',
        'detail_skor',
        'nilai_raport_digunakan',
        'data_raport',
    ];

    protected function casts(): array
    {
        return [
            'detail_skor' => 'array',
            'tipe_tertinggi' => 'array',
            'nilai_raport_digunakan' => 'boolean',
            'data_raport' => 'array',
        ];
    }

    public function asesmen(): BelongsTo
    {
        return $this->belongsTo(Asesmen::class, 'asesmen_id');
    }

    public function rekomendasi(): HasMany
    {
        return $this->hasMany(Rekomendasi::class, 'hasil_id');
    }
}
