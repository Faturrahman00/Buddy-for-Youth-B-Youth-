@extends('Admin.layout.app')

@section('content')
@php
    $pageTitle = 'Kelola Asesmen dan Jawaban';
    $active = 'kelola-asesmen';
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

    <!-- Tabs Navigation -->
    <div style="display: flex; gap: 24px; border-bottom: 1.5px solid var(--c-border); margin-bottom: 24px;">
        <button type="button" id="tabBtnSoal" onclick="switchAsesmenTab('soal')" style="padding-bottom: 12px; border-bottom: 2px solid var(--c-text-heading); font-weight: 800; color: var(--c-text-heading); font-size: 15px; cursor: pointer; background: transparent; border-top: none; border-left: none; border-right: none;">
            Kelola Bank Soal Asesmen ({{ $soals->count() }})
        </button>
        <button type="button" id="tabBtnRiwayat" onclick="switchAsesmenTab('riwayat')" style="padding-bottom: 12px; border-bottom: 2px solid transparent; font-weight: 600; color: var(--c-text-muted); font-size: 15px; cursor: pointer; background: transparent; border-top: none; border-left: none; border-right: none;">
            Riwayat Asesmen Siswa ({{ $riwayatAsesmen->total() }})
        </button>
    </div>

    <!-- TAB 1: BANK SOAL ASESMEN -->
    <div id="tabContentSoal">
        <!-- Filters & Actions -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
            <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                <span style="font-weight: 700; font-size: 13px; color: var(--c-text-muted); text-transform: uppercase;">Dimensi RIASEC:</span>
                <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                    @php
                        $dimensiList = [
                            'SEMUA' => 'Semua (42)',
                            'R' => 'R — Realistic',
                            'I' => 'I — Investigative',
                            'A' => 'A — Artistic',
                            'S' => 'S — Social',
                            'E' => 'E — Enterprising',
                            'C' => 'C — Conventional',
                        ];
                    @endphp
                    @foreach($dimensiList as $key => $lbl)
                        <a href="{{ route('admin.asesmen', ['dimensi' => $key]) }}" 
                           style="padding: 6px 14px; border-radius: var(--radius-sm); font-size: 13px; text-decoration: none; {{ ($dimensiAktif ?? 'SEMUA') === $key ? 'background: var(--c-primary); color: var(--c-white); font-weight: 700;' : 'background: var(--c-white); color: var(--c-text-body); border: 1px solid var(--c-border); font-weight: 600;' }}">
                           {{ $lbl }}
                        </a>
                    @endforeach
                </div>
            </div>
            
            <button type="button" onclick="openModalTambahSoal()" style="padding: 10px 20px; background-color: var(--c-primary); border: 2px solid var(--c-primary); border-radius: var(--radius-sm); font-weight: 700; font-size: 14px; color: var(--c-white); cursor: pointer; transition: background-color 0.2s; display: flex; align-items: center; gap: 8px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                TAMBAH SOAL ASESMEN
            </button>
        </div>

        <!-- Instruction info -->
        <div style="padding: 12px 16px; background: var(--c-bg); border: 1px solid var(--c-border); border-radius: var(--radius-sm); margin-bottom: 24px; font-size: 13px; color: var(--c-text-body); display: flex; justify-content: space-between; align-items: center;">
            <span>Bank soal asesmen terpadu berbasis model <strong>Holland RIASEC</strong> (skala Likert 5 poin A–E).</span>
            <span style="font-weight: 700; color: var(--c-primary);">Total Soal Aktif: {{ $soals->count() }}</span>
        </div>

        <!-- Questions List -->
        <div style="display: flex; flex-direction: column; gap: 16px;">
            @forelse($soals as $soal)
                <div style="border: 1.5px solid var(--c-border); border-radius: var(--radius-md); padding: 20px; background: var(--c-white);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 14px; gap: 16px;">
                        <div style="display: flex; gap: 16px; align-items: flex-start;">
                            <div style="font-weight: 800; font-size: 16px; color: var(--c-text-heading); padding: 4px 10px; background: var(--c-bg); border: 1px solid var(--c-border); border-radius: var(--radius-sm);">
                                #{{ $soal->id_asesmen }}
                            </div>
                            <div>
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                    @php
                                        $typeChar = strtoupper($soal->tipe_riasec ?? substr($soal->kategori, 0, 1));
                                        $badgeMap = [
                                            'R' => ['label' => 'R — REALISTIC', 'bg' => '#EAF2F8', 'color' => '#30618C', 'border' => '#30618C'],
                                            'I' => ['label' => 'I — INVESTIGATIVE', 'bg' => '#E0F2FE', 'color' => '#026AA2', 'border' => '#0BA5EC'],
                                            'A' => ['label' => 'A — ARTISTIC', 'bg' => '#FDF2FA', 'color' => '#C11574', 'border' => '#EE46BC'],
                                            'S' => ['label' => 'S — SOCIAL', 'bg' => '#ECFDF3', 'color' => '#027A48', 'border' => '#12B76A'],
                                            'E' => ['label' => 'E — ENTERPRISING', 'bg' => '#FFF9E6', 'color' => '#7A5400', 'border' => '#F2B705'],
                                            'C' => ['label' => 'C — CONVENTIONAL', 'bg' => '#F4EBFF', 'color' => '#6941C6', 'border' => '#9E77ED'],
                                        ];
                                        $badge = $badgeMap[$typeChar] ?? ['label' => 'RIASEC', 'bg' => '#EAF2F8', 'color' => '#30618C', 'border' => '#30618C'];
                                    @endphp
                                    <span style="font-weight: 700; font-size: 11px; padding: 2px 8px; border: 1px solid {{ $badge['border'] }}; border-radius: 4px; text-transform: uppercase; background: {{ $badge['bg'] }}; color: {{ $badge['color'] }};">
                                        {{ $badge['label'] }}
                                    </span>
                                    <span style="font-size: 13px; color: var(--c-text-muted);">{{ count($soal->pilihan_jawaban ?? []) }} Pilihan Jawaban</span>
                                </div>
                                <div style="font-weight: 700; font-size: 15px; color: var(--c-text-heading); line-height: 1.4;">{{ $soal->pertanyaan }}</div>
                            </div>
                        </div>
                        <div style="display: flex; gap: 8px; flex-shrink: 0;">
                            <button type="button" 
                                onclick='openModalEditSoal(@json($soal))'
                                style="padding: 6px 14px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: var(--radius-sm); font-size: 12px; font-weight: 700; cursor: pointer; color: var(--c-primary);">
                                EDIT SOAL
                            </button>
                            <form action="{{ route('admin.asesmen.destroy', $soal->id_asesmen) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus soal asesmen #{{ $soal->id_asesmen }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="padding: 6px 14px; border: 1px solid #FECDCA; background: #FFF4F2; color: #B42318; border-radius: var(--radius-sm); font-size: 12px; font-weight: 700; cursor: pointer;">
                                    HAPUS
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Choices Preview -->
                    @if(!empty($soal->pilihan_jawaban))
                        <div style="margin-top: 12px; padding-top: 12px; border-top: 1px dashed var(--c-border); display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 8px;">
                            @foreach($soal->pilihan_jawaban as $opt)
                                <div style="font-size: 12px; color: var(--c-text-body); background: var(--c-bg); padding: 6px 10px; border-radius: 6px; display: flex; justify-content: space-between; align-items: center;">
                                    <span><strong>{{ $opt['label'] ?? '-' }}.</strong> {{ Str::limit($opt['teks'] ?? '', 40) }}</span>
                                    <span style="font-weight: 700; font-size: 11px; color: var(--c-text-muted); background: var(--c-white); padding: 1px 6px; border-radius: 4px; border: 1px solid var(--c-border);">Bobot {{ $opt['bobot'] ?? 0 }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <div style="padding: 40px; text-align: center; border: 1.5px dashed var(--c-border); border-radius: var(--radius-md); color: var(--c-text-muted);">
                    Belum ada soal pada filter dimensi <strong>{{ $dimensiAktif ?? 'SEMUA' }}</strong>. Klik tombol <strong>+ TAMBAH SOAL ASESMEN</strong> di atas untuk menambahkan.
                </div>
            @endforelse
        </div>
    </div>

    <!-- TAB 2: RIWAYAT & HASIL ASESMEN SISWA -->
    <div id="tabContentRiwayat" style="display: none;">
        <div style="overflow-x: auto; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); background: var(--c-white);">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                <thead>
                    <tr style="background-color: var(--c-bg); border-bottom: 1.5px solid var(--c-border);">
                        <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase;">ID Asesmen</th>
                        <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase;">Nama Siswa</th>
                        <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase;">Tanggal</th>
                        <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase;">Hasil Analisis</th>
                        <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase;">Rekomendasi Teratas</th>
                        <th style="padding: 16px; font-weight: 800; color: var(--c-text-heading); text-transform: uppercase; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatAsesmen as $item)
                        <tr style="border-bottom: 1px solid var(--c-border);">
                            <td style="padding: 16px; font-weight: 700; color: var(--c-text-heading);">ASM-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td style="padding: 16px;">
                                <div style="font-weight: 700; color: var(--c-text-heading);">{{ $item->user->name ?? 'Siswa' }}</div>
                                <div style="font-size: 12px; color: var(--c-text-muted);">{{ $item->user->email ?? '-' }}</div>
                            </td>
                            <td style="padding: 16px; color: var(--c-text-muted); font-size: 13px;">
                                {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y, H:i') : '-' }}
                            </td>
                            <td style="padding: 16px; font-size: 13px;">
                                @if($item->hasilAsesmen)
                                    <div style="font-weight: 700; color: var(--c-primary); margin-bottom: 3px;">Kode: {{ $item->hasilAsesmen->holland_code ?? 'Holland RIASEC' }}</div>
                                    <div style="color: var(--c-text-body); font-size: 12px; line-height: 1.4;">{{ Str::limit($item->hasilAsesmen->minat, 70) }}</div>
                                @else
                                    <span style="color: var(--c-text-muted); font-style: italic;">Sedang diproses</span>
                                @endif
                            </td>
                            <td style="padding: 16px;">
                                @if($item->hasilAsesmen && $item->hasilAsesmen->rekomendasi->isNotEmpty())
                                    @php $topRec = $item->hasilAsesmen->rekomendasi->first(); @endphp
                                    <span style="font-weight: 700; color: var(--c-primary); font-size: 13px;">{{ $topRec->programStudi->nama_prodi ?? 'Prodi' }}</span>
                                    <span style="margin-left: 6px; padding: 2px 6px; background: #EBFDF2; color: #027A48; font-size: 11px; font-weight: 700; border-radius: 4px;">{{ $topRec->skor }}% Cocok</span>
                                @else
                                    <span style="color: var(--c-text-muted); font-size: 13px;">-</span>
                                @endif
                            </td>
                            <td style="padding: 16px; text-align: center;">
                                <form action="{{ route('admin.asesmen.destroy_siswa', $item->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus riwayat asesmen siswa ini?');">
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
                                Belum ada riwayat pengerjaan asesmen siswa.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $riwayatAsesmen->links() }}
        </div>
    </div>
</div>

<!-- ================= MODAL TAMBAH SOAL ================= -->
<div id="modalTambahSoal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.55); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div style="background: var(--c-white); border-radius: var(--radius-md); width: 100%; max-width: 620px; padding: 28px; box-shadow: var(--shadow-lg); max-height: 90vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="font-size: 18px; font-weight: 800; color: var(--c-text-heading);">Tambah Soal Asesmen Baru</h3>
            <button type="button" onclick="closeModalTambahSoal()" style="font-size: 20px; font-weight: 700; color: var(--c-text-muted); cursor: pointer;">&times;</button>
        </div>

        <form action="{{ route('admin.asesmen.store') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px; margin-bottom: 14px;">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Dimensi Holland RIASEC</label>
                    <select name="tipe_riasec" required style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; background: #fff;">
                        <option value="R - Realistic">R — Realistic (Praktikal & Keteknikan)</option>
                        <option value="I - Investigative">I — Investigative (Analitis & Riset Ilmiah)</option>
                        <option value="A - Artistic">A — Artistic (Kreatif, Desain & Ekspresi Seni)</option>
                        <option value="S - Social">S — Social (Sosial, Pelayanan & Kolaborasi)</option>
                        <option value="E - Enterprising">E — Enterprising (Kepemimpinan, Negosiasi & Bisnis)</option>
                        <option value="C - Conventional">C — Conventional (Organisasi, Data & Keteraturan)</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">ID Asesmen (PK)</label>
                    <div style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; background: #F8FAFC; color: var(--c-text-heading); font-weight: 700; display: flex; align-items: center; justify-content: space-between;">
                        <span>#Otomatis</span>
                        <span style="font-size: 11px; font-weight: 700; color: var(--c-primary); background: #EAF2F8; padding: 2px 8px; border-radius: 4px;">Auto Increment</span>
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Teks Pertanyaan</label>
                <textarea name="pertanyaan" required rows="3" placeholder="Tuliskan pertanyaan asesmen secara lugas dan mudah dipahami siswa..." style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; resize: vertical;"></textarea>
            </div>

            <div style="padding: 12px 14px; background: #F8FAFC; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); margin-bottom: 20px; font-size: 13px; color: var(--c-text-body); display: flex; align-items: center; justify-content: space-between;">
                <span style="display: flex; align-items: center; gap: 8px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--c-primary); flex-shrink: 0;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    Pilihan jawaban otomatis terkunci pada <strong>Skala Likert Baku (A–E)</strong>
                </span>
                <span style="font-size: 11px; font-weight: 700; color: var(--c-primary); background: #EAF2F8; padding: 2px 8px; border-radius: 4px;">Bobot 1–5 Baku</span>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px;">
                <button type="button" onclick="closeModalTambahSoal()" style="padding: 10px 18px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: var(--radius-sm); font-weight: 600; cursor: pointer;">Batal</button>
                <button type="submit" style="padding: 10px 22px; background: var(--c-primary); color: #fff; border: none; border-radius: var(--radius-sm); font-weight: 700; cursor: pointer;">Simpan Soal</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL EDIT SOAL ================= -->
<div id="modalEditSoal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.55); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div style="background: var(--c-white); border-radius: var(--radius-md); width: 100%; max-width: 620px; padding: 28px; box-shadow: var(--shadow-lg); max-height: 90vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="font-size: 18px; font-weight: 800; color: var(--c-text-heading);">Edit Soal Asesmen</h3>
            <button type="button" onclick="closeModalEditSoal()" style="font-size: 20px; font-weight: 700; color: var(--c-text-muted); cursor: pointer;">&times;</button>
        </div>

        <form id="formEditSoal" method="POST">
            @csrf
            @method('PUT')
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px; margin-bottom: 14px;">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Dimensi Holland RIASEC</label>
                    <select name="tipe_riasec" id="editSoalTipeRiasec" required style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; background: #fff;">
                        <option value="R - Realistic">R — Realistic (Praktikal & Keteknikan)</option>
                        <option value="I - Investigative">I — Investigative (Analitis & Riset Ilmiah)</option>
                        <option value="A - Artistic">A — Artistic (Kreatif, Desain & Ekspresi Seni)</option>
                        <option value="S - Social">S — Social (Sosial, Pelayanan & Kolaborasi)</option>
                        <option value="E - Enterprising">E — Enterprising (Kepemimpinan, Negosiasi & Bisnis)</option>
                        <option value="C - Conventional">C — Conventional (Organisasi, Data & Keteraturan)</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">ID Asesmen (PK)</label>
                    <div style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; background: #F8FAFC; color: var(--c-text-heading); font-weight: 700; display: flex; align-items: center; justify-content: space-between;">
                        <span id="editSoalNomorText">#1</span>
                        <span style="font-size: 11px; font-weight: 700; color: var(--c-primary); background: #EAF2F8; padding: 2px 8px; border-radius: 4px;">Primary Key</span>
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Teks Pertanyaan</label>
                <textarea name="pertanyaan" id="editSoalPertanyaan" required rows="4" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; resize: vertical;"></textarea>
            </div>

            <div style="padding: 12px 14px; background: #F8FAFC; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); margin-bottom: 20px; font-size: 13px; color: var(--c-text-body); display: flex; align-items: center; justify-content: space-between;">
                <span style="display: flex; align-items: center; gap: 8px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--c-primary); flex-shrink: 0;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    Pilihan jawaban otomatis terkunci pada <strong>Skala Likert Baku (A–E)</strong>
                </span>
                <span style="font-size: 11px; font-weight: 700; color: var(--c-primary); background: #EAF2F8; padding: 2px 8px; border-radius: 4px;">Bobot 1–5 Baku</span>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px;">
                <button type="button" onclick="closeModalEditSoal()" style="padding: 10px 18px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: var(--radius-sm); font-weight: 600; cursor: pointer;">Batal</button>
                <button type="submit" style="padding: 10px 22px; background: var(--c-primary); color: #fff; border: none; border-radius: var(--radius-sm); font-weight: 700; cursor: pointer;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
function switchAsesmenTab(tab) {
    const tabSoal = document.getElementById('tabContentSoal');
    const tabRiwayat = document.getElementById('tabContentRiwayat');
    const btnSoal = document.getElementById('tabBtnSoal');
    const btnRiwayat = document.getElementById('tabBtnRiwayat');

    if (tab === 'soal') {
        tabSoal.style.display = 'block';
        tabRiwayat.style.display = 'none';
        btnSoal.style.borderBottomColor = 'var(--c-text-heading)';
        btnSoal.style.color = 'var(--c-text-heading)';
        btnSoal.style.fontWeight = '800';
        btnRiwayat.style.borderBottomColor = 'transparent';
        btnRiwayat.style.color = 'var(--c-text-muted)';
        btnRiwayat.style.fontWeight = '600';
    } else {
        tabSoal.style.display = 'none';
        tabRiwayat.style.display = 'block';
        btnRiwayat.style.borderBottomColor = 'var(--c-text-heading)';
        btnRiwayat.style.color = 'var(--c-text-heading)';
        btnRiwayat.style.fontWeight = '800';
        btnSoal.style.borderBottomColor = 'transparent';
        btnSoal.style.color = 'var(--c-text-muted)';
        btnSoal.style.fontWeight = '600';
    }
}

function openModalTambahSoal() {
    document.getElementById('modalTambahSoal').style.display = 'flex';
}
function closeModalTambahSoal() {
    document.getElementById('modalTambahSoal').style.display = 'none';
}

function openModalEditSoal(soal) {
    const modal = document.getElementById('modalEditSoal');
    const form = document.getElementById('formEditSoal');
    form.action = `/admin/asesmen/${soal.id_asesmen || soal.id}`;

    const typeChar = (soal.tipe_riasec ? soal.tipe_riasec.charAt(0) : 'R').toUpperCase();
    const mapVal = {
        'R': 'R - Realistic',
        'I': 'I - Investigative',
        'A': 'A - Artistic',
        'S': 'S - Social',
        'E': 'E - Enterprising',
        'C': 'C - Conventional'
    };
    document.getElementById('editSoalTipeRiasec').value = mapVal[typeChar] || 'R - Realistic';
    document.getElementById('editSoalNomorText').textContent = '#' + (soal.id_asesmen || soal.id || '1');
    document.getElementById('editSoalPertanyaan').value = soal.pertanyaan || '';

    modal.style.display = 'flex';
}
function closeModalEditSoal() {
    document.getElementById('modalEditSoal').style.display = 'none';
}
</script>
@endsection
