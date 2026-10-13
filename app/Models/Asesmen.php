<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Asesmen extends Model
{
    use HasFactory;

    protected $table = 'asesmen';

    protected $fillable = [
        'user_id',
        'tanggal',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hasilAsesmen(): HasOne
    {
        return $this->hasOne(HasilAsesmen::class, 'asesmen_id');
    }
}
