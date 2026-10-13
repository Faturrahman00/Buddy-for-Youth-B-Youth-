<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataAkademik extends Model
{
    use HasFactory;

    protected $table = 'data_akademik';

    protected $fillable = [
        'user_id',
        'sekolah',
        'kelas',
        'nilai',
        'detail_nilai',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
