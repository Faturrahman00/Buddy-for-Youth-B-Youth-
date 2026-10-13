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
        'minat',
        'bakat',
        'potensi',
        'detail_skor',
    ];

    protected function casts(): array
    {
        return [
            'detail_skor' => 'array',
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
