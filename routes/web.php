<?php

use Illuminate\Support\Facades\Route;

// ══════════════════════════════════════════════════════════════════════════
// PUBLIC ROUTES
// ══════════════════════════════════════════════════════════════════════════

Route::get('/', function () {
    return view('landing_page');
})->name('home');

use App\Http\Controllers\AuthController;

// Auth pages
Route::get('/login',     [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login',    [AuthController::class, 'login'])->name('login.post');
Route::get('/register',  [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

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

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProgramStudiController as AdminProgramStudiController;
use App\Http\Controllers\Admin\AsesmenController as AdminAsesmenController;

// ══════════════════════════════════════════════════════════════════════════
// ADMIN ROUTES
// ══════════════════════════════════════════════════════════════════════════

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // CRUD Pengguna
    Route::get('/pengguna', [AdminUserController::class, 'index'])->name('pengguna');
    Route::post('/pengguna', [AdminUserController::class, 'store'])->name('pengguna.store');
    Route::put('/pengguna/{user}', [AdminUserController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{user}', [AdminUserController::class, 'destroy'])->name('pengguna.destroy');

    // CRUD Program Studi
    Route::get('/prodi', [AdminProgramStudiController::class, 'index'])->name('prodi');
    Route::post('/prodi', [AdminProgramStudiController::class, 'store'])->name('prodi.store');
    Route::put('/prodi/{prodi}', [AdminProgramStudiController::class, 'update'])->name('prodi.update');
    Route::delete('/prodi/{prodi}', [AdminProgramStudiController::class, 'destroy'])->name('prodi.destroy');

    // CRUD Asesmen & Soal
    Route::get('/asesmen', [AdminAsesmenController::class, 'index'])->name('asesmen');
    Route::post('/asesmen', [AdminAsesmenController::class, 'store'])->name('asesmen.store');
    Route::put('/asesmen/{soal}', [AdminAsesmenController::class, 'update'])->name('asesmen.update');
    Route::delete('/asesmen/{soal}', [AdminAsesmenController::class, 'destroy'])->name('asesmen.destroy');
    Route::delete('/asesmen-siswa/{asesmen}', [AdminAsesmenController::class, 'destroyAsesmenSiswa'])->name('asesmen.destroy_siswa');

    Route::get('/profil', function () {
        return view('Admin.page.profil');
    })->name('profil');
});

// ══════════════════════════════════════════════════════════════════════════
// PSIKOLOG ROUTES
// ══════════════════════════════════════════════════════════════════════════

Route::prefix('psikolog')->name('psikolog.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('psikolog.dashboard');
    });

    Route::get('/beranda', function () {
        return view('Psikolog.page.beranda');
    })->name('dashboard');

    Route::get('/dashboard', function () {
        return redirect()->route('psikolog.dashboard');
    });

    Route::get('/jadwal', function () {
        return view('Psikolog.page.kelola_jadwal');
    })->name('jadwal');

    Route::get('/riwayat', function () {
        return view('Psikolog.page.riwayat_konsultasi');
    })->name('riwayat');

    Route::get('/profil', function () {
        return view('Psikolog.page.profil');
    })->name('profil');
});

