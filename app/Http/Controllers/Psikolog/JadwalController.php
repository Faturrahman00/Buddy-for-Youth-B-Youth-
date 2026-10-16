<?php

namespace App\Http\Controllers\Psikolog;

use App\Http\Controllers\Controller;
use App\Models\Konsultasi;
use App\Models\Psikolog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    protected function currentPsikolog(): ?Psikolog
    {
        return Auth::guard('psikolog')->user() ?? Auth::user();
    }

    public function index()
    {
        $psikolog = $this->currentPsikolog();
        $psikologId = $psikolog->id_psikolog ?? $psikolog->id;

        // Ambil semua slot konsultasi milik psikolog ini
        $allSlots = Konsultasi::where('id_psikolog', $psikologId)
            ->with('siswa')
            ->orderBy('tanggal_konsultasi', 'desc')
            ->orderBy('waktu_mulai', 'asc')
            ->get();

        // Pengajuan booking siswa yang berstatus 'menunggu'
        $pengajuanList = Konsultasi::where('id_psikolog', $psikologId)
            ->where('status_booking', 'menunggu')
            ->with('siswa')
            ->orderBy('tanggal_pengajuan', 'desc')
            ->get();

        // Count per kategori
        $totalSlot = $allSlots->count();
        $totalTersedia = $allSlots->where('status_booking', 'tersedia')->count();
        $totalDisetujui = $allSlots->where('status_booking', 'disetujui')->count();
        $totalMenunggu = $pengajuanList->count();

        return view('Psikolog.page.kelola_jadwal', compact(
            'psikolog',
            'allSlots',
            'pengajuanList',
            'totalSlot',
            'totalTersedia',
            'totalDisetujui',
            'totalMenunggu'
        ));
    }

    public function store(Request $request)
    {
        $psikolog = $this->currentPsikolog();
        $psikologId = $psikolog->id_psikolog ?? $psikolog->id;

        $validated = $request->validate([
            'tanggal_konsultasi' => 'required|date|after_or_equal:today',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'link_zoom' => 'nullable|url',
        ], [
            'tanggal_konsultasi.required' => 'Tanggal konsultasi wajib diisi.',
            'waktu_mulai.required' => 'Waktu mulai wajib diisi.',
            'waktu_selesai.required' => 'Waktu selesai wajib diisi.',
            'link_zoom.url' => 'Format tautan Zoom harus berupa URL valid.',
        ]);

        $konsultasi = Konsultasi::create([
            'id_psikolog' => $psikologId,
            'id_siswa' => null,
            'tanggal_konsultasi' => $validated['tanggal_konsultasi'],
            'waktu_mulai' => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
            'status_booking' => 'tersedia',
            'link_zoom' => $validated['link_zoom'] ?? 'https://zoom.us/j/' . rand(10000000000, 99999999999),
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Slot jadwal berhasil dipublikasikan.',
                'data' => $konsultasi
            ]);
        }

        return redirect()->route('psikolog.jadwal')->with('success', 'Slot konsultasi baru berhasil ditambahkan.');
    }

    public function setujui(Request $request, $id)
    {
        $psikolog = $this->currentPsikolog();
        $psikologId = $psikolog->id_psikolog ?? $psikolog->id;

        $konsultasi = Konsultasi::where('id_konsultasi', $id)
            ->where('id_psikolog', $psikologId)
            ->firstOrFail();

        $linkZoom = $request->input('link_zoom') ?: ($konsultasi->link_zoom ?: 'https://zoom.us/j/' . rand(10000000000, 99999999999));

        $konsultasi->update([
            'status_booking' => 'disetujui',
            'link_zoom' => $linkZoom,
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Booking siswa berhasil disetujui.']);
        }

        return redirect()->route('psikolog.jadwal')->with('success', 'Booking siswa telah disetujui.');
    }

    public function tolak(Request $request, $id)
    {
        $psikolog = $this->currentPsikolog();
        $psikologId = $psikolog->id_psikolog ?? $psikolog->id;

        $konsultasi = Konsultasi::where('id_konsultasi', $id)
            ->where('id_psikolog', $psikologId)
            ->firstOrFail();

        $alasan = $request->input('alasan_tolak', 'Jadwal berhalangan atau kuota telah penuh.');

        $konsultasi->update([
            'status_booking' => 'ditolak',
            'alasan_tolak' => $alasan,
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Pengajuan booking ditolak.']);
        }

        return redirect()->route('psikolog.jadwal')->with('success', 'Pengajuan booking telah ditolak.');
    }

    public function selesai(Request $request, $id)
    {
        $psikolog = $this->currentPsikolog();
        $psikologId = $psikolog->id_psikolog ?? $psikolog->id;

        $konsultasi = Konsultasi::where('id_konsultasi', $id)
            ->where('id_psikolog', $psikologId)
            ->firstOrFail();

        $konsultasi->update([
            'status_booking' => 'selesai',
            'catatan' => $request->input('catatan', $konsultasi->catatan),
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Sesi konsultasi ditandai selesai.']);
        }

        return redirect()->route('psikolog.jadwal')->with('success', 'Sesi konsultasi telah diselesaikan.');
    }

    public function destroy($id)
    {
        $psikolog = $this->currentPsikolog();
        $psikologId = $psikolog->id_psikolog ?? $psikolog->id;

        $konsultasi = Konsultasi::where('id_konsultasi', $id)
            ->where('id_psikolog', $psikologId)
            ->firstOrFail();

        $konsultasi->delete();

        return redirect()->route('psikolog.jadwal')->with('success', 'Slot konsultasi berhasil dihapus.');
    }
}
