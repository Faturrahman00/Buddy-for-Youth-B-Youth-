<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Psikolog extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'psikolog';
    protected $primaryKey = 'id_psikolog';

    protected $fillable = [
        'nama',
        'email',
        'kata_sandi',
        'jenis_kelamin',
        'no_sip',
        'pendidikan_terakhir',
        'status', // tambahan: tidak ada di ERD
        'no_telepon', // tambahan: tidak ada di ERD
        'spesialisasi', // tambahan: tidak ada di ERD
    ];

    protected $hidden = [
        'kata_sandi',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    public function getNameAttribute()
    {
        return $this->nama;
    }

    public function getRoleAttribute()
    {
        return 'psikolog';
    }

    public function konsultasi(): HasMany
    {
        return $this->hasMany(Konsultasi::class, 'id_psikolog', 'id_psikolog');
    }
}
