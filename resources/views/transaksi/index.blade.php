@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
<div class="page-header d-flex flex-wrap justify-content-between align-items-center">
    <div>
        <h1><i class="bi bi-arrow-left-right me-2"></i>Daftar Transaksi</h1>
        <p class="page-subtitle">Kelola peminjaman dan pengembalian buku</p>
    </div>
    <div class="d-flex gap-2 mt-2 mt-md-0">
        <a href="{{ route('transaksi.laporan') }}" class="btn btn-outline-primary btn-modern">
            <i class="bi bi-file-earmark-bar-graph"></i> Laporan
        </a>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-modern">
            <i class="bi bi-plus-circle"></i> Pinjam Buku
        </a>
    </div>
</div>

{{-- Statistik --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon flex-shrink-0" style="background: linear-gradient(135deg, #6366F1, #4F46E5); color:#fff;">
                    <i class="bi bi-receipt"></i>
                </div>
                <div>
                    <div class="stat-label">Total Transaksi</div>
                    <div class="stat-value">{{ $transaksis->count() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon flex-shrink-0" style="background: linear-gradient(135deg, #F59E0B, #D97706); color:#fff;">
                    <i class="bi bi-journal-arrow-up"></i>
                </div>
                <div>
                    <div class="stat-label">Sedang Dipinjam</div>
                    <div class="stat-value">{{ $transaksis->where('status', 'Dipinjam')->count() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon flex-shrink-0" style="background: linear-gradient(135deg, #10B981, #059669); color:#fff;">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <div class="stat-label">Sudah Dikembalikan</div>
                    <div class="stat-value">{{ $transaksis->where('status', 'Dikembalikan')->count() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Transaksi --}}
<div class="card-modern">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table-modern table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th style="width:80px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $transaksi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $transaksi->kode_transaksi }}</code></td>
                        <td>
                            <a href="{{ route('anggota.show', $transaksi->anggota_id) }}" class="fw-semibold text-decoration-none">
                                {{ $transaksi->anggota->nama }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('buku.show', $transaksi->buku_id) }}" class="text-decoration-none">
                                {{ Str::limit($transaksi->buku->judul, 35) }}
                            </a>
                        </td>
                        <td class="small">{{ $transaksi->tanggal_pinjam->format('d M Y') }}</td>
                        <td class="small">
                            {{ $transaksi->tanggal_kembali->format('d M Y') }}
                        </td>
                        <td>
                            @if($transaksi->status == 'Dipinjam')
                                @if($transaksi->terlambat > 0)
                                    <span class="badge bg-danger badge-modern">
                                        <i class="bi bi-exclamation-circle"></i> Terlambat {{ $transaksi->terlambat }} hari
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark badge-modern">Dipinjam</span>
                                @endif
                            @else
                                <span class="badge bg-success badge-modern">Dikembalikan</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('transaksi.show', $transaksi->id) }}"
                               class="btn btn-sm btn-primary btn-modern">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="bi bi-receipt"></i></div>
                                <h5>Belum ada transaksi</h5>
                                <p class="mb-0">Belum ada transaksi peminjaman buku.</p>
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
