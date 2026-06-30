@extends('layouts.app')

@section('title', $buku->judul)

@section('content')
<div class="page-header d-flex flex-wrap justify-content-between align-items-center">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('buku.index') }}">Buku</a></li>
                <li class="breadcrumb-item active">{{ $buku->judul }}</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning btn-modern">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary btn-modern">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row g-4">
    {{-- Kolom Kiri: Info Buku --}}
    <div class="col-lg-8">
        <div class="card-modern">
            <div class="card-header">
                <i class="bi bi-info-circle me-2 text-primary"></i>Informasi Buku
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <table class="table table-borderless mb-0" style="font-size:0.9rem;">
                            <tr>
                                <td class="text-muted" style="width:120px;">Kode Buku</td>
                                <td class="fw-semibold"><code>{{ $buku->kode_buku }}</code></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Judul</td>
                                <td class="fw-semibold">{{ $buku->judul }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Pengarang</td>
                                <td class="fw-semibold">{{ $buku->pengarang }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Penerbit</td>
                                <td>{{ $buku->penerbit }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Kategori</td>
                                <td>
                                    <span class="badge bg-primary-50 text-primary badge-modern">
                                        {{ $buku->kategori }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless mb-0" style="font-size:0.9rem;">
                            <tr>
                                <td class="text-muted" style="width:120px;">ISBN</td>
                                <td class="fw-semibold">{{ $buku->isbn ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tahun Terbit</td>
                                <td class="fw-semibold">{{ $buku->tahun_terbit }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Bahasa</td>
                                <td>{{ $buku->bahasa }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Harga</td>
                                <td class="fw-semibold">Rp {{ number_format($buku->harga, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Stok</td>
                                <td>
                                    @if($buku->stok > 5)
                                        <span class="badge bg-success badge-modern">{{ $buku->stok }} tersedia</span>
                                    @elseif($buku->stok > 0)
                                        <span class="badge bg-warning text-dark badge-modern">Sisa {{ $buku->stok }}</span>
                                    @else
                                        <span class="badge bg-danger badge-modern">Stok Habis</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($buku->deskripsi)
                <hr>
                <div>
                    <h6 class="fw-semibold mb-2">Deskripsi</h6>
                    <p class="text-muted mb-0" style="font-size:0.9rem; line-height:1.7;">{{ $buku->deskripsi }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Riwayat Transaksi Buku Ini --}}
        @php
            $riwayatBuku = $buku->transaksis()->with('anggota')->latest()->take(10)->get();
        @endphp
        @if($riwayatBuku->count() > 0)
        <div class="card-modern mt-4">
            <div class="card-header">
                <i class="bi bi-clock-history me-2 text-primary"></i>Riwayat Peminjaman
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table-modern table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Anggota</th>
                                <th>Tgl Pinjam</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayatBuku as $trx)
                            <tr>
                                <td><code>{{ $trx->kode_transaksi }}</code></td>
                                <td>
                                    <a href="{{ route('anggota.show', $trx->anggota_id) }}" class="text-decoration-none">
                                        {{ $trx->anggota->nama }}
                                    </a>
                                </td>
                                <td class="text-muted">{{ $trx->tanggal_pinjam->format('d M Y') }}</td>
                                <td>
                                    @if($trx->status == 'Dipinjam')
                                        <span class="badge bg-warning text-dark badge-modern">Dipinjam</span>
                                    @else
                                        <span class="badge bg-success badge-modern">Dikembalikan</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- Kolom Kanan: Info Ringkas --}}
    <div class="col-lg-4">
        <div class="card-modern mb-4">
            <div class="card-body text-center py-4">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
                     style="width:80px;height:80px;background:var(--primary-50);color:var(--primary);">
                    <i class="bi bi-book fs-1"></i>
                </div>
                <h5 class="fw-bold mb-1">{{ $buku->judul }}</h5>
                <p class="text-muted mb-3">{{ $buku->pengarang }}</p>

                @if($buku->stok > 0)
                    <a href="{{ route('transaksi.create') }}?buku_id={{ $buku->id }}"
                       class="btn btn-primary btn-modern w-100">
                        <i class="bi bi-plus-circle"></i> Pinjam Buku Ini
                    </a>
                @else
                    <button class="btn btn-secondary btn-modern w-100" disabled>
                        <i class="bi bi-x-circle"></i> Stok Habis
                    </button>
                @endif
            </div>
        </div>

        {{-- Info Metadata --}}
        <div class="card-modern">
            <div class="card-header">
                <i class="bi bi-clock me-2 text-muted"></i>Metadata
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0" style="font-size:0.85rem;">
                    <tr>
                        <td class="text-muted p-1">Ditambahkan</td>
                        <td class="p-1 text-end">{{ $buku->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted p-1">Diupdate</td>
                        <td class="p-1 text-end">{{ $buku->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Buku Serupa --}}
        @php
            $bukuSerupa = \App\Models\Buku::where('kategori', $buku->kategori)
                                          ->where('id', '!=', $buku->id)
                                          ->latest()
                                          ->take(5)
                                          ->get();
        @endphp
        @if($bukuSerupa->count() > 0)
        <div class="card-modern mt-4">
            <div class="card-header">
                <i class="bi bi-collection me-2 text-muted"></i>Buku Serupa
            </div>
            <div class="card-body">
                @foreach($bukuSerupa as $item)
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="d-flex align-items-center justify-content-center rounded"
                             style="width:36px;height:36px;background:var(--primary-50);flex-shrink:0;">
                            <i class="bi bi-book text-primary" style="font-size:0.85rem;"></i>
                        </div>
                        <div class="min-width-0">
                            <a href="{{ route('buku.show', $item->id) }}" class="fw-semibold text-decoration-none small">
                                {{ Str::limit($item->judul, 35) }}
                            </a>
                            <div class="text-muted" style="font-size:0.75rem;">{{ $item->pengarang }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
