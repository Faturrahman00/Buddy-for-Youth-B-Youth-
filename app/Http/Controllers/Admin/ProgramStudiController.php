<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProgramStudiController extends Controller
{
    public function index(Request $request)
    {
        $query = ProgramStudi::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_prodi', 'like', "%{$search}%")
                  ->orWhere('kode_prodi', 'like', "%{$search}%")
                  ->orWhere('fakultas', 'like', "%{$search}%");
            });
        }

        if ($request->filled('jenjang') && $request->jenjang !== 'Semua Jenjang') {
            $query->where('jenjang', $request->jenjang);
        }

        $prodis = $query->latest('id_prodi')->paginate(10)->withQueryString();

        return view('Admin.page.kelola_prodi', [
            'prodis' => $prodis,
            'title' => 'Kelola Program Studi — Admin B-Youth',
            'pageTitle' => 'Kelola Program Studi',
            'active' => 'kelola-prodi',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_prodi' => 'required|string|max:50|unique:program_studi,kode_prodi',
            'nama_prodi' => 'required|string|max:255',
            'jenjang' => 'required|string|max:10',
            'fakultas' => 'nullable|string|max:255',
            'akreditasi' => 'nullable|string|max:50',
            'deskripsi' => 'required|string',
            'prospek_karier' => 'nullable|string',
        ]);

        $validated['deskripsi_prodi'] = $validated['deskripsi'];

        ProgramStudi::create($validated);

        return redirect()->route('admin.prodi')->with('success', 'Program studi berhasil ditambahkan.');
    }

    public function update(Request $request, ProgramStudi $prodi)
    {
        $prodiId = $prodi->id_prodi ?? $prodi->id;

        $validated = $request->validate([
            'kode_prodi' => ['required', 'string', 'max:50', Rule::unique('program_studi', 'kode_prodi')->ignore($prodiId, 'id_prodi')],
            'nama_prodi' => 'required|string|max:255',
            'jenjang' => 'required|string|max:10',
            'fakultas' => 'nullable|string|max:255',
            'akreditasi' => 'nullable|string|max:50',
            'deskripsi' => 'required|string',
            'prospek_karier' => 'nullable|string',
        ]);

        $validated['deskripsi_prodi'] = $validated['deskripsi'];

        $prodi->update($validated);

        return redirect()->route('admin.prodi')->with('success', 'Data program studi berhasil diperbarui.');
    }

    public function destroy(ProgramStudi $prodi)
    {
        $prodi->delete();

        return redirect()->route('admin.prodi')->with('success', 'Program studi berhasil dihapus.');
    }
}
