@extends('Admin.layout.app')

@section('content')
@php
    $pageTitle = 'Beranda';
    $active = 'beranda';
@endphp

<!-- Spesifikasi: 4 Card Metrics (Siswa, Psikolog, Prodi, Soal) -->
<div class="summary-grid" style="margin-bottom: 24px;">
    <!-- Card Total Siswa -->
    <div class="card-summary">
        <div class="summary-header">
            <h3 class="summary-title" style="text-transform: uppercase;">Total Siswa</h3>
            <div class="summary-icon-mini">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
        </div>
        <div>
            <div class="dash-value" style="font-size: 32px; color: var(--c-text-heading);">3</div>
            <p class="dash-hint">Siswa SMA/SMK terdaftar</p>
        </div>
    </div>

    <!-- Card Total Psikolog -->
    <div class="card-summary">
        <div class="summary-header">
            <h3 class="summary-title" style="text-transform: uppercase;">Total Psikolog</h3>
            <div class="summary-icon-mini">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>
        </div>
        <div>
            <div class="dash-value" style="font-size: 32px; color: var(--c-text-heading);">2</div>
            <p class="dash-hint">Psikolog konselor aktif</p>
        </div>
    </div>

    <!-- Card Total Prodi -->
    <div class="card-summary">
        <div class="summary-header">
            <h3 class="summary-title" style="text-transform: uppercase;">Total Prodi</h3>
            <div class="summary-icon-mini">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    <line x1="8" y1="6" x2="16" y2="6"></line>
                    <line x1="8" y1="10" x2="16" y2="10"></line>
                </svg>
            </div>
        </div>
        <div>
            <div class="dash-value" style="font-size: 32px; color: var(--c-text-heading);">5</div>
            <p class="dash-hint">Program studi rekomendasi</p>
        </div>
    </div>

    <!-- Card Total Soal Asesmen -->
    <div class="card-summary">
        <div class="summary-header">
            <h3 class="summary-title" style="text-transform: uppercase;">Total Soal Asesmen</h3>
            <div class="summary-icon-mini">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
            </div>
        </div>
        <div>
            <div class="dash-value" style="font-size: 32px; color: var(--c-text-heading);">3</div>
            <p class="dash-hint">Minat, Bakat, & Potensi</p>
        </div>
    </div>
</div>

<div class="dashboard-lower-grid" style="grid-template-columns: 2fr 1fr;">
    <!-- Aktivitas Asesmen & Konsultasi (Grafik placeholder) -->
    <div class="steps-card-container" style="display:flex; flex-direction: column; justify-content: space-between;">
        <div class="section-title-wrap" style="margin-bottom: 12px; border-bottom: 1px solid var(--c-border); padding-bottom: 12px;">
            <h2 class="section-title" style="font-size: 16px; text-transform: uppercase;">Aktivitas Asesmen & Konsultasi</h2>
            <span style="font-size: 13px; color: var(--c-text-muted);">Grafik Bulanan</span>
        </div>
        <div style="flex:1; width: 100%; min-height: 300px; position: relative;">
            <div id="chart-asesmen"></div>
        </div>
    </div>

    <!-- Right Column: Pintasan Navigasi & Log Sistem -->
    <div style="display: flex; flex-direction: column; gap: 24px;">
        <div class="steps-card-container">
            <div class="section-title-wrap" style="margin-bottom: 16px; border-bottom: 1px solid var(--c-border); padding-bottom: 12px;">
                <h2 class="section-title" style="font-size: 16px; text-transform: uppercase;">Pintasan Navigasi</h2>
            </div>
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <a href="{{ route('admin.pengguna') }}" style="display: flex; justify-content: space-between; padding: 12px; border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-weight: bold; color: var(--c-text-heading); align-items: center;">
                    <span>— KELOLA AKUN PENGGUNA</span>
                    <span style="font-size: 13px; color: var(--c-text-muted);">5 AKUN</span>
                </a>
                <a href="{{ route('admin.prodi') }}" style="display: flex; justify-content: space-between; padding: 12px; border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-weight: bold; color: var(--c-text-heading); align-items: center;">
                    <span>— KELOLA PROGRAM STUDI</span>
                    <span style="font-size: 13px; color: var(--c-text-muted);">5 PRODI</span>
                </a>
                <a href="{{ route('admin.asesmen') }}" style="display: flex; justify-content: space-between; padding: 12px; border: 1px solid var(--c-border); border-radius: var(--radius-sm); font-weight: bold; color: var(--c-text-heading); align-items: center;">
                    <span>— KELOLA SOAL ASESMEN</span>
                    <span style="font-size: 13px; color: var(--c-text-muted);">3 SOAL</span>
                </a>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var options = {
            series: [{
                name: 'Asesmen Diselesaikan',
                data: [12, 19, 23, 28, 35, 42, 50]
            }, {
                name: 'Konsultasi Selesai',
                data: [5, 8, 12, 15, 20, 24, 30]
            }],
            chart: {
                height: 300,
                type: 'area',
                fontFamily: 'Plus Jakarta Sans, sans-serif',
                toolbar: { show: false }
            },
            colors: ['#30618C', '#F2B705'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 2 },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
            },
            tooltip: {
                theme: 'light'
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-asesmen"), options);
        chart.render();
    });
</script>
@endpush
