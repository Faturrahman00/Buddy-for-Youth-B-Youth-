@extends('Admin.layout.app')

@section('content')
@php
    $pageTitle = 'Kelola Program Studi';
    $active = 'kelola-prodi';
@endphp

<div class="steps-card-container" style="padding: 24px;">
    {{-- Flash Notifications --}}
    @if(session('success'))
        <div style="background: #EBFDF2; border: 1.5px solid #A6F4C5; color: #027A48; padding: 14px 18px; border-radius: var(--radius-sm); margin-bottom: 20px; font-weight: 600; display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" style="font-weight: 800; cursor: pointer; color: #027A48; font-size: 16px;">&times;</button>
        </div>
    @endif

    @if($errors->any())
        <div style="background: #FFF4F2; border: 1.5px solid #FECDCA; color: #B42318; padding: 14px 18px; border-radius: var(--radius-sm); margin-bottom: 20px; font-weight: 600;">
            <div style="margin-bottom: 6px; font-weight: 700;">Terdapat kesalahan pada input:</div>
            <ul style="margin-left: 20px; font-size: 13px; font-weight: 500;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Top Controls: Search & Filters -->
    <form method="GET" action="{{ route('admin.prodi') }}" style="display: flex; gap: 16px; margin-bottom: 24px; flex-wrap: wrap; align-items: center;">
        <!-- Search -->
        <div style="flex: 1; min-width: 250px; position: relative;">
            <div style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--c-text-muted);">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Program Studi / Kode / Fakultas..." style="width: 100%; padding: 10px 10px 10px 38px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; transition: border-color 0.2s;">
        </div>
        
        <!-- Filters -->
        <select name="jenjang" onchange="this.form.submit()" style="padding: 10px 16px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; background: var(--c-white); color: var(--c-text-body); cursor: pointer;">
            <option value="Semua Jenjang" {{ request('jenjang') == 'Semua Jenjang' ? 'selected' : '' }}>Semua Jenjang</option>
            <option value="S1" {{ request('jenjang') == 'S1' ? 'selected' : '' }}>S1</option>
            <option value="D3" {{ request('jenjang') == 'D3' ? 'selected' : '' }}>D3</option>
            <option value="D4" {{ request('jenjang') == 'D4' ? 'selected' : '' }}>D4</option>
        </select>

        @if(request('search') || (request('jenjang') && request('jenjang') !== 'Semua Jenjang'))
            <a href="{{ route('admin.prodi') }}" style="padding: 10px 16px; background: var(--c-bg); border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-size: 13px; font-weight: 600; color: var(--c-text-muted); text-decoration: none;">Reset Filter</a>
        @endif

        <!-- Button Tambah -->
        <button type="button" onclick="openModalTambahProdi()" style="padding: 10px 20px; background-color: var(--c-primary); border: 2px solid var(--c-primary); border-radius: var(--radius-sm); font-weight: 700; font-size: 14px; color: var(--c-white); cursor: pointer; transition: background-color 0.2s; display: flex; align-items: center; gap: 8px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            TAMBAH PROGRAM STUDI
        </button>
    </form>

    <!-- Table -->
    <div style="overflow-x: auto; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); background: var(--c-white);">
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
            <thead>
                <tr style="background-color: var(--c-bg); border-bottom: 1.5px solid var(--c-border);">
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase; white-space: nowrap;">Kode</th>
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase;">Nama Program Studi</th>
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase;">Jenjang / Fakultas</th>
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase; text-align: center;">Akreditasi</th>
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase; width: 35%;">Deskripsi & Prospek</th>
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase; text-align: center; white-space: nowrap;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prodis as $prodi)
                    <tr style="border-bottom: 1px solid var(--c-border);">
                        <td style="padding: 16px; font-weight: 700; color: var(--c-text-heading); white-space: nowrap;">{{ $prodi->kode_prodi ?? 'PRODI-' . $prodi->id }}</td>
                        <td style="padding: 16px;">
                            <div style="font-weight: 700; color: var(--c-text-heading); font-size: 15px;">{{ $prodi->nama_prodi }}</div>
                        </td>
                        <td style="padding: 16px;">
                            <span style="font-weight: 700; padding: 2px 8px; border: 1px solid var(--c-border); border-radius: 4px; font-size: 11px; background: var(--c-bg); color: var(--c-text-heading);">{{ $prodi->jenjang }}</span>
                            <span style="color: var(--c-text-muted); font-size: 13px; margin-left: 6px;">{{ $prodi->fakultas ?? '-' }}</span>
                        </td>
                        <td style="padding: 16px; text-align: center;">
                            @if(in_array($prodi->akreditasi, ['Unggul', 'A']))
                                <span style="padding: 4px 10px; border: 1px solid #A6F4C5; border-radius: var(--radius-sm); font-size: 12px; font-weight: 700; background: #EBFDF2; color: #027A48;">{{ $prodi->akreditasi }}</span>
                            @else
                                <span style="padding: 4px 10px; border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-size: 12px; font-weight: 700; background: var(--c-white); color: var(--c-text-heading);">{{ $prodi->akreditasi ?? 'B' }}</span>
                            @endif
                        </td>
                        <td style="padding: 16px; color: var(--c-text-muted); font-size: 13px;">
                            <div style="line-height: 1.4; margin-bottom: 4px;">{{ Str::limit($prodi->deskripsi, 90) }}</div>
                            @if($prodi->prospek_karier)
                                <div style="font-size: 12px; color: var(--c-primary); font-weight: 600;">
                                    <strong>Karier:</strong> {{ Str::limit($prodi->prospek_karier, 70) }}
                                </div>
                            @endif
                        </td>
                        <td style="padding: 16px; text-align: center; white-space: nowrap;">
                            <button type="button" 
                                onclick='openModalEditProdi(@json($prodi))'
                                style="padding: 6px 12px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: 4px; font-size: 12px; font-weight: 700; margin-right: 6px; cursor: pointer; color: var(--c-primary);">
                                EDIT
                            </button>
                            <form action="{{ route('admin.prodi.destroy', $prodi->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus prodi {{ $prodi->nama_prodi }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="padding: 6px 12px; border: 1px solid #FECDCA; background: #FFF4F2; color: #B42318; border-radius: 4px; font-size: 12px; font-weight: 700; cursor: pointer;">
                                    HAPUS
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 32px; text-align: center; color: var(--c-text-muted);">
                            Tidak ada program studi yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; font-size: 13px; color: var(--c-text-muted); flex-wrap: wrap; gap: 12px;">
        <span>Menampilkan {{ $prodis->firstItem() ?? 0 }} - {{ $prodis->lastItem() ?? 0 }} dari {{ $prodis->total() }} program studi</span>
        <div>
            {{ $prodis->links() }}
        </div>
    </div>
</div>

<!-- ================= MODAL TAMBAH PRODI ================= -->
<div id="modalTambahProdi" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.55); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div style="background: var(--c-white); border-radius: var(--radius-md); width: 100%; max-width: 580px; padding: 28px; box-shadow: var(--shadow-lg); max-height: 90vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="font-size: 18px; font-weight: 800; color: var(--c-text-heading);">Tambah Program Studi Baru</h3>
            <button type="button" onclick="closeModalTambahProdi()" style="font-size: 20px; font-weight: 700; color: var(--c-text-muted); cursor: pointer;">&times;</button>
        </div>

        <form action="{{ route('admin.prodi.store') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 14px; margin-bottom: 14px;">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Kode Prodi</label>
                    <input type="text" name="kode_prodi" required placeholder="PRODI-06" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Nama Program Studi</label>
                    <input type="text" name="nama_prodi" required placeholder="Contoh: Teknik Biomedis" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 2fr 1fr; gap: 14px; margin-bottom: 14px;">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Jenjang</label>
                    <select name="jenjang" required style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; background: #fff;">
                        <option value="S1">S1</option>
                        <option value="D4">D4</option>
                        <option value="D3">D3</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Fakultas</label>
                    <input type="text" name="fakultas" placeholder="Contoh: Teknik" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Akreditasi</label>
                    <select name="akreditasi" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; background: #fff;">
                        <option value="Unggul">Unggul</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="Baik Sekali">Baik Sekali</option>
                    </select>
                </div>
            </div>

            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Deskripsi Singkat</label>
                <textarea name="deskripsi" required rows="3" placeholder="Jelaskan bidang ilmu yang dipelajari dalam prodi ini..." style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; resize: vertical;"></textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Prospek Karier Lulusan</label>
                <textarea name="prospek_karier" rows="2" placeholder="Contoh: Software Developer, Data Scientist, IT Specialist" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; resize: vertical;"></textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px;">
                <button type="button" onclick="closeModalTambahProdi()" style="padding: 10px 18px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: var(--radius-sm); font-weight: 600; cursor: pointer;">Batal</button>
                <button type="submit" style="padding: 10px 22px; background: var(--c-primary); color: #fff; border: none; border-radius: var(--radius-sm); font-weight: 700; cursor: pointer;">Simpan Prodi</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL EDIT PRODI ================= -->
<div id="modalEditProdi" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.55); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div style="background: var(--c-white); border-radius: var(--radius-md); width: 100%; max-width: 580px; padding: 28px; box-shadow: var(--shadow-lg); max-height: 90vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="font-size: 18px; font-weight: 800; color: var(--c-text-heading);">Edit Program Studi</h3>
            <button type="button" onclick="closeModalEditProdi()" style="font-size: 20px; font-weight: 700; color: var(--c-text-muted); cursor: pointer;">&times;</button>
        </div>

        <form id="formEditProdi" method="POST">
            @csrf
            @method('PUT')
            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 14px; margin-bottom: 14px;">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Kode Prodi</label>
                    <input type="text" name="kode_prodi" id="editKodeProdi" required style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Nama Program Studi</label>
                    <input type="text" name="nama_prodi" id="editNamaProdi" required style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 2fr 1fr; gap: 14px; margin-bottom: 14px;">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Jenjang</label>
                    <select name="jenjang" id="editJenjang" required style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; background: #fff;">
                        <option value="S1">S1</option>
                        <option value="D4">D4</option>
                        <option value="D3">D3</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Fakultas</label>
                    <input type="text" name="fakultas" id="editFakultas" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Akreditasi</label>
                    <select name="akreditasi" id="editAkreditasi" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; background: #fff;">
                        <option value="Unggul">Unggul</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="Baik Sekali">Baik Sekali</option>
                    </select>
                </div>
            </div>

            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Deskripsi Singkat</label>
                <textarea name="deskripsi" id="editDeskripsi" required rows="3" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; resize: vertical;"></textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Prospek Karier Lulusan</label>
                <textarea name="prospek_karier" id="editProspekKarier" rows="2" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; resize: vertical;"></textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px;">
                <button type="button" onclick="closeModalEditProdi()" style="padding: 10px 18px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: var(--radius-sm); font-weight: 600; cursor: pointer;">Batal</button>
                <button type="submit" style="padding: 10px 22px; background: var(--c-primary); color: #fff; border: none; border-radius: var(--radius-sm); font-weight: 700; cursor: pointer;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModalTambahProdi() {
    document.getElementById('modalTambahProdi').style.display = 'flex';
}
function closeModalTambahProdi() {
    document.getElementById('modalTambahProdi').style.display = 'none';
}

function openModalEditProdi(prodi) {
    const modal = document.getElementById('modalEditProdi');
    const form = document.getElementById('formEditProdi');
    form.action = `/admin/prodi/${prodi.id}`;

    document.getElementById('editKodeProdi').value = prodi.kode_prodi || '';
    document.getElementById('editNamaProdi').value = prodi.nama_prodi || '';
    document.getElementById('editJenjang').value = prodi.jenjang || 'S1';
    document.getElementById('editFakultas').value = prodi.fakultas || '';
    document.getElementById('editAkreditasi').value = prodi.akreditasi || 'A';
    document.getElementById('editDeskripsi').value = prodi.deskripsi || '';
    document.getElementById('editProspekKarier').value = prodi.prospek_karier || '';

    modal.style.display = 'flex';
}
function closeModalEditProdi() {
    document.getElementById('modalEditProdi').style.display = 'none';
}
</script>
@endsection
