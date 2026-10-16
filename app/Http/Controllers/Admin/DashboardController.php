<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Psikolog;
use App\Models\Siswa;
use App\Models\ProgramStudi;
use App\Models\SoalAsesmen;
use App\Models\Konsultasi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalPsikolog = Psikolog::count();
        $totalAdmin = Admin::count();
        $totalPengguna = $totalSiswa + $totalPsikolog + $totalAdmin;
        $totalProdi = ProgramStudi::count();
        $totalSoal = SoalAsesmen::count();
        $totalKonsultasi = Konsultasi::count();

        // Ambil 5 user terbaru dari gabungan siswa & psikolog
        $recentSiswa = Siswa::latest()->take(5)->get()->map(function ($s) {
            $s->role = 'siswa';
            $s->name = $s->nama;
            return $s;
        });

        return view('Admin.page.dashboard', [
            'totalPengguna' => $totalPengguna,
            'totalSiswa' => $totalSiswa,
            'totalPsikolog' => $totalPsikolog,
            'totalProdi' => $totalProdi,
            'totalSoal' => $totalSoal,
            'totalKonsultasi' => $totalKonsultasi,
            'recentUsers' => $recentSiswa,
            'title' => 'Dashboard Admin — Buddy For Youth (B-Youth)',
            'pageTitle' => 'Beranda',
            'active' => 'beranda',
        ]);
    }
}
