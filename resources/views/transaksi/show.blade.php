@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="page-header d-flex flex-wrap justify-content-between align-items-center">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Transaksi</a></li>
                <li class="breadcrumb-item active">{{ $transaksi->kode_transaksi }}</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary btn-modern">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

{{-- Alert Terlambat --}}
@if($transaksi->status == 'Dipinjam' && $transaksi->terlambat > 0)
<div class="alert alert-danger alert-modern d-flex align-items-start gap-3 mb-4" role="alert">
    <i class="bi bi-exclamation-triangle-fill fs-3 mt-1"></i>
    <div>
        <h5 class="alert-heading mb-1">⚠️ Buku Terlambat Dikembalikan!</h5>
        <p class="mb-1">
            Buku ini sudah melewati batas tanggal pengembalian
            <strong>{{ $transaksi->tanggal_kembali->format('d M Y') }}</strong>.
        </p>
        <p class="mb-0">
            Keterlambatan: <strong class="text-danger">{{ $transaksi->terlambat }} hari</strong> —
            Denda: <strong class="text-danger">Rp {{ number_format($transaksi->terlambat * 5000, 0, ',', '.') }}</strong>
        </p>
    </div>
</div>
@endif

<div class="row g-4">
    {{-- Kolom Kiri --}}
    <div class="col-lg-8">
        <div class="card-modern">
            <div class="card-header">
                <i class="bi bi-info-circle me-2 text-primary"></i>Informasi Transaksi
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <table class="table table-borderless mb-0" style="font-size:0.9rem;">
                            <tr>
                                <td class="text-muted" style="width:140px;">Kode Transaksi</td>
                                <td class="fw-semibold"><code>{{ $transaksi->kode_transaksi }}</code></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tanggal Pinjam</td>
                                <td>{{ $transaksi->tanggal_pinjam->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Batas Kembali</td>
                                <td>
                                    <span class="fw-semibold {{ $transaksi->terlambat > 0 && $transaksi->status == 'Dipinjam' ? 'text-danger' : '' }}">
                                        {{ $transaksi->tanggal_kembali->format('d M Y') }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tanggal Dikembalikan</td>
                                <td>
                                    @if($transaksi->status == 'Dikembalikan')
                                        {{ $transaksi->tanggal_dikembalikan->format('d M Y H:i') }}
                                    @else
                                        <span class="text-muted fst-italic">Belum dikembalikan</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless mb-0" style="font-size:0.9rem;">
                            <tr>
                                <td class="text-muted" style="width:140px;">Status</td>
                                <td>
                                    @if($transaksi->status == 'Dipinjam')
                                        @if($transaksi->terlambat > 0)
                                            <span class="badge bg-danger badge-modern px-3">Terlambat {{ $transaksi->terlambat }} hari</span>
                                        @else
                                            <span class="badge bg-warning text-dark badge-modern px-3">Dipinjam</span>
                                        @endif
                                    @else
                                        <span class="badge bg-success badge-modern px-3">Dikembalikan</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Denda</td>
                                <td>
                                    @if($transaksi->denda > 0)
                                        <span class="text-danger fw-bold">Rp {{ number_format($transaksi->denda, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Durasi</td>
                                <td>{{ $transaksi->durasi_peminjaman }} hari</td>
                            </tr>
                            @if($transaksi->keterangan)
                            <tr>
                                <td class="text-muted">Keterangan</td>
                                <td>{{ $transaksi->keterangan }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Info Anggota --}}
        <div class="card-modern mt-4">
            <div class="card-header">
                <i class="bi bi-person me-2 text-success"></i>Data Anggota
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle"
                         style="width:56px;height:56px;background:var(--primary-50);color:var(--primary);flex-shrink:0;">
                        <i class="bi bi-person fs-3"></i>
                    </div>
                    <div>
                        <a href="{{ route('anggota.show', $transaksi->anggota_id) }}" class="fw-bold text-decoration-none fs-5">
                            {{ $transaksi->anggota->nama }}
                        </a>
                        <div class="text-muted small">
                            {{ $transaksi->anggota->kode_anggota }} &middot;
                            {{ $transaksi->anggota->email }} &middot;
                            {{ $transaksi->anggota->telepon }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan --}}
    <div class="col-lg-4">
        {{-- Info Buku --}}
        <div class="card-modern">
            <div class="card-header">
                <i class="bi bi-book me-2 text-primary"></i>Data Buku
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="d-flex align-items-center justify-content-center rounded"
                         style="width:48px;height:48px;background:var(--primary-50);color:var(--primary);flex-shrink:0;">
                        <i class="bi bi-book fs-4"></i>
                    </div>
                    <div class="min-width-0">
                        <a href="{{ route('buku.show', $transaksi->buku_id) }}" class="fw-semibold text-decoration-none">
                            {{ $transaksi->buku->judul }}
                        </a>
                        <div class="text-muted small">{{ $transaksi->buku->pengarang }}</div>
                    </div>
                </div>
                <hr>
                <table class="table table-borderless mb-0" style="font-size:0.85rem;">
                    <tr>
                        <td class="text-muted p-1">Kode Buku</td>
                        <td class="p-1 text-end"><code>{{ $transaksi->buku->kode_buku }}</code></td>
                    </tr>
                    <tr>
                        <td class="text-muted p-1">Kategori</td>
                        <td class="p-1 text-end">{{ $transaksi->buku->kategori }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted p-1">Penerbit</td>
                        <td class="p-1 text-end">{{ $transaksi->buku->penerbit }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted p-1">Stok Tersisa</td>
                        <td class="p-1 text-end">
                            @if($transaksi->buku->stok > 0)
                                <span class="badge bg-success badge-modern">{{ $transaksi->buku->stok }}</span>
                            @else
                                <span class="badge bg-danger badge-modern">Habis</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Aksi --}}
        @if($transaksi->status == 'Dipinjam')
        <div class="card-modern mt-4">
            <div class="card-header">
                <i class="bi bi-gear me-2 text-muted"></i>Aksi
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-success btn-modern w-100 btn-lg" onclick="confirmReturn()">
                    <i class="bi bi-check-circle"></i> Proses Pengembalian
                </button>
                <p class="text-muted small text-center mt-2 mb-0">
                    <i class="bi bi-info-circle"></i>
                    Klik untuk memproses pengembalian buku ini
                </p>
            </div>
        </div>
        @endif

        {{-- Metadata --}}
        <div class="card-modern mt-4">
            <div class="card-header">
                <i class="bi bi-clock me-2 text-muted"></i>Metadata
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0" style="font-size:0.85rem;">
                    <tr>
                        <td class="text-muted p-1">Dibuat</td>
                        <td class="p-1 text-end">{{ $transaksi->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted p-1">Diupdate</td>
                        <td class="p-1 text-end">{{ $transaksi->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Form Pengembalian --}}
<form id="formKembalikan" action="{{ route('transaksi.kembalikan', $transaksi->id) }}" method="POST" style="display:none;">
    @csrf
    @method('PATCH')
</form>
@endsection

@push('scripts')
<script>
    function confirmReturn() {
        @if($transaksi->terlambat > 0)
        Swal.fire({
            title: 'Pengembalian Buku',
            html: `
                <div class="text-start">
                    <p>Apakah Anda yakin ingin memproses pengembalian buku ini?</p>
                    <div class="alert alert-warning text-start py-2 px-3 mb-0">
                        <small class="fw-semibold">
                            <i class="bi bi-exclamation-triangle"></i>
                            Keterlambatan: {{ $transaksi->terlambat }} hari<br>
                            Denda: Rp {{ number_format($transaksi->terlambat * 5000, 0, ',', '.') }}
                        </small>
                    </div>
                </div>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#10B981',
            cancelButtonColor: '#64748B',
            confirmButtonText: 'Ya, Kembalikan!',
            cancelButtonText: 'Batal'
        }).then(result => {
            if (result.isConfirmed) {
                document.getElementById('formKembalikan').submit();
            }
        });
        @else
        Swal.fire({
            title: 'Konfirmasi Pengembalian',
            text: 'Apakah Anda yakin ingin memproses pengembalian buku ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10B981',
            cancelButtonColor: '#64748B',
            confirmButtonText: 'Ya, Kembalikan!',
            cancelButtonText: 'Batal'
        }).then(result => {
            if (result.isConfirmed) {
                document.getElementById('formKembalikan').submit();
            }
        });
        @endif
    }
</script>
@endpush
