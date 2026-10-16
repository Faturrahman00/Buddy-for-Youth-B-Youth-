<?php

namespace App\Http\Controllers\Psikolog;

use App\Http\Controllers\Controller;
use App\Models\Psikolog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    protected function currentPsikolog(): ?Psikolog
    {
        return Auth::guard('psikolog')->user() ?? Auth::user();
    }

    public function index()
    {
        $psikolog = $this->currentPsikolog();
        return view('Psikolog.page.profil', compact('psikolog'));
    }

    public function update(Request $request)
    {
        $psikolog = $this->currentPsikolog();
        if (!$psikolog) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:psikolog,email,' . $psikolog->id_psikolog . ',id_psikolog|unique:siswa,email|unique:admin,email',
            'no_sip' => 'nullable|string|max:100',
            'no_telepon' => 'nullable|string|max:30',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'spesialisasi' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|string|in:Laki-laki,Perempuan',
        ], [
            'nama.required' => 'Nama lengkap dan gelar wajib diisi.',
            'email.required' => 'Email resmi wajib diisi.',
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
        ]);

        $psikolog->update($validated);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Profil psikolog berhasil diperbarui.',
                'data' => $psikolog
            ]);
        }

        return redirect()->route('psikolog.profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
