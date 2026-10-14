<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $table = 'program_studi';

    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
        'tipe_riasec',
        'jenjang',
        'fakultas',
        'akreditasi',
        'deskripsi',
        'prospek_karier',
        'kampus_rekomendasi',
    ];

    public function rekomendasi(): HasMany
    {
        return $this->hasMany(Rekomendasi::class, 'prodi_id');
    }
}
