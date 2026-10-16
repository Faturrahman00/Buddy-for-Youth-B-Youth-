<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SoalAsesmen extends Model
{
    use HasFactory;

    protected $table = 'soal_asesmen';
    protected $primaryKey = 'id_asesmen';

    protected $fillable = [
        'id_asesmen',
        'id_siswa',
        'tanggal',
        'status',
        'pertanyaan',
        'tipe_riasec',
    ];

    protected $appends = [
        'id',
        'nomor_urut',
        'kategori',
        'pilihan_jawaban',
        'holland_code',
        'tipe_tertinggi',
        'minat',
        'bakat',
        'potensi',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'datetime',
        ];
    }

    /**
     * ID virtual alias untuk id_asesmen.
     */
    public function getIdAttribute()
    {
        return $this->attributes['id_asesmen'] ?? null;
    }

    /**
     * Nomor urut otomatis merujuk ke Primary Key id_asesmen.
     */
    public function getNomorUrutAttribute()
    {
        return $this->attributes['id_asesmen'] ?? 1;
    }

    /**
     * Kategori Holland RIASEC dihitung otomatis dari tipe_riasec.
     */
    public function getKategoriAttribute(): string
    {
        return $this->tipe_riasec ?? 'R - Realistic';
    }

    /**
     * Standar baku 5 Skala Likert (A - E).
     */
    public function getPilihanJawabanAttribute(): array
    {
        return [
            ['label' => 'A', 'teks' => 'Sangat tidak setuju', 'bobot' => 1],
            ['label' => 'B', 'teks' => 'Tidak setuju', 'bobot' => 2],
            ['label' => 'C', 'teks' => 'Agak setuju', 'bobot' => 3],
            ['label' => 'D', 'teks' => 'Setuju', 'bobot' => 4],
            ['label' => 'E', 'teks' => 'Sangat setuju', 'bobot' => 5],
        ];
    }

    public function getIsAktifAttribute(): bool
    {
        return strtolower($this->status ?? 'aktif') === 'aktif';
    }

    public function getHollandCodeAttribute(): ?string
    {
        return $this->tipe_riasec;
    }

    public function getTipeTertinggiAttribute(): array
    {
        if (empty($this->tipe_riasec)) return ['I'];
        $clean = str_replace(['–', '-'], '', $this->tipe_riasec);
        $chars = str_split($clean);
        return !empty($chars) ? array_slice($chars, 0, 3) : ['I'];
    }

    public function getMinatAttribute(): ?string
    {
        return $this->pertanyaan;
    }

    public function getBakatAttribute(): ?string
    {
        return 'Kemampuan dan potensi selaras dengan tipe ' . ($this->tipe_riasec ?? 'RIASEC');
    }

    public function getPotensiAttribute(): ?string
    {
        return 'Arah pengembangan karier sesuai dominasi tipe ' . ($this->tipe_riasec ?? 'RIASEC');
    }

    /**
     * Backward-compatible accessor for id_soal.
     */
    public function getIdSoalAttribute()
    {
        return $this->attributes['id_asesmen'] ?? null;
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function rekomendasi(): HasMany
    {
        return $this->hasMany(Rekomendasi::class, 'id_asesmen', 'id_asesmen');
    }

    /**
     * Relasi backward-compatibility agar with(['hasilAsesmen...']) tidak error.
     */
    public function hasilAsesmen(): HasOne
    {
        return $this->hasOne(SoalAsesmen::class, 'id_asesmen', 'id_asesmen');
    }

    /**
     * Backward-compatible alias: hasilAsesmen returns self so $asesmen->hasilAsesmen->... still works!
     */
    public function getHasilAsesmenAttribute()
    {
        return $this;
    }
}
