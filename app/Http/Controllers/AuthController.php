<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Psikolog;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Dapatkan user yang sedang aktif dari guard manapun.
     */
    public static function currentUser()
    {
        return Auth::guard('admin')->user()
            ?? Auth::guard('psikolog')->user()
            ?? Auth::guard('siswa')->user()
            ?? Auth::user();
    }

    /**
     * Tampilkan halaman login.
     */
    public function showLoginForm()
    {
        $user = self::currentUser();
        if ($user) {
            return $this->redirectBasedOnRole($user);
        }

        return view('auth.login');
    }

    /**
     * Proses autentikasi login multi-tabel (admin, psikolog, siswa).
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $email = $credentials['email'];
        $password = $credentials['password'];
        $remember = $request->boolean('remember');

        // 1. Cek Admin
        $admin = Admin::where('email', $email)->first();
        if ($admin && Hash::check($password, $admin->kata_sandi)) {
            if ($admin->status === 'Nonaktif') {
                return back()->withInput($request->only('email'))
                    ->withErrors(['email' => 'Akun Admin Anda dinonaktifkan. Silakan hubungi pengelola sistem.']);
            }
            Auth::guard('admin')->login($admin, $remember);
            Auth::shouldUse('admin');
            $request->session()->regenerate();
            $request->session()->forget('url.intended');
            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang kembali, ' . ($admin->nama ?? $admin->name) . ' (Admin)!');
        }

        // 2. Cek Psikolog
        $psikolog = Psikolog::where('email', $email)->first();
        if ($psikolog && Hash::check($password, $psikolog->kata_sandi)) {
            if ($psikolog->status === 'Nonaktif') {
                return back()->withInput($request->only('email'))
                    ->withErrors(['email' => 'Akun Psikolog Anda dinonaktifkan. Silakan hubungi administrator.']);
            }
            Auth::guard('psikolog')->login($psikolog, $remember);
            Auth::shouldUse('psikolog');
            $request->session()->regenerate();
            $request->session()->forget('url.intended');
            return redirect()->route('psikolog.dashboard')
                ->with('success', 'Selamat datang kembali, ' . ($psikolog->nama ?? $psikolog->name) . ' (Psikolog)!');
        }

        // 3. Cek Siswa
        $siswa = Siswa::where('email', $email)->first();
        if ($siswa && Hash::check($password, $siswa->kata_sandi)) {
            if ($siswa->status === 'Nonaktif') {
                return back()->withInput($request->only('email'))
                    ->withErrors(['email' => 'Akun Siswa Anda dinonaktifkan. Silakan hubungi administrator.']);
            }
            Auth::guard('siswa')->login($siswa, $remember);
            Auth::shouldUse('siswa');
            $request->session()->regenerate();
            $request->session()->forget('url.intended');
            return redirect()->route('dashboard_siswa')
                ->with('success', 'Selamat datang kembali, ' . ($siswa->nama ?? $siswa->name) . '!');
        }

        return back()->withInput($request->only('email'))
            ->withErrors(['email' => 'Email atau kata sandi yang Anda masukkan salah.']);
    }

    /**
     * Tampilkan halaman registrasi siswa.
     */
    public function showRegisterForm()
    {
        $user = self::currentUser();
        if ($user) {
            return $this->redirectBasedOnRole($user);
        }

        return view('auth.register');
    }

    /**
     * Proses registrasi akun baru (disimpan ke tabel siswa).
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:siswa,email|unique:admin,email|unique:psikolog,email',
            'asal_sekolah' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'asal_sekolah.required' => 'Asal sekolah wajib diisi.',
            'kelas.required' => 'Kelas wajib dipilih.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $siswa = Siswa::create([
            'nama' => $validated['name'],
            'email' => $validated['email'],
            'kata_sandi' => Hash::make($validated['password']),
            'sekolah' => $validated['asal_sekolah'],
            'kelas' => 'Kelas ' . $validated['kelas'],
            'semester' => 'Semester 5',
            'status' => 'Aktif',
        ]);

        Auth::guard('siswa')->login($siswa);
        Auth::shouldUse('siswa');
        $request->session()->regenerate();
        $request->session()->forget('url.intended');

        return redirect()->route('dashboard_siswa')->with('success', 'Akun berhasil didaftarkan. Selamat datang di B-Youth!');
    }

    /**
     * Logout pengguna dari semua guards.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        Auth::guard('psikolog')->logout();
        Auth::guard('siswa')->logout();
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }

    /**
     * Pengalihan halaman tujuan berdasarkan role pengguna.
     */
    protected function redirectBasedOnRole($user)
    {
        $role = $user->role ?? 'siswa';

        return match ($role) {
            'admin'    => redirect()->route('admin.dashboard'),
            'psikolog' => redirect()->route('psikolog.dashboard'),
            default    => redirect()->route('dashboard_siswa'),
        };
    }
}
