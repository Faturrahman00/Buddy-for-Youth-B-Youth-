<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataAkademik extends Model
{
    use HasFactory;

    protected $table = 'data_akademik';
    protected $primaryKey = 'id_akademik';

    protected $fillable = [
        'id_siswa',
        'mapel_semester',
        'mata_pelajaran',
        'pengetahuan',
        'keterampilan',
        'rata_rata_nilai',
    ];

    protected $casts = [
        'pengetahuan' => 'decimal:2',
        'keterampilan' => 'decimal:2',
        'rata_rata_nilai' => 'decimal:2',
    ];

    protected $appends = [
        'kkm',
        'predikat',
    ];

    public function getKkmAttribute(): int
    {
        return 75;
    }

    public function getPredikatAttribute(): string
    {
        $avg = (float) $this->rata_rata_nilai;
        if ($avg >= 88) return 'A';
        if ($avg >= 78) return 'B';
        return 'C';
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    /**
     * Backward-compatible relation alias for user().
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
