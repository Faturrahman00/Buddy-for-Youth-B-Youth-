<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProgramStudiController as AdminProgramStudiController;
use App\Http\Controllers\Admin\AsesmenController as AdminAsesmenController;
use App\Http\Controllers\Siswa\AsesmenController as SiswaAsesmenController;

/*
|--------------------------------------------------------------------------
| Web Routes — Buddy for Youth (B-Youth)
|--------------------------------------------------------------------------
|
| Konfigurasi routing multi-role B-Youth:
| 1. Public Routes (Landing page)
| 2. Auth Routes (Login, Register, Logout, Universal Dashboard)
| 3. Siswa Routes (Role: siswa)
| 4. Admin Routes (Role: admin)
| 5. Psikolog Routes (Role: psikolog)
|
*/

// ══════════════════════════════════════════════════════════════════════════
// 1. PUBLIC ROUTES
// ══════════════════════════════════════════════════════════════════════════

Route::get('/', function () {
    return view('landing_page');
})->name('home');

// ══════════════════════════════════════════════════════════════════════════
// 2. AUTHENTICATION ROUTES (Login, Register, Logout, Universal Gateway)
// ══════════════════════════════════════════════════════════════════════════

// Login & Register (Pengecekan login ditangani langsung oleh AuthController)
Route::get('/login',     [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login',    [AuthController::class, 'login'])->name('login.post');
Route::get('/register',  [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Logout — Mendukung POST (form) dan GET (direct link / fallback)
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])
    ->name('logout');

// Universal /dashboard gateway — Mengarahkan pengguna sesuai role yang aktif
Route::get('/dashboard', function () {
    $user = Auth::guard('admin')->user()
        ?? Auth::guard('psikolog')->user()
        ?? Auth::guard('siswa')->user()
        ?? Auth::user();

    if (! $user) {
        return redirect()->route('login');
    }

    return match ($user->role ?? null) {
        'admin'    => redirect()->route('admin.dashboard'),
        'psikolog' => redirect()->route('psikolog.dashboard'),
        default    => redirect()->route('dashboard_siswa'),
    };
})->name('dashboard');

// ══════════════════════════════════════════════════════════════════════════
// 3. SISWA ROUTES — Memerlukan login & role: siswa
// ══════════════════════════════════════════════════════════════════════════

Route::middleware('role:siswa')->group(function () {
    // Dashboard Siswa & URL Aliases
    Route::get('/dashboard_siswa', function () {
        return view('Siswa.page.dashboard_siswa');
    })->name('dashboard_siswa');

    Route::get('/dashboard-siswa', function () {
        return redirect()->route('dashboard_siswa');
    })->name('dashboard.siswa');

    // Group prefix siswa
    Route::prefix('siswa')->name('siswa.')->group(function () {
        // Root /siswa, /siswa/dashboard, dan /siswa/beranda
        Route::get('/', function () {
            return redirect()->route('dashboard_siswa');
        })->name('index');

        Route::get('/dashboard', function () {
            return view('Siswa.page.dashboard_siswa');
        })->name('dashboard');

        Route::get('/beranda', function () {
            return view('Siswa.page.dashboard_siswa');
        })->name('beranda');

        // Data Akademik
        Route::get('/akademik', function () {
            return view('Siswa.page.data_akademik');
        })->name('akademik');

        // Asesmen Minat Bakat RIASEC & Rekomendasi
        Route::get('/asesmen',          [SiswaAsesmenController::class, 'index'])->name('asesmen');
        Route::post('/asesmen',         [SiswaAsesmenController::class, 'submit'])->name('asesmen.submit');
        Route::get('/riwayat-asesmen',  [SiswaAsesmenController::class, 'riwayat'])->name('riwayat_asesmen');

        // Konsultasi Psikolog & Riwayat
        Route::get('/konsultasi', function () {
            return view('Siswa.page.konsultasi');
        })->name('konsultasi');

        Route::get('/riwayat-konsultasi', function () {
            return view('Siswa.page.riwayat_konsultasi');
        })->name('riwayat_konsultasi');

        // Profil Siswa
        Route::get('/profil', function () {
            return view('Siswa.page.profil');
        })->name('profil');
    });
});

// ══════════════════════════════════════════════════════════════════════════
// 4. ADMIN ROUTES — Memerlukan login & role: admin
// ══════════════════════════════════════════════════════════════════════════

Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
    // Root /admin -> redirect ke dashboard admin
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    })->name('index');

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // CRUD Akun Pengguna
    Route::get('/pengguna',           [AdminUserController::class, 'index'])->name('pengguna');
    Route::post('/pengguna',          [AdminUserController::class, 'store'])->name('pengguna.store');
    Route::put('/pengguna/{user}',    [AdminUserController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{user}', [AdminUserController::class, 'destroy'])->name('pengguna.destroy');

    // CRUD Program Studi
    Route::get('/prodi',              [AdminProgramStudiController::class, 'index'])->name('prodi');
    Route::post('/prodi',             [AdminProgramStudiController::class, 'store'])->name('prodi.store');
    Route::put('/prodi/{prodi}',      [AdminProgramStudiController::class, 'update'])->name('prodi.update');
    Route::delete('/prodi/{prodi}',   [AdminProgramStudiController::class, 'destroy'])->name('prodi.destroy');

    // CRUD Asesmen & Soal
    Route::get('/asesmen',                    [AdminAsesmenController::class, 'index'])->name('asesmen');
    Route::post('/asesmen',                   [AdminAsesmenController::class, 'store'])->name('asesmen.store');
    Route::put('/asesmen/{soal}',             [AdminAsesmenController::class, 'update'])->name('asesmen.update');
    Route::delete('/asesmen/{soal}',          [AdminAsesmenController::class, 'destroy'])->name('asesmen.destroy');
    Route::delete('/asesmen-siswa/{asesmen}', [AdminAsesmenController::class, 'destroyAsesmenSiswa'])->name('asesmen.destroy_siswa');

    // Profil Admin
    Route::get('/profil', function () {
        return view('Admin.page.profil');
    })->name('profil');
});

// ══════════════════════════════════════════════════════════════════════════
// 5. PSIKOLOG ROUTES — Memerlukan login & role: psikolog
// ══════════════════════════════════════════════════════════════════════════

Route::middleware('role:psikolog')->prefix('psikolog')->name('psikolog.')->group(function () {
    // Root /psikolog -> redirect ke beranda psikolog
    Route::get('/', function () {
        return redirect()->route('psikolog.dashboard');
    })->name('index');

    // Beranda / Dashboard Psikolog
    Route::get('/beranda', function () {
        return view('Psikolog.page.beranda');
    })->name('dashboard');

    // Alias /psikolog/dashboard -> redirect ke /psikolog/beranda
    Route::get('/dashboard', function () {
        return redirect()->route('psikolog.dashboard');
    })->name('dashboard.redirect');

    // Kelola Jadwal Konsultasi
    Route::get('/jadwal', function () {
        return view('Psikolog.page.kelola_jadwal');
    })->name('jadwal');

    // Riwayat Konsultasi Siswa
    Route::get('/riwayat', function () {
        return view('Psikolog.page.riwayat_konsultasi');
    })->name('riwayat');

    // Profil Psikolog
    Route::get('/profil', function () {
        return view('Psikolog.page.profil');
    })->name('profil');
});
