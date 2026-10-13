<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'no_telepon',
        'avatar',
        'spesialisasi',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relationship with Data Akademik (1:1)
     */
    public function dataAkademik(): HasOne
    {
        return $this->hasOne(DataAkademik::class, 'user_id');
    }

    /**
     * Relationship with Jadwal Konsultasi (Psikolog)
     */
    public function jadwalKonsultasi(): HasMany
    {
        return $this->hasMany(JadwalKonsultasi::class, 'user_id');
    }

    /**
     * Relationship with Booking Konsultasi (Siswa)
     */
    public function bookingKonsultasi(): HasMany
    {
        return $this->hasMany(BookingKonsultasi::class, 'user_id');
    }

    /**
     * Relationship with Asesmen (Siswa)
     */
    public function asesmen(): HasMany
    {
        return $this->hasMany(Asesmen::class, 'user_id');
    }
}
