<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rekomendasi extends Model
{
    use HasFactory;

    protected $table = 'rekomendasi';
    protected $primaryKey = 'id_rekomendasi';

    protected $fillable = [
        'id_asesmen',
        'id_prodi',
        'skor',
        'alasan',
        'kampus_rekomendasi',
        'prospek_karier',
    ];

    public function asesmen(): BelongsTo
    {
        return $this->belongsTo(Asesmen::class, 'id_asesmen', 'id_asesmen');
    }

    public function programStudi(): BelongsTo
    {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi', 'id_prodi');
    }

    /**
     * Backward compatibility alias for hasilAsesmen.
     */
    public function hasilAsesmen(): BelongsTo
    {
        return $this->belongsTo(Asesmen::class, 'id_asesmen', 'id_asesmen');
    }
}
