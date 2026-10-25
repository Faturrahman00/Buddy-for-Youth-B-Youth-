<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SoalAsesmen;
use Illuminate\Http\Request;

class AsesmenController extends Controller
{
    public function index(Request $request)
    {
        $dimensi = $request->query('dimensi', $request->query('kategori', 'SEMUA'));

        $query = SoalAsesmen::whereNull('id_siswa');
        if ($dimensi !== 'SEMUA') {
            $query->where('tipe_riasec', 'LIKE', strtoupper(substr($dimensi, 0, 1)).'%');
        }
        $soals = $query->orderBy('id_asesmen')->get();
        if ($soals->isEmpty()) {
            $soals = SoalAsesmen::orderBy('id_asesmen')->get();
        }

        // Also fetch submitted student assessments for Tab "Hasil & Riwayat Siswa"
        $riwayatAsesmen = SoalAsesmen::whereNotNull('id_siswa')
            ->with(['siswa', 'user', 'rekomendasi.programStudi'])
            ->latest('tanggal')
            ->paginate(10);

        return view('Admin.page.kelola_asesmen', [
            'soals' => $soals,
            'dimensiAktif' => strtoupper($dimensi),
            'kategoriAktif' => strtoupper($dimensi),
            'riwayatAsesmen' => $riwayatAsesmen,
            'title' => 'Kelola Asesmen & Jawaban — Admin B-Youth',
            'pageTitle' => 'Kelola Asesmen Terpadu',
            'active' => 'kelola-asesmen',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'tipe_riasec' => 'nullable|string|max:50',
        ]);

        $kategoriMap = [
            'R' => 'R - Realistic',
            'I' => 'I - Investigative',
            'A' => 'A - Artistic',
            'S' => 'S - Social',
            'E' => 'E - Enterprising',
            'C' => 'C - Conventional',
        ];
        $inputVal = trim($validated['tipe_riasec'] ?? 'R - Realistic');
        $firstChar = strtoupper(substr($inputVal, 0, 1));
        $tipeRiasec = $kategoriMap[$firstChar] ?? $inputVal;

        $soal = SoalAsesmen::create([
            'tipe_riasec' => $tipeRiasec,
            'pertanyaan' => $validated['pertanyaan'],
            'status' => 'aktif',
            'tanggal' => now(),
        ]);

        return redirect()->route('admin.asesmen')
            ->with('success', 'Soal asesmen #'.$soal->id_asesmen.' berhasil ditambahkan.');
    }

    public function update(Request $request, SoalAsesmen $soal)
    {
        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'tipe_riasec' => 'nullable|string|max:50',
        ]);

        $kategoriMap = [
            'R' => 'R - Realistic',
            'I' => 'I - Investigative',
            'A' => 'A - Artistic',
            'S' => 'S - Social',
            'E' => 'E - Enterprising',
            'C' => 'C - Conventional',
        ];
        $inputVal = trim($validated['tipe_riasec'] ?? ($soal->tipe_riasec ?? 'R - Realistic'));
        $firstChar = strtoupper(substr($inputVal, 0, 1));
        $tipeRiasec = $kategoriMap[$firstChar] ?? $inputVal;

        $soal->update([
            'pertanyaan' => $validated['pertanyaan'],
            'tipe_riasec' => $tipeRiasec,
        ]);

        return redirect()->route('admin.asesmen')
            ->with('success', 'Soal asesmen berhasil diperbarui.');
    }

    public function destroy(SoalAsesmen $soal)
    {
        $soal->delete();

        return redirect()->route('admin.asesmen')->with('success', 'Soal asesmen berhasil dihapus.');
    }

    public function destroyAsesmenSiswa(SoalAsesmen $asesmen)
    {
        $asesmen->delete();

        return redirect()->route('admin.asesmen')->with('success', 'Data hasil asesmen siswa berhasil dihapus.');
    }
}
