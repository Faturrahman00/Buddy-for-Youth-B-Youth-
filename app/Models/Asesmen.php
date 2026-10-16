<?php

namespace App\Models;

/**
 * Model Asesmen bertindak sebagai alias / representasi sesi asesmen pada tabel tunggal 'soal_asesmen'.
 * Sesuai ERD: Asesmen hanya 1 tabel yaitu soal_asesmen.
 */
class Asesmen extends SoalAsesmen
{
    // Mewarisi semua konfigurasi tabel, fillable, casts, dan relasi dari SoalAsesmen
}
