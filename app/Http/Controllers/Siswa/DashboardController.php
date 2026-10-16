<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Asesmen;
use App\Models\DataAkademik;
use App\Models\Konsultasi;
use App\Models\Rekomendasi;
use App\Models\Siswa;
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

        // 1. Data Akademik
        $dataAkademik = DataAkademik::where('id_siswa', $siswaId)->get();
        $totalNilai = $dataAkademik->count();
        $rataRataAkademik = $totalNilai > 0 ? round($dataAkademik->avg('rata_rata_nilai'), 1) : null;

        // 2. Status Asesmen & Rekomendasi
        $asesmen = Asesmen::where('id_siswa', $siswaId)
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
