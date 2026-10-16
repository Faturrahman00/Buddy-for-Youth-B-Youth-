<?php

namespace App\Http\Controllers\Psikolog;

use App\Http\Controllers\Controller;
use App\Models\Konsultasi;
use App\Models\Psikolog;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    protected function currentPsikolog(): ?Psikolog
    {
        return Auth::guard('psikolog')->user() ?? Auth::user();
    }

    public function index()
    {
        $psikolog = $this->currentPsikolog();
        $psikologId = $psikolog->id_psikolog ?? $psikolog->id;

        $riwayatList = Konsultasi::where('id_psikolog', $psikologId)
            ->whereIn('status_booking', ['selesai', 'ditolak'])
            ->with('siswa')
            ->orderBy('tanggal_konsultasi', 'desc')
            ->orderBy('waktu_mulai', 'desc')
            ->get();

        return view('Psikolog.page.riwayat_konsultasi', compact('psikolog', 'riwayatList'));
    }
}
