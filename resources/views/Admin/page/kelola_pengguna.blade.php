@extends('Admin.layout.app')

@section('content')
@php
    $pageTitle = 'Kelola Akun Pengguna';
    $active = 'kelola-pengguna';
@endphp

<div class="steps-card-container" style="padding: 24px;">
    <!-- Top Controls: Search & Filters -->
    <form method="GET" action="{{ route('admin.pengguna') }}" style="display: flex; gap: 16px; margin-bottom: 24px; flex-wrap: wrap; align-items: center;">
        <!-- Search -->
        <div style="flex: 1; min-width: 250px; position: relative;">
            <div style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--c-text-muted);">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pengguna / email..." style="width: 100%; padding: 10px 10px 10px 38px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; transition: border-color 0.2s;">
        </div>
        
        <!-- Filters -->
        <select name="role" onchange="this.form.submit()" style="padding: 10px 16px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; background: var(--c-white); color: var(--c-text-body); cursor: pointer;">
            <option value="Semua Role" {{ request('role') == 'Semua Role' ? 'selected' : '' }}>Semua Role</option>
            <option value="siswa" {{ request('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
            <option value="psikolog" {{ request('role') == 'psikolog' ? 'selected' : '' }}>Psikolog</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        
        <select name="status" onchange="this.form.submit()" style="padding: 10px 16px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; background: var(--c-white); color: var(--c-text-body); cursor: pointer;">
            <option value="Semua Status" {{ request('status') == 'Semua Status' ? 'selected' : '' }}>Semua Status</option>
            <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Nonaktif" {{ request('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>

        @if(request('search') || (request('role') && request('role') !== 'Semua Role') || (request('status') && request('status') !== 'Semua Status'))
            <a href="{{ route('admin.pengguna') }}" style="padding: 10px 16px; background: var(--c-bg); border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-size: 13px; font-weight: 600; color: var(--c-text-muted); text-decoration: none;">Reset Filter</a>
        @endif

        <!-- Button Tambah -->
        <button type="button" onclick="openModalTambahPengguna()" style="padding: 10px 20px; background-color: var(--c-primary); border: 2px solid var(--c-primary); border-radius: var(--radius-sm); font-weight: 700; font-size: 14px; color: var(--c-white); cursor: pointer; transition: background-color 0.2s; display: flex; align-items: center; gap: 8px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            TAMBAH PENGGUNA
        </button>
    </form>

    <!-- Table -->
    <div style="overflow-x: auto; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); background: var(--c-white);">
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
            <thead>
                <tr style="background-color: var(--c-bg); border-bottom: 1.5px solid var(--c-border);">
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase;">ID</th>
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase;">Nama Lengkap</th>
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase;">Email</th>
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase;">Peran</th>
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase;">Status</th>
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr style="border-bottom: 1px solid var(--c-border);">
                        <td style="padding: 16px; font-weight: 700; color: var(--c-text-heading);">USR-{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td style="padding: 16px;">
                            <div style="font-weight: 600; color: var(--c-text-heading);">{{ $user->name }}</div>
                            @if($user->no_telepon)
                                <div style="font-size: 12px; color: var(--c-text-muted);">{{ $user->no_telepon }}</div>
                            @endif
                        </td>
                        <td style="padding: 16px; color: var(--c-text-muted);">{{ $user->email }}</td>
                        <td style="padding: 16px;">
                            @if($user->role === 'admin')
                                <span style="padding: 4px 10px; border: 1px solid #FCE49E; border-radius: var(--radius-sm); font-size: 12px; font-weight: 700; background: #FFF9E6; color: #7A5400;">Admin</span>
                            @elseif($user->role === 'psikolog')
                                <span style="padding: 4px 10px; border: 1px solid #B9D0E4; border-radius: var(--radius-sm); font-size: 12px; font-weight: 700; background: #EAF2F8; color: var(--c-primary);">Psikolog</span>
                            @else
                                <span style="padding: 4px 10px; border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-size: 12px; font-weight: 600; background: var(--c-white); color: var(--c-text-body);">Siswa</span>
                            @endif
                        </td>
                        <td style="padding: 16px;">
                            @if($user->status === 'Aktif')
                                <span style="padding: 4px 10px; background: #EBFDF2; color: #027A48; border: 1px solid #A6F4C5; border-radius: var(--radius-sm); font-size: 12px; font-weight: 700;">Aktif</span>
                            @else
                                <span style="padding: 4px 10px; border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-size: 12px; font-weight: 600; background: var(--c-bg); color: var(--c-text-muted);">Nonaktif</span>
                            @endif
                        </td>
                        <td style="padding: 16px; text-align: center; white-space: nowrap;">
                            <button type="button" 
                                onclick='openModalEditPengguna(@json($user))'
                                style="padding: 6px 12px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: 4px; font-size: 12px; font-weight: 700; margin-right: 6px; cursor: pointer; color: var(--c-primary);">
                                EDIT
                            </button>
                            <form action="{{ route('admin.pengguna.destroy', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun {{ $user->name }}?');">
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
                            Tidak ada akun pengguna yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; font-size: 13px; color: var(--c-text-muted); flex-wrap: wrap; gap: 12px;">
        <span>Menampilkan {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} akun pengguna</span>
        <div>
            {{ $users->links() }}
        </div>
    </div>
</div>

<!-- ================= MODAL TAMBAH PENGGUNA ================= -->
<div id="modalTambahPengguna" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.55); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div style="background: var(--c-white); border-radius: var(--radius-md); width: 100%; max-width: 520px; padding: 28px; box-shadow: var(--shadow-lg); max-height: 90vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="font-size: 18px; font-weight: 800; color: var(--c-text-heading);">Tambah Akun Pengguna Baru</h3>
            <button type="button" onclick="closeModalTambahPengguna()" style="font-size: 20px; font-weight: 700; color: var(--c-text-muted); cursor: pointer;">&times;</button>
        </div>

        <form action="{{ route('admin.pengguna.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Contoh: Dimas Wicaksono" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
            </div>

            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Email</label>
                <input type="email" name="email" required placeholder="Contoh: dimas@byouth.id" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Peran (Role)</label>
                    <select name="role" id="tambahRole" onchange="toggleSpesialisasiTambah(this.value)" required style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; background: #fff;">
                        <option value="siswa">Siswa</option>
                        <option value="psikolog">Psikolog</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Status</label>
                    <select name="status" required style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; background: #fff;">
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>
            </div>

            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Password</label>
                <input type="password" name="password" required placeholder="Minimal 6 karakter" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
            </div>

            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">No. Telepon / WhatsApp</label>
                <input type="text" name="no_telepon" placeholder="Contoh: 08123456789" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
            </div>

            <div id="fieldSpesialisasiTambah" style="display: none; margin-bottom: 20px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Spesialisasi (Khusus Psikolog)</label>
                <input type="text" name="spesialisasi" placeholder="Contoh: Konseling Minat Bakat Remaja" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px;">
                <button type="button" onclick="closeModalTambahPengguna()" style="padding: 10px 18px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: var(--radius-sm); font-weight: 600; cursor: pointer;">Batal</button>
                <button type="submit" style="padding: 10px 22px; background: var(--c-primary); color: #fff; border: none; border-radius: var(--radius-sm); font-weight: 700; cursor: pointer;">Simpan Akun</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL EDIT PENGGUNA ================= -->
<div id="modalEditPengguna" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.55); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div style="background: var(--c-white); border-radius: var(--radius-md); width: 100%; max-width: 520px; padding: 28px; box-shadow: var(--shadow-lg); max-height: 90vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="font-size: 18px; font-weight: 800; color: var(--c-text-heading);">Edit Akun Pengguna</h3>
            <button type="button" onclick="closeModalEditPengguna()" style="font-size: 20px; font-weight: 700; color: var(--c-text-muted); cursor: pointer;">&times;</button>
        </div>

        <form id="formEditPengguna" method="POST">
            @csrf
            @method('PUT')
            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Nama Lengkap</label>
                <input type="text" name="name" id="editName" required style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
            </div>

            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Email</label>
                <input type="email" name="email" id="editEmail" required style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Peran (Role)</label>
                    <select name="role" id="editRole" onchange="toggleSpesialisasiEdit(this.value)" required style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; background: #fff;">
                        <option value="siswa">Siswa</option>
                        <option value="psikolog">Psikolog</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Status</label>
                    <select name="status" id="editStatus" required style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; background: #fff;">
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>
            </div>

            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Password (Kosongkan jika tidak diubah)</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak diubah" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
            </div>

            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">No. Telepon / WhatsApp</label>
                <input type="text" name="no_telepon" id="editNoTelepon" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
            </div>

            <div id="fieldSpesialisasiEdit" style="display: none; margin-bottom: 20px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Spesialisasi (Khusus Psikolog)</label>
                <input type="text" name="spesialisasi" id="editSpesialisasi" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px;">
                <button type="button" onclick="closeModalEditPengguna()" style="padding: 10px 18px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: var(--radius-sm); font-weight: 600; cursor: pointer;">Batal</button>
                <button type="submit" style="padding: 10px 22px; background: var(--c-primary); color: #fff; border: none; border-radius: var(--radius-sm); font-weight: 700; cursor: pointer;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModalTambahPengguna() {
    const modal = document.getElementById('modalTambahPengguna');
    modal.style.display = 'flex';
}
function closeModalTambahPengguna() {
    const modal = document.getElementById('modalTambahPengguna');
    modal.style.display = 'none';
}
function toggleSpesialisasiTambah(val) {
    const el = document.getElementById('fieldSpesialisasiTambah');
    el.style.display = (val === 'psikolog') ? 'block' : 'none';
}

function openModalEditPengguna(user) {
    const modal = document.getElementById('modalEditPengguna');
    const form = document.getElementById('formEditPengguna');
    form.action = `/admin/pengguna/${user.id}`;

    document.getElementById('editName').value = user.name || '';
    document.getElementById('editEmail').value = user.email || '';
    document.getElementById('editRole').value = user.role || 'siswa';
    document.getElementById('editStatus').value = user.status || 'Aktif';
    document.getElementById('editNoTelepon').value = user.no_telepon || '';
    document.getElementById('editSpesialisasi').value = user.spesialisasi || '';

    toggleSpesialisasiEdit(user.role);
    modal.style.display = 'flex';
}
function closeModalEditPengguna() {
    const modal = document.getElementById('modalEditPengguna');
    modal.style.display = 'none';
}
function toggleSpesialisasiEdit(val) {
    const el = document.getElementById('fieldSpesialisasiEdit');
    el.style.display = (val === 'psikolog') ? 'block' : 'none';
}
</script>
@endsection
