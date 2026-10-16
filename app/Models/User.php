<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model User sebagai facade / generic wrapper kompatibilitas sistem auth.
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'siswa'; // default table jika diakses generic
    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'nama',
        'email',
        'kata_sandi',
        'jenis_kelamin',
        'sekolah',
        'kelas',
        'semester',
        'status',
        'no_telepon',
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
}
