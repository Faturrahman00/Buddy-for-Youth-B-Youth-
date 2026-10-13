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
            <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                <span style="font-weight: 700; font-size: 13px; color: var(--c-text-muted); text-transform: uppercase;">Kategori:</span>
                <div style="display: flex; gap: 8px;">
                    <a href="{{ route('admin.asesmen', ['kategori' => 'SEMUA']) }}" 
                       style="padding: 6px 16px; border-radius: var(--radius-sm); font-size: 13px; text-decoration: none; {{ $kategoriAktif === 'SEMUA' ? 'background: var(--c-text-heading); color: var(--c-white); font-weight: 700;' : 'background: var(--c-white); color: var(--c-text-body); border: 1px solid var(--c-border); font-weight: 600;' }}">
                       SEMUA
                    </a>
                    <a href="{{ route('admin.asesmen', ['kategori' => 'MINAT']) }}" 
                       style="padding: 6px 16px; border-radius: var(--radius-sm); font-size: 13px; text-decoration: none; {{ $kategoriAktif === 'MINAT' ? 'background: var(--c-text-heading); color: var(--c-white); font-weight: 700;' : 'background: var(--c-white); color: var(--c-text-body); border: 1px solid var(--c-border); font-weight: 600;' }}">
                       MINAT
                    </a>
                    <a href="{{ route('admin.asesmen', ['kategori' => 'BAKAT']) }}" 
                       style="padding: 6px 16px; border-radius: var(--radius-sm); font-size: 13px; text-decoration: none; {{ $kategoriAktif === 'BAKAT' ? 'background: var(--c-text-heading); color: var(--c-white); font-weight: 700;' : 'background: var(--c-white); color: var(--c-text-body); border: 1px solid var(--c-border); font-weight: 600;' }}">
                       BAKAT
                    </a>
                    <a href="{{ route('admin.asesmen', ['kategori' => 'POTENSI']) }}" 
                       style="padding: 6px 16px; border-radius: var(--radius-sm); font-size: 13px; text-decoration: none; {{ $kategoriAktif === 'POTENSI' ? 'background: var(--c-text-heading); color: var(--c-white); font-weight: 700;' : 'background: var(--c-white); color: var(--c-text-body); border: 1px solid var(--c-border); font-weight: 600;' }}">
                       POTENSI
                    </a>
                </div>
            </div>
            
            <button type="button" onclick="openModalTambahSoal()" style="padding: 10px 20px; background-color: var(--c-primary); border: 2px solid var(--c-primary); border-radius: var(--radius-sm); font-weight: 700; font-size: 14px; color: var(--c-white); cursor: pointer; transition: background-color 0.2s; display: flex; align-items: center; gap: 8px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                TAMBAH SOAL ASESMEN
            </button>
        </div>

        <!-- Instruction info -->
        <div style="padding: 12px 16px; background: var(--c-bg); border: 1px solid var(--c-border); border-radius: var(--radius-sm); margin-bottom: 24px; font-size: 13px; color: var(--c-text-body); display: flex; justify-content: space-between; align-items: center;">
            <span>Kelola instrumen pertanyaan asesmen dan pilihan opsi bobot jawaban untuk evaluasi psikometrik minat-bakat siswa.</span>
            <span style="font-weight: 700; color: var(--c-primary);">Total Soal Aktif: {{ $soals->count() }}</span>
        </div>

        <!-- Questions List -->
        <div style="display: flex; flex-direction: column; gap: 16px;">
            @forelse($soals as $soal)
                <div style="border: 1.5px solid var(--c-border); border-radius: var(--radius-md); padding: 20px; background: var(--c-white);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 14px; gap: 16px;">
                        <div style="display: flex; gap: 16px; align-items: flex-start;">
                            <div style="font-weight: 800; font-size: 16px; color: var(--c-text-heading); padding: 4px 10px; background: var(--c-bg); border: 1px solid var(--c-border); border-radius: var(--radius-sm);">
                                #{{ $soal->nomor_urut }}
                            </div>
                            <div>
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                    @if($soal->kategori === 'MINAT')
                                        <span style="font-weight: 700; font-size: 11px; padding: 2px 8px; border: 1px solid #30618C; border-radius: 4px; text-transform: uppercase; background: #EAF2F8; color: #30618C;">MINAT</span>
                                    @elseif($soal->kategori === 'BAKAT')
                                        <span style="font-weight: 700; font-size: 11px; padding: 2px 8px; border: 1px solid #F2B705; border-radius: 4px; text-transform: uppercase; background: #FFF9E6; color: #7A5400;">BAKAT</span>
                                    @else
                                        <span style="font-weight: 700; font-size: 11px; padding: 2px 8px; border: 1px solid #12B76A; border-radius: 4px; text-transform: uppercase; background: #ECFDF3; color: #027A48;">POTENSI</span>
                                    @endif
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
                            <form action="{{ route('admin.asesmen.destroy', $soal->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus soal asesmen #{{ $soal->nomor_urut }}?');">
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
                    Belum ada soal pada kategori <strong>{{ $kategoriAktif }}</strong>. Klik tombol <strong>+ TAMBAH SOAL ASESMEN</strong> di atas untuk menambahkan.
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
                                    <div style="font-weight: 600; color: var(--c-text-heading); margin-bottom: 2px;">Minat: {{ Str::limit($item->hasilAsesmen->minat, 40) }}</div>
                                    <div style="color: var(--c-text-muted);">Bakat: {{ Str::limit($item->hasilAsesmen->bakat, 40) }}</div>
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
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Kategori Instrumen</label>
                    <select name="kategori" required style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; background: #fff;">
                        <option value="MINAT">MINAT (Minat Studi & Preferensi Bidang)</option>
                        <option value="BAKAT">BAKAT (Bakat Alami & Kegemaran)</option>
                        <option value="POTENSI">POTENSI (Potensi Logika & Kognitif)</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Nomor Urut</label>
                    <input type="number" name="nomor_urut" placeholder="Otomatis" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
                </div>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Teks Pertanyaan</label>
                <textarea name="pertanyaan" required rows="3" placeholder="Tuliskan pertanyaan asesmen secara lugas dan mudah dipahami siswa..." style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; resize: vertical;"></textarea>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Opsi Pilihan Jawaban & Bobot</label>
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    @foreach(['A' => 5, 'B' => 4, 'C' => 3, 'D' => 2, 'E' => 1] as $lbl => $bbt)
                        <div style="display: flex; gap: 8px; align-items: center;">
                            <span style="font-weight: 800; font-size: 13px; width: 24px; color: var(--c-text-heading);">{{ $lbl }}.</span>
                            <input type="text" name="opsi[{{ $loop->index }}][teks]" placeholder="Teks opsi {{ $lbl }}" style="flex: 1; padding: 8px 12px; border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-size: 13px; outline: none;">
                            <input type="hidden" name="opsi[{{ $loop->index }}][label]" value="{{ $lbl }}">
                            <input type="number" name="opsi[{{ $loop->index }}][bobot]" value="{{ $bbt }}" min="1" max="10" title="Bobot nilai" style="width: 70px; padding: 8px 8px; border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-size: 13px; text-align: center; outline: none;">
                        </div>
                    @endforeach
                </div>
                <small style="color: var(--c-text-muted); font-size: 11px; margin-top: 4px; display: block;">Jika dikosongkan, sistem akan otomatis menggunakan skala 5 opsi standar (Sangat Sesuai s/d Sangat Tidak Sesuai).</small>
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
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Kategori Instrumen</label>
                    <select name="kategori" id="editSoalKategori" required style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; background: #fff;">
                        <option value="MINAT">MINAT</option>
                        <option value="BAKAT">BAKAT</option>
                        <option value="POTENSI">POTENSI</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Nomor Urut</label>
                    <input type="number" name="nomor_urut" id="editSoalNomor" required style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none;">
                </div>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Teks Pertanyaan</label>
                <textarea name="pertanyaan" id="editSoalPertanyaan" required rows="3" style="width: 100%; padding: 10px 14px; border: 1.5px solid var(--c-border); border-radius: var(--radius-sm); font-size: 14px; outline: none; resize: vertical;"></textarea>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 6px;">Pilihan Jawaban (A - E)</label>
                <div id="editOpsiContainer" style="display: flex; flex-direction: column; gap: 8px;">
                    <!-- JS renders inputs here -->
                </div>
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
    form.action = `/admin/asesmen/${soal.id}`;

    document.getElementById('editSoalKategori').value = soal.kategori || 'MINAT';
    document.getElementById('editSoalNomor').value = soal.nomor_urut || '1';
    document.getElementById('editSoalPertanyaan').value = soal.pertanyaan || '';

    const container = document.getElementById('editOpsiContainer');
    container.innerHTML = '';
    const opsiList = Array.isArray(soal.pilihan_jawaban) && soal.pilihan_jawaban.length > 0 
        ? soal.pilihan_jawaban 
        : [
            {label: 'A', teks: '', bobot: 5},
            {label: 'B', teks: '', bobot: 4},
            {label: 'C', teks: '', bobot: 3},
            {label: 'D', teks: '', bobot: 2},
            {label: 'E', teks: '', bobot: 1}
        ];

    opsiList.forEach((opt, idx) => {
        const row = document.createElement('div');
        row.style.cssText = 'display: flex; gap: 8px; align-items: center;';
        row.innerHTML = `
            <span style="font-weight: 800; font-size: 13px; width: 24px; color: var(--c-text-heading);">${opt.label || String.fromCharCode(65 + idx)}.</span>
            <input type="text" name="opsi[${idx}][teks]" value="${opt.teks || ''}" placeholder="Teks opsi" style="flex: 1; padding: 8px 12px; border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-size: 13px; outline: none;">
            <input type="hidden" name="opsi[${idx}][label]" value="${opt.label || String.fromCharCode(65 + idx)}">
            <input type="number" name="opsi[${idx}][bobot]" value="${opt.bobot || (5 - idx)}" min="1" max="10" style="width: 70px; padding: 8px; border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-size: 13px; text-align: center; outline: none;">
        `;
        container.appendChild(row);
    });

    modal.style.display = 'flex';
}
function closeModalEditSoal() {
    document.getElementById('modalEditSoal').style.display = 'none';
}
</script>
@endsection
