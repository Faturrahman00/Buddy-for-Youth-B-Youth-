<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BookingKonsultasi extends Model
{
    use HasFactory;

    protected $table = 'booking_konsultasi';

    protected $fillable = [
        'user_id',
        'jadwal_id',
        'tanggal_booking',
        'status_booking',
        'catatan_siswa',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_booking' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(JadwalKonsultasi::class, 'jadwal_id');
    }

    public function konsultasi(): HasOne
    {
        return $this->hasOne(Konsultasi::class, 'booking_id');
    }
}
