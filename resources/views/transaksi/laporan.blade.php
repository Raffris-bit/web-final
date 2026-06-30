@extends('layouts.app')

@section('title', 'Laporan Transaksi')

@section('content')
<div class="page-header d-flex flex-wrap justify-content-between align-items-center">
    <div>
        <h1><i class="bi bi-file-earmark-bar-graph me-2"></i>Laporan Transaksi</h1>
        <p class="page-subtitle">Filter dan lihat laporan transaksi peminjaman</p>
    </div>
    <div class="d-flex gap-2 mt-2 mt-md-0">
        <a href="{{ route('transaksi.laporan.pdf', request()->query()) }}"
           class="btn btn-danger btn-modern" target="_blank">
            <i class="bi bi-file-earmark-pdf"></i> Export PDF
        </a>
    </div>
</div>

{{-- Filter Form --}}
<div class="card-modern mb-4">
    <div class="card-header">
        <i class="bi bi-funnel me-2 text-primary"></i>Filter Laporan
    </div>
    <div class="card-body">
        <form action="{{ route('transaksi.laporan') }}" method="GET" class="row g-3">
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
                <a href="{{ route('transaksi.laporan') }}" class="btn btn-outline-secondary btn-modern">
                    <i class="bi bi-x-circle"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Summary --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card card">
            <div class="card-body text-center">
                <div class="stat-value text-primary">{{ $transaksis->count() }}</div>
                <div class="stat-label">Total Transaksi</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card card">
            <div class="card-body text-center">
                <div class="stat-value text-warning">{{ $transaksis->where('status', 'Dipinjam')->count() }}</div>
                <div class="stat-label">Dipinjam</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card card">
            <div class="card-body text-center">
                <div class="stat-value text-success">{{ $transaksis->where('status', 'Dikembalikan')->count() }}</div>
                <div class="stat-label">Dikembalikan</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card card">
            <div class="card-body text-center">
                <div class="stat-value text-danger">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
                <div class="stat-label">Total Denda</div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Laporan --}}
<div class="card-modern">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-table me-2 text-primary"></i>Data Transaksi</span>
        <a href="{{ route('transaksi.laporan.pdf', request()->query()) }}"
           class="btn btn-sm btn-danger btn-modern" target="_blank">
            <i class="bi bi-file-earmark-pdf"></i> Export PDF
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table-modern table" id="laporanTable">
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
                    @forelse($transaksis as $transaksi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $transaksi->kode_transaksi }}</code></td>
                        <td>
                            <a href="{{ route('anggota.show', $transaksi->anggota_id) }}" class="text-decoration-none">
                                {{ $transaksi->anggota->nama }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('buku.show', $transaksi->buku_id) }}" class="text-decoration-none">
                                {{ Str::limit($transaksi->buku->judul, 30) }}
                            </a>
                        </td>
                        <td class="small">{{ $transaksi->tanggal_pinjam->format('d/m/Y') }}</td>
                        <td class="small">{{ $transaksi->tanggal_kembali->format('d/m/Y') }}</td>
                        <td class="small">
                            @if($transaksi->tanggal_dikembalikan)
                                {{ $transaksi->tanggal_dikembalikan->format('d/m/Y') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($transaksi->status == 'Dipinjam')
                                <span class="badge bg-warning text-dark badge-modern">Dipinjam</span>
                            @else
                                <span class="badge bg-success badge-modern">Dikembalikan</span>
                            @endif
                        </td>
                        <td>
                            @if($transaksi->denda > 0)
                                <span class="text-danger fw-semibold">Rp {{ number_format($transaksi->denda, 0, ',', '.') }}</span>
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
                                <h5>Tidak ada transaksi ditemukan</h5>
                                <p class="mb-0">Coba ubah filter atau rentang tanggal.</p>
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
