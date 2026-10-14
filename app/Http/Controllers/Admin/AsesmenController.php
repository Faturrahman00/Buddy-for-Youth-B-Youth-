<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asesmen;
use App\Models\SoalAsesmen;
use Illuminate\Http\Request;

class AsesmenController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->query('kategori', 'SEMUA');

        $query = SoalAsesmen::query();
        if ($kategori !== 'SEMUA') {
            $query->where(function ($q) use ($kategori) {
                $q->where('kategori', strtoupper($kategori))
                  ->orWhere('tipe_riasec', strtoupper($kategori));
            });
        }
        $soals = $query->orderBy('nomor_urut')->get();

        // Also fetch submitted student assessments for Tab "Hasil & Riwayat Siswa"
        $riwayatAsesmen = Asesmen::with(['user', 'hasilAsesmen.rekomendasi.programStudi'])
            ->latest('tanggal')
            ->paginate(10);

        return view('Admin.page.kelola_asesmen', [
            'soals' => $soals,
            'kategoriAktif' => strtoupper($kategori),
            'riwayatAsesmen' => $riwayatAsesmen,
            'title' => 'Kelola Asesmen & Jawaban — Admin B-Youth',
            'pageTitle' => 'Kelola Asesmen dan Jawaban',
            'active' => 'kelola-asesmen',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'kategori' => 'required|string',
            'tipe_riasec' => 'nullable|string|max:10',
            'nomor_urut' => 'nullable|integer',
            'opsi' => 'nullable|array',
        ]);

        if (empty($validated['nomor_urut'])) {
            $validated['nomor_urut'] = (SoalAsesmen::max('nomor_urut') ?? 0) + 1;
        }

        $pilihanJawaban = [];
        if (!empty($request->opsi) && is_array($request->opsi)) {
            foreach ($request->opsi as $idx => $opt) {
                if (!empty($opt['teks'])) {
                    $pilihanJawaban[] = [
                        'label' => $opt['label'] ?? chr(65 + $idx),
                        'teks' => $opt['teks'],
                        'bobot' => (int)($opt['bobot'] ?? (5 - $idx)),
                    ];
                }
            }
        }

        // Default standard 5-option Likert if none provided
        if (empty($pilihanJawaban)) {
            $pilihanJawaban = [
                ['label' => 'A', 'teks' => 'Sangat Sesuai / Mahir', 'bobot' => 5],
                ['label' => 'B', 'teks' => 'Sesuai / Cukup Mahir', 'bobot' => 4],
                ['label' => 'C', 'teks' => 'Netral / Ragu-ragu', 'bobot' => 3],
                ['label' => 'D', 'teks' => 'Kurang Sesuai', 'bobot' => 2],
                ['label' => 'E', 'teks' => 'Sangat Tidak Sesuai', 'bobot' => 1],
            ];
        }

        SoalAsesmen::create([
            'nomor_urut' => $validated['nomor_urut'],
            'kategori' => $validated['kategori'],
            'pertanyaan' => $validated['pertanyaan'],
            'pilihan_jawaban' => $pilihanJawaban,
            'is_aktif' => true,
        ]);

        return redirect()->route('admin.asesmen', ['kategori' => $validated['kategori']])
            ->with('success', 'Soal asesmen berhasil ditambahkan.');
    }

    public function update(Request $request, SoalAsesmen $soal)
    {
        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'kategori' => 'required|string',
            'tipe_riasec' => 'nullable|string|max:10',
            'nomor_urut' => 'nullable|integer',
            'opsi' => 'nullable|array',
        ]);

        $pilihanJawaban = [];
        if (!empty($request->opsi) && is_array($request->opsi)) {
            foreach ($request->opsi as $idx => $opt) {
                if (!empty($opt['teks'])) {
                    $pilihanJawaban[] = [
                        'label' => $opt['label'] ?? chr(65 + $idx),
                        'teks' => $opt['teks'],
                        'bobot' => (int)($opt['bobot'] ?? (5 - $idx)),
                    ];
                }
            }
        }

        $soal->update([
            'pertanyaan' => $validated['pertanyaan'],
            'kategori' => $validated['kategori'],
            'nomor_urut' => $validated['nomor_urut'] ?? $soal->nomor_urut,
            'pilihan_jawaban' => !empty($pilihanJawaban) ? $pilihanJawaban : $soal->pilihan_jawaban,
        ]);

        return redirect()->route('admin.asesmen', ['kategori' => $validated['kategori']])
            ->with('success', 'Soal asesmen berhasil diperbarui.');
    }

    public function destroy(SoalAsesmen $soal)
    {
        $soal->delete();

        return redirect()->route('admin.asesmen')->with('success', 'Soal asesmen berhasil dihapus.');
    }

    public function destroyAsesmenSiswa(Asesmen $asesmen)
    {
        $asesmen->delete();

        return redirect()->route('admin.asesmen')->with('success', 'Data hasil asesmen siswa berhasil dihapus.');
    }
}
