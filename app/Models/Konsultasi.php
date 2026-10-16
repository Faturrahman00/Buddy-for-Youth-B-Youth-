<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'konsultasi';
    protected $primaryKey = 'id_konsultasi';

    protected $fillable = [
        'id_psikolog',
        'id_siswa',
        'tanggal_pengajuan',
        'tanggal_konsultasi',
        'waktu_mulai',
        'waktu_selesai',
        'status_booking',
        'link_zoom',
        'catatan',
        'alasan_tolak',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'datetime',
        'tanggal_konsultasi' => 'date',
    ];

    public function psikolog(): BelongsTo
    {
        return $this->belongsTo(Psikolog::class, 'id_psikolog', 'id_psikolog');
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
