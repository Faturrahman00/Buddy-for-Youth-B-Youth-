<?php

use Illuminate\Support\Facades\Route;

// ══════════════════════════════════════════════════════════════════════════
// PUBLIC ROUTES
// ══════════════════════════════════════════════════════════════════════════

Route::get('/', function () {
    return view('landing_page');
})->name('home');

// Auth pages (static views, no middleware)
Route::get('/login',    function () { return view('auth.login'); })->name('login');
Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::post('/login',   function () { return redirect()->route('dashboard_siswa'); })->name('login.post');
Route::post('/register',function () { return redirect()->route('dashboard_siswa'); })->name('register.post');
Route::post('/logout',  function () { return redirect()->route('home'); })->name('logout');

// ══════════════════════════════════════════════════════════════════════════
// SISWA ROUTES — No auth for now
// ══════════════════════════════════════════════════════════════════════════

Route::get('/dashboard_siswa', function () {
    return view('Siswa.page.dashboard_siswa');
})->name('dashboard_siswa');

Route::get('/dashboard-siswa', function () {
    return redirect()->route('dashboard_siswa');
})->name('dashboard.siswa');

Route::get('/dashboard', function () {
    return redirect()->route('dashboard_siswa');
})->name('dashboard');

Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/beranda', function () {
        return redirect()->route('dashboard_siswa');
    })->name('beranda');

    Route::get('/akademik', function () {
        return view('Siswa.page.data_akademik');
    })->name('akademik');

    Route::get('/asesmen', function () {
        return view('Siswa.page.asesmen_rekomendasi');
    })->name('asesmen');

    Route::get('/riwayat-asesmen', function () {
        return view('Siswa.page.riwayat_asesmen');
    })->name('riwayat_asesmen');

    Route::get('/konsultasi', function () {
        return view('Siswa.page.konsultasi');
    })->name('konsultasi');

    Route::get('/riwayat-konsultasi', function () {
        return view('Siswa.page.riwayat_konsultasi');
    })->name('riwayat_konsultasi');

    Route::get('/profil', function () {
        return view('Siswa.page.profil');
    })->name('profil');
});

// ══════════════════════════════════════════════════════════════════════════
// ADMIN ROUTES
// ══════════════════════════════════════════════════════════════════════════

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('Admin.dashboard');
    })->name('dashboard');
});
