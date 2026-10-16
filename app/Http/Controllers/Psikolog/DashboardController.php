<?php

namespace App\Http\Controllers\Psikolog;

use App\Http\Controllers\Controller;
use App\Models\Konsultasi;
use App\Models\Psikolog;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected function currentPsikolog(): ?Psikolog
    {
        return Auth::guard('psikolog')->user() ?? Auth::user();
    }

    public function index()
    {
        $psikolog = $this->currentPsikolog();
        $psikologId = $psikolog->id_psikolog ?? $psikolog->id;

        // Metric 1: Permintaan Booking Baru (Menunggu verifikasi)
        $bookingBaruCount = Konsultasi::where('id_psikolog', $psikologId)
            ->where('status_booking', 'menunggu')
            ->count();

        $bookingBaruSample = Konsultasi::where('id_psikolog', $psikologId)
            ->where('status_booking', 'menunggu')
            ->with('siswa')
            ->latest('tanggal_pengajuan')
            ->first();

        // Metric 2: Sesi Mendatang (Disetujui dan >= hari ini)
        $sesiMendatangCount = Konsultasi::where('id_psikolog', $psikologId)
            ->where('status_booking', 'disetujui')
            ->where('tanggal_konsultasi', '>=', now()->toDateString())
            ->count();

        $nextSession = Konsultasi::where('id_psikolog', $psikologId)
            ->where('status_booking', 'disetujui')
            ->where('tanggal_konsultasi', '>=', now()->toDateString())
            ->with('siswa')
            ->orderBy('tanggal_konsultasi')
            ->orderBy('waktu_mulai')
            ->first();

        // Metric 3: Sesi Selesai
        $sesiSelesaiCount = Konsultasi::where('id_psikolog', $psikologId)
            ->where('status_booking', 'selesai')
            ->count();

        // Sesi hari ini
        $todaySessions = Konsultasi::where('id_psikolog', $psikologId)
            ->whereDate('tanggal_konsultasi', now()->toDateString())
            ->with('siswa')
            ->orderBy('waktu_mulai')
            ->get();

        return view('Psikolog.page.beranda', compact(
            'psikolog',
            'bookingBaruCount',
            'bookingBaruSample',
            'sesiMendatangCount',
            'nextSession',
            'sesiSelesaiCount',
            'todaySessions'
        ));
    }
}
