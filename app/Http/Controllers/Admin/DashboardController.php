<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asesmen;
use App\Models\BookingKonsultasi;
use App\Models\ProgramStudi;
use App\Models\SoalAsesmen;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengguna = User::count();
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalPsikolog = User::where('role', 'psikolog')->count();
        $totalProdi = ProgramStudi::count();
        $totalSoal = SoalAsesmen::count();
        $totalKonsultasi = BookingKonsultasi::count();
        $recentUsers = User::latest()->take(5)->get();

        return view('Admin.page.dashboard', [
            'totalPengguna' => $totalPengguna,
            'totalSiswa' => $totalSiswa,
            'totalPsikolog' => $totalPsikolog,
            'totalProdi' => $totalProdi,
            'totalSoal' => $totalSoal,
            'totalKonsultasi' => $totalKonsultasi,
            'recentUsers' => $recentUsers,
            'title' => 'Dashboard Admin — Buddy For Youth (B-Youth)',
            'pageTitle' => 'Beranda',
            'active' => 'beranda',
        ]);
    }
}
