<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'konsultasi';

    protected $fillable = [
        'booking_id',
        'tanggal',
        'link_zoom',
        'catatan',
        'status_konsultasi',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(BookingKonsultasi::class, 'booking_id');
    }
}
