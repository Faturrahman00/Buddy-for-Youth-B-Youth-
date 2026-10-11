@extends('Admin.layout.app')

@section('content')
@php
    $pageTitle = 'Kelola Asesmen dan Jawaban';
    $active = 'kelola-asesmen';
@endphp

<div class="steps-card-container" style="padding: 24px;">
    <!-- Tabs Navigation -->
    <div style="display: flex; gap: 24px; border-bottom: 1.5px solid var(--c-border); margin-bottom: 24px;">
        <button style="padding-bottom: 12px; border-bottom: 2px solid var(--c-text-heading); font-weight: 800; color: var(--c-text-heading); font-size: 15px; cursor: pointer;">Kelola Asesmen</button>
        <button style="padding-bottom: 12px; font-weight: 600; color: var(--c-text-muted); font-size: 15px; cursor: pointer;">Kelola Jawaban</button>
    </div>

    <!-- Filters & Actions -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <span style="font-weight: 700; font-size: 13px; color: var(--c-text-muted); text-transform: uppercase;">Kategori:</span>
            <div style="display: flex; gap: 8px;">
                <button style="padding: 6px 16px; background: var(--c-text-heading); color: var(--c-white); border: 1px solid var(--c-text-heading); border-radius: var(--radius-sm); font-weight: 700; font-size: 13px;">SEMUA</button>
                <button style="padding: 6px 16px; background: var(--c-white); color: var(--c-text-body); border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-weight: 600; font-size: 13px;">MINAT</button>
                <button style="padding: 6px 16px; background: var(--c-white); color: var(--c-text-body); border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-weight: 600; font-size: 13px;">BAKAT</button>
                <button style="padding: 6px 16px; background: var(--c-white); color: var(--c-text-body); border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-weight: 600; font-size: 13px;">POTENSI</button>
            </div>
        </div>
        
        <button style="padding: 10px 20px; background-color: var(--c-white); border: 2px solid var(--c-text-heading); border-radius: var(--radius-sm); font-weight: 700; font-size: 14px; color: var(--c-text-heading); cursor: pointer; transition: background-color 0.2s;">
            + TAMBAH SOAL ASESMEN
        </button>
    </div>

    <!-- Warning / Instruction info -->
    <div style="padding: 12px 16px; background: var(--c-bg); border: 1px solid var(--c-border); border-radius: var(--radius-sm); margin-bottom: 24px; font-size: 13px; color: var(--c-text-body);">
        Kelola pilihan jawaban untuk setiap pertanyaan asesmen (Opsi A - E dan bobot nilai).
    </div>

    <!-- Questions List (Combined view based on wireframe 4 and 5) -->
    <div style="display: flex; flex-direction: column; gap: 16px;">
        <!-- Question 1 -->
        <div style="border: 1.5px solid var(--c-border); border-radius: var(--radius-md); padding: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
                <div style="display: flex; gap: 16px;">
                    <div style="font-weight: 800; font-size: 16px; color: var(--c-text-heading); padding: 4px 10px; background: var(--c-bg); border: 1px solid var(--c-border); border-radius: var(--radius-sm);">#1</div>
                    <div>
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                            <span style="font-weight: 700; font-size: 11px; padding: 2px 8px; border: 1px solid var(--c-text-heading); border-radius: 4px; text-transform: uppercase;">MINAT</span>
                            <span style="font-size: 13px; color: var(--c-text-muted);">5 Pilihan Jawaban</span>
                        </div>
                        <div style="font-weight: 700; font-size: 15px; color: var(--c-text-heading);">Ketika menghadapi masalah rumit, bagaimana caramu paling senang menyelesaikannya?</div>
                    </div>
                </div>
                <div style="display: flex; gap: 8px; flex-shrink: 0;">
                    <button style="padding: 6px 12px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: var(--radius-sm); font-size: 12px; font-weight: 700;">EDIT SOAL</button>
                    <button style="padding: 6px 12px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: var(--radius-sm); font-size: 12px; font-weight: 700;">HAPUS</button>
                </div>
            </div>
        </div>
        
        <!-- Question 2 -->
        <div style="border: 1.5px solid var(--c-border); border-radius: var(--radius-md); padding: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div style="display: flex; gap: 16px;">
                    <div style="font-weight: 800; font-size: 16px; color: var(--c-text-heading); padding: 4px 10px; background: var(--c-bg); border: 1px solid var(--c-border); border-radius: var(--radius-sm);">#2</div>
                    <div>
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                            <span style="font-weight: 700; font-size: 11px; padding: 2px 8px; border: 1px solid var(--c-text-heading); border-radius: 4px; text-transform: uppercase;">BAKAT</span>
                            <span style="font-size: 13px; color: var(--c-text-muted);">5 Pilihan Jawaban</span>
                        </div>
                        <div style="font-weight: 700; font-size: 15px; color: var(--c-text-heading);">Aktivitas ekstrakurikuler atau kegiatan luang apa yang paling membuatmu bersemangat?</div>
                    </div>
                </div>
                <div style="display: flex; gap: 8px; flex-shrink: 0;">
                    <button style="padding: 6px 12px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: var(--radius-sm); font-size: 12px; font-weight: 700;">EDIT SOAL</button>
                    <button style="padding: 6px 12px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: var(--radius-sm); font-size: 12px; font-weight: 700;">HAPUS</button>
                </div>
            </div>
        </div>

         <!-- Question 3 -->
         <div style="border: 1.5px solid var(--c-border); border-radius: var(--radius-md); padding: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div style="display: flex; gap: 16px;">
                    <div style="font-weight: 800; font-size: 16px; color: var(--c-text-heading); padding: 4px 10px; background: var(--c-bg); border: 1px solid var(--c-border); border-radius: var(--radius-sm);">#3</div>
                    <div>
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                            <span style="font-weight: 700; font-size: 11px; padding: 2px 8px; border: 1px solid var(--c-text-heading); border-radius: 4px; text-transform: uppercase;">POTENSI</span>
                            <span style="font-size: 13px; color: var(--c-text-muted);">5 Pilihan Jawaban</span>
                        </div>
                        <div style="font-weight: 700; font-size: 15px; color: var(--c-text-heading);">Sejauh mana potensimu dalam mengoperasikan alat digital dan memecahkan teka-teki logika?</div>
                    </div>
                </div>
                <div style="display: flex; gap: 8px; flex-shrink: 0;">
                    <button style="padding: 6px 12px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: var(--radius-sm); font-size: 12px; font-weight: 700;">EDIT SOAL</button>
                    <button style="padding: 6px 12px; border: 1px solid var(--c-border); background: var(--c-white); border-radius: var(--radius-sm); font-size: 12px; font-weight: 700;">HAPUS</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
