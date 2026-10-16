<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Konsultasi;
use App\Models\Psikolog;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    protected function currentSiswa(): ?Siswa
    {
        return Auth::guard('siswa')->user() ?? Auth::user();
    }

    /**
     * Halaman Utama Konsultasi Siswa
     */
    public function index()
    {
        $siswa = $this->currentSiswa();
        $siswaId = $siswa->id_siswa ?? $siswa->id;

        // 1. Sesi yang sudah disetujui untuk ditampilkan di Top Banner
        $activeSession = Konsultasi::where('id_siswa', $siswaId)
            ->where('status_booking', 'disetujui')
            ->where('tanggal_konsultasi', '>=', now()->toDateString())
            ->with('psikolog')
            ->orderBy('tanggal_konsultasi')
            ->orderBy('waktu_mulai')
            ->first();

        // 2. Daftar Psikolog Aktif
        $psikologs = Psikolog::where('status', 'Aktif')->get();

        // 3. Slot Konsultasi Terbuka yang Disediakan Psikolog
        $availableSlots = Konsultasi::where('status_booking', 'tersedia')
            ->where('tanggal_konsultasi', '>=', now()->toDateString())
            ->with('psikolog')
            ->orderBy('tanggal_konsultasi')
            ->orderBy('waktu_mulai')
            ->get();

        return view('Siswa.page.konsultasi', compact(
            'siswa',
            'activeSession',
            'psikologs',
            'availableSlots'
        ));
    }

    /**
     * Ajukan / Booking Jadwal Konsultasi
     */
    public function booking(Request $request)
    {
        $siswa = $this->currentSiswa();
        $siswaId = $siswa->id_siswa ?? $siswa->id;

        if ($request->filled('id_konsultasi')) {
            // Siswa memilih slot terbuka yang sudah dibuat psikolog
            $konsultasi = Konsultasi::where('id_konsultasi', $request->input('id_konsultasi'))
                ->where('status_booking', 'tersedia')
                ->firstOrFail();

            $konsultasi->update([
                'id_siswa' => $siswaId,
                'tanggal_pengajuan' => now(),
                'status_booking' => 'menunggu',
                'catatan' => $request->input('catatan', 'Pengajuan konsultasi minat bakat dan arah program studi.'),
            ]);
        } else {
            // Siswa mengajukan jadwal kustom baru
            $validated = $request->validate([
                'id_psikolog' => 'required|exists:psikolog,id_psikolog',
                'tanggal_konsultasi' => 'required|date|after_or_equal:today',
                'waktu_mulai' => 'required',
                'waktu_selesai' => 'nullable',
                'catatan' => 'nullable|string|max:1000',
            ], [
                'id_psikolog.required' => 'Pilih psikolog terlebih dahulu.',
                'tanggal_konsultasi.required' => 'Tanggal konsultasi wajib diisi.',
                'tanggal_konsultasi.after_or_equal' => 'Tanggal tidak boleh di masa lalu.',
                'waktu_mulai.required' => 'Pilih jam konsultasi.',
            ]);

            $waktuSelesai = $validated['waktu_selesai'] ?? date('H:i:s', strtotime($validated['waktu_mulai'] . ' +1 hour'));

            Konsultasi::create([
                'id_psikolog' => $validated['id_psikolog'],
                'id_siswa' => $siswaId,
                'tanggal_pengajuan' => now(),
                'tanggal_konsultasi' => $validated['tanggal_konsultasi'],
                'waktu_mulai' => $validated['waktu_mulai'],
                'waktu_selesai' => $waktuSelesai,
                'status_booking' => 'menunggu',
                'catatan' => $validated['catatan'] ?? 'Pengajuan konsultasi bimbingan karier dan studi.',
            ]);
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pengajuan jadwal konsultasi Anda telah berhasil dikirim ke psikolog dan menunggu verifikasi.'
            ]);
        }

        return redirect()->route('siswa.riwayat_konsultasi')->with('success', 'Pengajuan jadwal konsultasi berhasil dikirim.');
    }

    /**
     * Riwayat Konsultasi Siswa
     */
    public function riwayat()
    {
        $siswa = $this->currentSiswa();
        $siswaId = $siswa->id_siswa ?? $siswa->id;

        $riwayatList = Konsultasi::where('id_siswa', $siswaId)
            ->with('psikolog')
            ->orderBy('tanggal_konsultasi', 'desc')
            ->orderBy('waktu_mulai', 'desc')
            ->get();

        return view('Siswa.page.riwayat_konsultasi', compact('siswa', 'riwayatList'));
    }

    /**
     * Batalkan Pengajuan Konsultasi
     */
    public function batal($id)
    {
        $siswa = $this->currentSiswa();
        $siswaId = $siswa->id_siswa ?? $siswa->id;

        $konsultasi = Konsultasi::where('id_konsultasi', $id)
            ->where('id_siswa', $siswaId)
            ->where('status_booking', 'menunggu')
            ->firstOrFail();

        // Kembalikan status jika slot terbuka atau hapus pengajuan
        $konsultasi->update([
            'id_siswa' => null,
            'tanggal_pengajuan' => null,
            'status_booking' => 'tersedia',
            'catatan' => null,
        ]);

        return back()->with('success', 'Pengajuan konsultasi berhasil dibatalkan.');
    }
}
