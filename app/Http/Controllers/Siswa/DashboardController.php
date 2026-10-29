<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\DataAkademik;
use App\Models\Konsultasi;
use App\Models\Rekomendasi;
use App\Models\Siswa;
use App\Models\SoalAsesmen;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected function currentSiswa(): ?Siswa
    {
        return Auth::guard('siswa')->user() ?? Auth::user();
    }

    public function index()
    {
        $siswa = $this->currentSiswa();
        $siswaId = $siswa->id_siswa ?? $siswa->id;

        // 1. Data Akademik (hitung rata-rata dari semester yang diisi siswa)
        $dataAkademik = DataAkademik::where('id_siswa', $siswaId)->get();
        $filledAkademik = $dataAkademik->filter(function ($da) {
            return (float)$da->rata_rata_nilai > 0 || (float)$da->pengetahuan > 0 || (float)$da->keterampilan > 0;
        });

        // Jumlah mapel unik yang sudah terisi oleh siswa (maks 4: IPAS, MTK, B. Indo, B. Inggris)
        $totalNilai = $filledAkademik->map(function ($da) {
            $key = $da->mata_pelajaran;
            return ($key === 'MTK' || stripos($key, 'Matematika') !== false) ? 'MTK' : $key;
        })->unique()->count();

        $rataRataAkademik = $filledAkademik->count() > 0 ? round($filledAkademik->avg('rata_rata_nilai'), 1) : null;

        // 2. Status Asesmen & Rekomendasi
        $asesmen = SoalAsesmen::where('id_siswa', $siswaId)
            ->where('status', 'selesai')
            ->latest('tanggal')
            ->first();

        $topRekomendasi = null;
        if ($asesmen) {
            $topRekomendasi = Rekomendasi::where('id_asesmen', $asesmen->id_asesmen)
                ->with('programStudi')
                ->orderByDesc('skor')
                ->first();
        }

        // 3. Jadwal Konsultasi Mendatang (disetujui atau menunggu)
        $upcomingKonsultasi = Konsultasi::where('id_siswa', $siswaId)
            ->whereIn('status_booking', ['disetujui', 'menunggu'])
            ->where('tanggal_konsultasi', '>=', now()->toDateString())
            ->with('psikolog')
            ->orderBy('tanggal_konsultasi')
            ->orderBy('waktu_mulai')
            ->first();

        // 4. Riwayat Konsultasi (Selesai)
        $totalKonsultasiSelesai = Konsultasi::where('id_siswa', $siswaId)
            ->where('status_booking', 'selesai')
            ->count();

        $lastKonsultasiSelesai = Konsultasi::where('id_siswa', $siswaId)
            ->where('status_booking', 'selesai')
            ->with('psikolog')
            ->latest('tanggal_konsultasi')
            ->first();

        return view('Siswa.page.dashboard_siswa', compact(
            'siswa',
            'dataAkademik',
            'totalNilai',
            'rataRataAkademik',
            'asesmen',
            'topRekomendasi',
            'upcomingKonsultasi',
            'totalKonsultasiSelesai',
            'lastKonsultasiSelesai'
        ));
    }
}
