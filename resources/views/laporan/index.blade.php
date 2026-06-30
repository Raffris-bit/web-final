@extends('layouts.app')
@section('title', 'Laporan Transaksi')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1><i class="bi bi-bar-chart me-2"></i>Laporan Transaksi</h1>
        <p class="page-subtitle">Ringkasan data transaksi perpustakaan</p>
    </div>
</div>

{{-- Summary Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card card">
            <div class="card-body text-center">
                <div class="stat-value text-primary">{{ $summary['total'] }}</div>
                <div class="stat-label">Total Transaksi</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card card">
            <div class="card-body text-center">
                <div class="stat-value text-warning">{{ $summary['dipinjam'] }}</div>
                <div class="stat-label">Dipinjam</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card card">
            <div class="card-body text-center">
                <div class="stat-value text-success">{{ $summary['dikembalikan'] }}</div>
                <div class="stat-label">Dikembalikan</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card card">
            <div class="card-body text-center">
                <div class="stat-value text-danger">Rp {{ number_format($summary['total_denda'], 0, ',', '.') }}</div>
                <div class="stat-label">Total Denda</div>
            </div>
        </div>
    </div>
</div>

{{-- Filter Form --}}
<div class="card-modern mb-4">
    <div class="card-header">
        <i class="bi bi-funnel me-2 text-primary"></i>Filter
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('laporan.index') }}" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Dari Tanggal</label>
                <input type="date" name="dari" class="form-control" value="{{ request('dari') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Sampai Tanggal</label>
                <input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Anggota</label>
                <select name="anggota_id" class="form-select">
                    <option value="">Semua Anggota</option>
                    @foreach($anggotas as $anggota)
                        <option value="{{ $anggota->id }}" {{ request('anggota_id') == $anggota->id ? 'selected' : '' }}>
                            {{ $anggota->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-modern">
                    <i class="bi bi-funnel"></i> Terapkan Filter
                </button>
                <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary btn-modern">
                    <i class="bi bi-x-circle"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Tabel --}}
<div class="card-modern">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table-modern table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Tgl Dikembalikan</th>
                        <th>Status</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $trx)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
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
                        <td class="small">{{ $trx->tanggal_pinjam->format('d/m/Y') }}</td>
                        <td class="small">{{ $trx->tanggal_kembali->format('d/m/Y') }}</td>
                        <td class="small">
                            @if($trx->tanggal_dikembalikan)
                                {{ $trx->tanggal_dikembalikan->format('d/m/Y') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($trx->status === 'Dipinjam')
                                <span class="badge bg-warning text-dark badge-modern">Dipinjam</span>
                            @else
                                <span class="badge bg-success badge-modern">Dikembalikan</span>
                            @endif
                        </td>
                        <td>
                            @if($trx->denda)
                                <span class="text-danger fw-semibold">Rp {{ number_format($trx->denda, 0, ',', '.') }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="bi bi-inbox"></i></div>
                                <h5>Tidak ada data transaksi</h5>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
@media print {
    .card-modern .card-body form, .btn-modern, nav, footer { display: none !important; }
    .card-modern { border: none !important; box-shadow: none !important; }
}
</style>
@endpush
