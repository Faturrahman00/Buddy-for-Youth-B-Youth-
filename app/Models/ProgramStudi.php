<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $table = 'program_studi';
    protected $primaryKey = 'id_prodi';

    protected $fillable = [
        'nama_prodi',
        'deskripsi_prodi',
        'prospek_karier',
        'akreditasi',
        'fakultas',
        'tipe_riasec',
        'kode_prodi', // tambahan: tidak ada di ERD
        'jenjang', // tambahan: tidak ada di ERD
        'kampus_rekomendasi', // tambahan: tidak ada di ERD
    ];

    protected $appends = [
        'id',
        'deskripsi',
    ];

    /**
     * Backward-compatible accessor for id.
     */
    public function getIdAttribute()
    {
        return $this->attributes['id_prodi'] ?? null;
    }

    /**
     * Backward-compatible accessor for deskripsi.
     */
    public function getDeskripsiAttribute(): ?string
    {
        return $this->deskripsi_prodi;
    }

    /**
     * Backward-compatible mutator for deskripsi.
     */
    public function setDeskripsiAttribute(?string $value): void
    {
        $this->attributes['deskripsi_prodi'] = $value;
    }

    public function rekomendasi(): HasMany
    {
        return $this->hasMany(Rekomendasi::class, 'id_prodi', 'id_prodi');
    }
}
