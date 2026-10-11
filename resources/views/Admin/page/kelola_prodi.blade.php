@extends('Admin.layout.app')

@section('content')
@php
    $pageTitle = 'Kelola Program Studi';
    $active = 'kelola-prodi';
@endphp

<div class="steps-card-container" style="padding: 24px;">
    <!-- Top Controls -->
    <div style="display: flex; gap: 16px; margin-bottom: 24px; flex-wrap: wrap;">
        <!-- Search -->
        <div style="flex: 1; min-width: 250px; position: relative;">
            <div style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--c-text-muted);">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </div>
            <input type="text" placeholder="Cari Program Studi / Kode..." style="width: 100%; padding: 10px 10px 10px 38px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; transition: border-color 0.2s;">
        </div>
        
        <!-- Filters -->
        <select style="padding: 10px 16px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; background: var(--c-white); color: var(--c-text-body); cursor: pointer;">
            <option>Semua Jenjang</option>
            <option>S1</option>
            <option>D3</option>
            <option>D4</option>
        </select>
        
        <!-- Button Tambah -->
        <button style="padding: 10px 20px; background-color: var(--c-white); border: 2px solid var(--c-text-heading); border-radius: var(--radius-sm); font-weight: 700; font-size: 14px; color: var(--c-text-heading); cursor: pointer; transition: background-color 0.2s;">
            + TAMBAH PROGRAM STUDI
        </button>
    </div>

    <!-- Table -->
    <div style="overflow-x: auto; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm);">
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
            <thead>
                <tr style="background-color: var(--c-bg); border-bottom: 1.5px solid var(--c-border);">
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase; white-space: nowrap;">Kode Prodi</th>
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase;">Nama Program Studi</th>
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase;">Fakultas</th>
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase; text-align: center;">Akreditasi</th>
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase; width: 30%;">Deskripsi Singkat</th>
                    <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase; text-align: center; white-space: nowrap;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Row 1 -->
                <tr style="border-bottom: 1px solid var(--c-border);">
                    <td style="padding: 16px; font-weight: 700; color: var(--c-text-heading);">PRODI-01</td>
                    <td style="padding: 16px; font-weight: 600;">Teknik Informatika</td>
                    <td style="padding: 16px; color: var(--c-text-muted);">Ilmu Komputer</td>
                    <td style="padding: 16px; text-align: center;">
                        <span style="padding: 4px 10px; border: 1px solid var(--c-text-heading); border-radius: var(--radius-sm); font-size: 12px; font-weight: 700; background: var(--c-white); color: var(--c-text-heading);">Unggul</span>
                    </td>
                    <td style="padding: 16px; color: var(--c-text-muted); font-size: 13px;">Mempelajari pengembangan perangkat lunak, arsitektur siste...</td>
                    <td style="padding: 16px; text-align: center; white-space: nowrap;">
                        <button style="padding: 4px 10px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: 4px; font-size: 12px; font-weight: 600; margin-right: 4px;">EDIT</button>
                        <button style="padding: 4px 10px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: 4px; font-size: 12px; font-weight: 600;">HAPUS</button>
                    </td>
                </tr>
                <!-- Row 2 -->
                <tr style="border-bottom: 1px solid var(--c-border);">
                    <td style="padding: 16px; font-weight: 700; color: var(--c-text-heading);">PRODI-02</td>
                    <td style="padding: 16px; font-weight: 600;">Psikologi</td>
                    <td style="padding: 16px; color: var(--c-text-muted);">Psikologi</td>
                    <td style="padding: 16px; text-align: center;">
                        <span style="padding: 4px 10px; border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-size: 12px; font-weight: 700; background: var(--c-white); color: var(--c-text-heading);">A</span>
                    </td>
                    <td style="padding: 16px; color: var(--c-text-muted); font-size: 13px;">Mempelajari perilaku manusia, proses mental, asesmen psiko...</td>
                    <td style="padding: 16px; text-align: center; white-space: nowrap;">
                        <button style="padding: 4px 10px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: 4px; font-size: 12px; font-weight: 600; margin-right: 4px;">EDIT</button>
                        <button style="padding: 4px 10px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: 4px; font-size: 12px; font-weight: 600;">HAPUS</button>
                    </td>
                </tr>
                <!-- Row 3 -->
                <tr style="border-bottom: 1px solid var(--c-border);">
                    <td style="padding: 16px; font-weight: 700; color: var(--c-text-heading);">PRODI-03</td>
                    <td style="padding: 16px; font-weight: 600;">Desain Komunikasi Visual</td>
                    <td style="padding: 16px; color: var(--c-text-muted);">Seni Rupa & Desain</td>
                    <td style="padding: 16px; text-align: center;">
                        <span style="padding: 4px 10px; border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-size: 12px; font-weight: 700; background: var(--c-white); color: var(--c-text-heading);">A</span>
                    </td>
                    <td style="padding: 16px; color: var(--c-text-muted); font-size: 13px;">Mempelajari perancangan komunikasi visual melalui media c...</td>
                    <td style="padding: 16px; text-align: center; white-space: nowrap;">
                        <button style="padding: 4px 10px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: 4px; font-size: 12px; font-weight: 600; margin-right: 4px;">EDIT</button>
                        <button style="padding: 4px 10px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: 4px; font-size: 12px; font-weight: 600;">HAPUS</button>
                    </td>
                </tr>
                <!-- Row 4 -->
                <tr style="border-bottom: 1px solid var(--c-border);">
                    <td style="padding: 16px; font-weight: 700; color: var(--c-text-heading);">PRODI-04</td>
                    <td style="padding: 16px; font-weight: 600;">Sistem Informasi</td>
                    <td style="padding: 16px; color: var(--c-text-muted);">Ilmu Komputer</td>
                    <td style="padding: 16px; text-align: center;">
                        <span style="padding: 4px 10px; border: 1px solid var(--c-text-heading); border-radius: var(--radius-sm); font-size: 12px; font-weight: 700; background: var(--c-white); color: var(--c-text-heading);">Unggul</span>
                    </td>
                    <td style="padding: 16px; color: var(--c-text-muted); font-size: 13px;">Mengintegrasikan teknologi informasi dengan proses bisnis s...</td>
                    <td style="padding: 16px; text-align: center; white-space: nowrap;">
                        <button style="padding: 4px 10px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: 4px; font-size: 12px; font-weight: 600; margin-right: 4px;">EDIT</button>
                        <button style="padding: 4px 10px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: 4px; font-size: 12px; font-weight: 600;">HAPUS</button>
                    </td>
                </tr>
                <!-- Row 5 -->
                <tr>
                    <td style="padding: 16px; font-weight: 700; color: var(--c-text-heading);">PRODI-05</td>
                    <td style="padding: 16px; font-weight: 600;">Ilmu Komunikasi</td>
                    <td style="padding: 16px; color: var(--c-text-muted);">Ilmu Sosial & Ilmu Politik</td>
                    <td style="padding: 16px; text-align: center;">
                        <span style="padding: 4px 10px; border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-size: 12px; font-weight: 700; background: var(--c-white); color: var(--c-text-heading);">A</span>
                    </td>
                    <td style="padding: 16px; color: var(--c-text-muted); font-size: 13px;">Fokus pada media massa, kehumasan publik, relasi korporat, ...</td>
                    <td style="padding: 16px; text-align: center; white-space: nowrap;">
                        <button style="padding: 4px 10px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: 4px; font-size: 12px; font-weight: 600; margin-right: 4px;">EDIT</button>
                        <button style="padding: 4px 10px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: 4px; font-size: 12px; font-weight: 600;">HAPUS</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; font-size: 13px; color: var(--c-text-muted);">
        <span>Menampilkan 5 program studi</span>
        <div style="display: flex; gap: 4px;">
            <button style="padding: 6px 10px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: 4px; cursor: pointer;">&lt;</button>
            <button style="padding: 6px 12px; border: 1px solid var(--c-text-heading); background: var(--c-text-heading); color: var(--c-white); border-radius: 4px; font-weight: 700; cursor: pointer;">1</button>
            <button style="padding: 6px 10px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: 4px; cursor: pointer;">&gt;</button>
        </div>
    </div>
</div>
@endsection
