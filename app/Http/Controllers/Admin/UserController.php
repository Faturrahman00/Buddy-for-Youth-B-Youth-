<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Psikolog;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $roleFilter = $request->filled('role') && $request->role !== 'Semua Role' ? strtolower($request->role) : null;
        $statusFilter = $request->filled('status') && $request->status !== 'Semua Status' ? $request->status : null;
        $search = $request->search;

        $items = collect();

        // Ambil data Admin
        if (! $roleFilter || $roleFilter === 'admin') {
            $q = Admin::query();
            if ($search) {
                $q->where(fn($sq) => $sq->where('nama', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"));
            }
            if ($statusFilter) {
                $q->where('status', $statusFilter);
            }
            $admins = $q->latest()->get()->map(function ($a) {
                $a->id = 'ADM-' . $a->id_admin;
                $a->real_id = $a->id_admin;
                $a->role = 'admin';
                $a->name = $a->nama;
                return $a;
            });
            $items = $items->concat($admins);
        }

        // Ambil data Psikolog
        if (! $roleFilter || $roleFilter === 'psikolog') {
            $q = Psikolog::query();
            if ($search) {
                $q->where(fn($sq) => $sq->where('nama', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"));
            }
            if ($statusFilter) {
                $q->where('status', $statusFilter);
            }
            $psikologs = $q->latest()->get()->map(function ($p) {
                $p->id = 'PSI-' . $p->id_psikolog;
                $p->real_id = $p->id_psikolog;
                $p->role = 'psikolog';
                $p->name = $p->nama;
                return $p;
            });
            $items = $items->concat($psikologs);
        }

        // Ambil data Siswa
        if (! $roleFilter || $roleFilter === 'siswa') {
            $q = Siswa::query();
            if ($search) {
                $q->where(fn($sq) => $sq->where('nama', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"));
            }
            if ($statusFilter) {
                $q->where('status', $statusFilter);
            }
            $siswas = $q->latest()->get()->map(function ($s) {
                $s->id = 'SIS-' . $s->id_siswa;
                $s->real_id = $s->id_siswa;
                $s->role = 'siswa';
                $s->name = $s->nama;
                return $s;
            });
            $items = $items->concat($siswas);
        }

        // Pagination manual untuk koleksi gabungan
        $page = LengthAwarePaginator::resolveCurrentPage('page');
        $perPage = 10;
        $paginated = new LengthAwarePaginator(
            $items->forPage($page, $perPage)->values(),
            $items->count(),
            $perPage,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        return view('Admin.page.kelola_pengguna', [
            'users' => $paginated,
            'title' => 'Kelola Akun Pengguna — Admin B-Youth',
            'pageTitle' => 'Kelola Akun Pengguna',
            'active' => 'kelola-pengguna',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admin,email|unique:psikolog,email|unique:siswa,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,psikolog,siswa',
            'status' => 'required|in:Aktif,Nonaktif',
            'no_telepon' => 'nullable|string|max:25',
            'spesialisasi' => 'nullable|string|max:255',
        ]);

        $hashedPassword = Hash::make($validated['password']);

        if ($validated['role'] === 'admin') {
            Admin::create([
                'nama' => $validated['name'],
                'email' => $validated['email'],
                'kata_sandi' => $hashedPassword,
                'status' => $validated['status'],
            ]);
        } elseif ($validated['role'] === 'psikolog') {
            Psikolog::create([
                'nama' => $validated['name'],
                'email' => $validated['email'],
                'kata_sandi' => $hashedPassword,
                'status' => $validated['status'],
                'no_telepon' => $validated['no_telepon'] ?? null,
                'spesialisasi' => $validated['spesialisasi'] ?? null,
            ]);
        } else {
            Siswa::create([
                'nama' => $validated['name'],
                'email' => $validated['email'],
                'kata_sandi' => $hashedPassword,
                'sekolah' => 'Umum',
                'kelas' => 'Kelas XII',
                'status' => $validated['status'],
                'no_telepon' => $validated['no_telepon'] ?? null,
            ]);
        }

        return redirect()->route('admin.pengguna')->with('success', 'Akun pengguna berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:admin,psikolog,siswa',
            'status' => 'required|in:Aktif,Nonaktif',
            'no_telepon' => 'nullable|string|max:25',
            'spesialisasi' => 'nullable|string|max:255',
        ]);

        // Cari user di tabel sesuai prefix atau cari di ketiga tabel
        $targetUser = null;
        if (str_starts_with($id, 'ADM-')) {
            $targetUser = Admin::find(substr($id, 4));
        } elseif (str_starts_with($id, 'PSI-')) {
            $targetUser = Psikolog::find(substr($id, 4));
        } elseif (str_starts_with($id, 'SIS-')) {
            $targetUser = Siswa::find(substr($id, 4));
        } else {
            $targetUser = Admin::find($id) ?? Psikolog::find($id) ?? Siswa::find($id);
        }

        if ($targetUser) {
            $targetUser->nama = $validated['name'];
            $targetUser->email = $validated['email'];
            $targetUser->status = $validated['status'];
            if (!empty($validated['password'])) {
                $targetUser->kata_sandi = Hash::make($validated['password']);
            }
            if (isset($targetUser->no_telepon)) {
                $targetUser->no_telepon = $validated['no_telepon'] ?? null;
            }
            if (isset($targetUser->spesialisasi)) {
                $targetUser->spesialisasi = $validated['spesialisasi'] ?? null;
            }
            $targetUser->save();
        }

        return redirect()->route('admin.pengguna')->with('success', 'Data akun pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (str_starts_with($id, 'ADM-')) {
            Admin::destroy(substr($id, 4));
        } elseif (str_starts_with($id, 'PSI-')) {
            Psikolog::destroy(substr($id, 4));
        } elseif (str_starts_with($id, 'SIS-')) {
            Siswa::destroy(substr($id, 4));
        } else {
            Admin::destroy($id) || Psikolog::destroy($id) || Siswa::destroy($id);
        }

        return redirect()->route('admin.pengguna')->with('success', 'Akun pengguna berhasil dihapus.');
    }
}
