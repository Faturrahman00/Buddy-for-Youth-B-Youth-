<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Dapatkan siswa yang sedang login.
     */
    protected function currentSiswa(): ?Siswa
    {
        return Auth::guard('siswa')->user() ?? Auth::user();
    }

    /**
     * Tampilkan halaman profil siswa.
     */
    public function index()
    {
        $siswa = $this->currentSiswa();
        return view('Siswa.page.profil', compact('siswa'));
    }

    /**
     * Simpan perubahan profil siswa ke database.
     */
    public function update(Request $request)
    {
        $siswa = $this->currentSiswa();
        if (!$siswa) {
            return response()->json(['success' => false, 'message' => 'Sesi login tidak valid.'], 401);
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:siswa,email,' . $siswa->id_siswa . ',id_siswa|unique:admin,email|unique:psikolog,email',
            'jenis_kelamin' => 'nullable|string|in:Laki-laki,Perempuan',
            'sekolah' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'no_telepon' => 'nullable|string|max:25',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
            'sekolah.required' => 'Asal sekolah wajib diisi.',
            'kelas.required' => 'Kelas wajib diisi.',
        ]);

        $siswa->update([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'jenis_kelamin' => $validated['jenis_kelamin'] ?? $siswa->jenis_kelamin,
            'sekolah' => $validated['sekolah'],
            'kelas' => $validated['kelas'],
            'no_telepon' => $validated['no_telepon'] ?? null,
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diperbarui.',
                'data' => [
                    'nama' => $siswa->nama,
                    'email' => $siswa->email,
                    'jenis_kelamin' => $siswa->jenis_kelamin,
                    'sekolah' => $siswa->sekolah,
                    'kelas' => $siswa->kelas,
                    'no_telepon' => $siswa->no_telepon,
                    'initials' => strtoupper(substr($siswa->nama, 0, 2)),
                ]
            ]);
        }

        return redirect()->route('siswa.profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
