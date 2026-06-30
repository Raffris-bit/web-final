@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="page-header d-flex flex-wrap justify-content-between align-items-center">
    <div>
        <h1><i class="bi bi-speedometer2 me-2"></i>Dashboard</h1>
        <p class="page-subtitle">Overview sistem perpustakaan — {{ now()->translatedFormat('l, d F Y') }}</p>
    </div>
    <div class="d-flex gap-2 mt-2 mt-md-0">
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-modern">
            <i class="bi bi-plus-circle"></i> Pinjam Buku
        </a>
        <a href="{{ route('transaksi.laporan') }}" class="btn btn-outline-secondary btn-modern">
            <i class="bi bi-file-earmark-bar-graph"></i> Laporan
        </a>
    </div>
</div>

{{-- Statistics Cards --}}
<div class="row g-3 mb-4">
    @php
        $statCards = [
            ['Total Buku', number_format($stats['total_buku'], 0, ',', '.'), 'bi-book', 'primary', 'linear-gradient(135deg, #6366F1, #4F46E5)'],
            ['Anggota Aktif', number_format($stats['total_anggota'], 0, ',', '.'), 'bi-people', 'success', 'linear-gradient(135deg, #10B981, #059669)'],
            ['Sedang Dipinjam', $stats['sedang_dipinjam'], 'bi-journal-arrow-up', 'info', 'linear-gradient(135deg, #0EA5E9, #0284C7)'],
            ['Terlambat', $stats['terlambat'], 'bi-exclamation-triangle', 'danger', 'linear-gradient(135deg, #EF4444, #DC2626)'],
            ['Buku Tersedia', $stats['buku_tersedia'], 'bi-bookshelf', 'secondary', 'linear-gradient(135deg, #64748B, #475569)'],
            ['Total Transaksi', number_format($stats['total_transaksi'], 0, ',', '.'), 'bi-receipt', 'dark', 'linear-gradient(135deg, #1E293B, #0F172A)'],
            ['Transaksi Hari Ini', $stats['transaksi_hari_ini'], 'bi-calendar-check', 'warning', 'linear-gradient(135deg, #F59E0B, #D97706)'],
            ['Denda Bulan Ini', 'Rp ' . number_format($stats['denda_bulan_ini'], 0, ',', '.'), 'bi-cash-coin', 'danger', 'linear-gradient(135deg, #EC4899, #DB2777)'],
        ];
    @endphp
    @foreach($statCards as [$label, $value, $icon, $color, $gradient])
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="stat-card card" style="border-left: 4px solid var(--bs-{{ $color }});">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon flex-shrink-0" style="background: {{ $gradient }}; color: #fff;">
                    <i class="bi {{ $icon }}"></i>
                </div>
                <div class="min-width-0">
                    <div class="stat-label">{{ $label }}</div>
                    <div class="stat-value text-truncate">{{ $value }}</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Charts Row --}}
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card-modern">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-graph-up me-2 text-primary"></i>Transaksi 6 Bulan Terakhir</span>
                <span class="badge bg-primary-50 text-primary badge-modern">Grafik</span>
            </div>
            <div class="card-body">
                <canvas id="chartTransaksi" height="80"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-modern">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-bar-chart me-2 text-success"></i>Top 5 Buku</span>
                <span class="badge bg-success-50 text-success badge-modern">Populer</span>
            </div>
            <div class="card-body">
                <canvas id="chartBuku" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Buku Terlambat Widget --}}
@if($bukuTerlambat->count() > 0)
<div class="row mb-4">
    <div class="col-12">
        <div class="card-modern" style="border-left: 4px solid var(--danger);">
            <div class="card-header bg-danger text-white d-flex flex-wrap justify-content-between align-items-center">
                <span>
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Buku Terlambat
                </span>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-white text-danger fs-6 px-3">
                        {{ $bukuTerlambat->count() }} transaksi
                    </span>
                    <span class="badge bg-white text-danger fs-6 px-3">
                        Total denda: Rp {{ number_format($bukuTerlambat->sum(function($t) { return $t->terlambat * 5000; }), 0, ',', '.') }}
                    </span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table-modern table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Anggota</th>
                                <th>Buku</th>
                                <th>Batas Kembali</th>
                                <th>Terlambat</th>
                                <th>Denda</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bukuTerlambat as $trx)
                            <tr>
                                <td><code style="color: var(--danger);">{{ $trx->kode_transaksi }}</code></td>
                                <td>
                                    <a href="{{ route('anggota.show', $trx->anggota_id) }}" class="fw-semibold text-danger text-decoration-none">
                                        {{ $trx->anggota->nama }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('buku.show', $trx->buku_id) }}" class="text-decoration-none">
                                        {{ $trx->buku->judul }}
                                    </a>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $trx->tanggal_kembali->format('d M Y') }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-danger badge-modern">
                                        <i class="bi bi-clock-history"></i> {{ $trx->terlambat }} hari
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-danger">
                                        Rp {{ number_format($trx->terlambat * 5000, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('transaksi.show', $trx->id) }}"
                                       class="btn btn-sm btn-outline-danger btn-modern">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Bottom Row: Top Anggota + Recent Transactions --}}
<div class="row g-4 mb-4">
    {{-- Top 5 Anggota Aktif --}}
    <div class="col-lg-5">
        <div class="card-modern h-100">
            <div class="card-header">
                <i class="bi bi-trophy me-2 text-warning"></i>Anggota Teraktif
            </div>
            <div class="card-body p-0">
                @forelse($anggotaAktif as $anggota)
                <div class="d-flex align-items-center gap-3 px-4 py-3 border-bottom" style="border-color: #F1F5F9 !important;">
                    <div class="d-flex align-items-center justify-content-center rounded-circle fw-bold"
                         style="width:40px;height:40px;background:var(--primary-100);color:var(--primary);flex-shrink:0;">
                        {{ strtoupper(substr($anggota->nama, 0, 1)) }}
                    </div>
                    <div class="flex-grow-1 min-width-0">
                        <a href="{{ route('anggota.show', $anggota->id) }}" class="fw-semibold text-decoration-none text-dark">
                            {{ $anggota->nama }}
                        </a>
                        <div class="d-flex gap-2 small text-muted">
                            <span><i class="bi bi-book"></i> {{ $anggota->transaksis_count }} pinjam</span>
                            <span><i class="bi bi-tag"></i> {{ $anggota->kode_anggota }}</span>
                        </div>
                    </div>
                    <span class="badge bg-primary-50 text-primary badge-modern flex-shrink-0">
                        {{ $loop->iteration }}
                    </span>
                </div>
                @empty
                <div class="empty-state">
                    <div class="empty-icon"><i class="bi bi-people"></i></div>
                    <h5>Belum ada anggota</h5>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Recent Transactions --}}
    <div class="col-lg-7">
        <div class="card-modern h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-clock-history me-2 text-primary"></i>Transaksi Terbaru</span>
                <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-outline-primary btn-modern">
                    Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table-modern table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Anggota</th>
                                <th>Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTransaksi as $trx)
                            <tr>
                                <td><code>{{ $trx->kode_transaksi }}</code></td>
                                <td>
                                    <a href="{{ route('anggota.show', $trx->anggota_id) }}" class="text-decoration-none">
                                        {{ $trx->anggota->nama }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('buku.show', $trx->buku_id) }}" class="text-decoration-none">
                                        {{ Str::limit($trx->buku->judul, 30) }}
                                    </a>
                                </td>
                                <td class="text-muted small">{{ $trx->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td>
                                    @if($trx->status === 'Dipinjam')
                                        @if($trx->terlambat > 0)
                                            <span class="badge bg-danger badge-modern">Terlambat</span>
                                        @else
                                            <span class="badge bg-warning text-dark badge-modern">Dipinjam</span>
                                        @endif
                                    @else
                                        <span class="badge bg-success badge-modern">Dikembalikan</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada transaksi</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Line chart — Transaksi 6 bulan terakhir
new Chart(document.getElementById('chartTransaksi'), {
    type: 'line',
    data: {
        labels: @json($chartData->pluck('bulan')),
        datasets: [
            { label: 'Peminjaman', data: @json($chartData->pluck('pinjam')),
              borderColor: '#6366F1', backgroundColor: 'rgba(99,102,241,0.08)',
              tension: 0.4, fill: true, pointRadius: 4, pointHoverRadius: 6,
              borderWidth: 2.5 },
            { label: 'Pengembalian', data: @json($chartData->pluck('kembali')),
              borderColor: '#10B981', backgroundColor: 'rgba(16,185,129,0.08)',
              tension: 0.4, fill: true, pointRadius: 4, pointHoverRadius: 6,
              borderWidth: 2.5 }
        ]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'top', labels: { usePointStyle: true, padding: 20 } } },
        scales: {
            y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' } },
            x: { grid: { display: false } }
        }
    }
});

// Pie chart — Buku Populer
new Chart(document.getElementById('chartBuku'), {
    type: 'doughnut',
    data: {
        labels: @json($bukuPopuler->pluck('judul')),
        datasets: [{
            data: @json($bukuPopuler->pluck('transaksis_count')),
            backgroundColor: ['#6366F1','#10B981','#F59E0B','#EF4444','#8B5CF6'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        cutout: '65%',
        plugins: {
            legend: { position: 'bottom', labels: { padding: 12, usePointStyle: true, font: { size: 11 } } }
        }
    }
});
</script>
@endpush
