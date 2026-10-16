<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'nama',
        'email',
        'kata_sandi',
        'jenis_kelamin',
        'sekolah',
        'kelas',
        'semester',
        'status', // tambahan: tidak ada di ERD
        'no_telepon', // tambahan: tidak ada di ERD
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
        return 'siswa';
    }

    public function dataAkademik(): HasMany
    {
        return $this->hasMany(DataAkademik::class, 'id_siswa', 'id_siswa');
    }

    public function konsultasi(): HasMany
    {
        return $this->hasMany(Konsultasi::class, 'id_siswa', 'id_siswa');
    }

    public function asesmen(): HasMany
    {
        return $this->hasMany(SoalAsesmen::class, 'id_siswa', 'id_siswa');
    }

    public function soalAsesmen(): HasMany
    {
        return $this->hasMany(SoalAsesmen::class, 'id_siswa', 'id_siswa');
    }
}
