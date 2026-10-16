<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'nama',
        'email',
        'kata_sandi',
        'jenis_kelamin',
        'status', // tambahan: tidak ada di ERD
    ];

    protected $hidden = [
        'kata_sandi',
        'remember_token',
    ];

    /**
     * Get the password for authentication.
     */
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    /**
     * Accessor for name compatibility.
     */
    public function getNameAttribute()
    {
        return $this->nama;
    }

    /**
     * Accessor for role compatibility.
     */
    public function getRoleAttribute()
    {
        return 'admin';
    }
}
