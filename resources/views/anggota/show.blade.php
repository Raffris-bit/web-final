@extends('layouts.app')

@section('title', $anggota->nama)

@section('content')
<div class="page-header d-flex flex-wrap justify-content-between align-items-center">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('anggota.index') }}">Anggota</a></li>
                <li class="breadcrumb-item active">{{ $anggota->nama }}</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn btn-warning btn-modern">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary btn-modern">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row g-4">
    {{-- Kolom Kiri: Detail Anggota --}}
    <div class="col-lg-8">
        <div class="card-modern">
            <div class="card-header">
                <i class="bi bi-person me-2 text-success"></i>Data Diri Anggota
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <table class="table table-borderless mb-0" style="font-size:0.9rem;">
                            <tr>
                                <td class="text-muted" style="width:130px;">Kode</td>
                                <td class="fw-semibold"><code>{{ $anggota->kode_anggota }}</code></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Nama</td>
                                <td class="fw-semibold">{{ $anggota->nama }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Email</td>
                                <td>{{ $anggota->email }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Telepon</td>
                                <td>{{ $anggota->telepon }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Jenis Kelamin</td>
                                <td>{{ $anggota->jenis_kelamin }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless mb-0" style="font-size:0.9rem;">
                            <tr>
                                <td class="text-muted" style="width:130px;">Tgl Lahir</td>
                                <td>{{ $anggota->tanggal_lahir ? $anggota->tanggal_lahir->format('d M Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Pekerjaan</td>
                                <td>{{ $anggota->pekerjaan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tgl Daftar</td>
                                <td>{{ $anggota->tanggal_daftar->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Status</td>
                                <td>
                                    @if($anggota->status == 'Aktif')
                                        <span class="badge bg-success badge-modern">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary badge-modern">Nonaktif</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($anggota->alamat)
                <hr>
                <div>
                    <h6 class="fw-semibold mb-2">Alamat</h6>
                    <p class="text-muted mb-0" style="font-size:0.9rem;">{{ $anggota->alamat }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Ringkasan --}}
    <div class="col-lg-4">
        <div class="card-modern mb-4">
            <div class="card-body text-center py-4">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
                     style="width:80px;height:80px;background:var(--primary-50);color:var(--primary);">
                    <i class="bi bi-person fs-1"></i>
                </div>
                <h5 class="fw-bold mb-1">{{ $anggota->nama }}</h5>
                <p class="text-muted small mb-2">{{ $anggota->kode_anggota }}</p>
                @if($anggota->status == 'Aktif')
                    <span class="badge bg-success badge-modern px-3 py-2">Aktif</span>
                @else
                    <span class="badge bg-secondary badge-modern px-3 py-2">Nonaktif</span>
                @endif

                <hr>

                <div class="d-flex justify-content-around">
                    <div>
                        <div class="fw-bold fs-4 text-primary">{{ $totalPinjam }}</div>
                        <div class="small text-muted">Total Pinjam</div>
                    </div>
                    <div>
                        <div class="fw-bold fs-4 text-warning">{{ $sedangDipinjam }}</div>
                        <div class="small text-muted">Dipinjam</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-modern">
            <div class="card-header">
                <i class="bi bi-clock me-2 text-muted"></i>Info Pendaftaran
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0" style="font-size:0.85rem;">
                    <tr>
                        <td class="text-muted p-1">Tanggal Daftar</td>
                        <td class="p-1 text-end">{{ $anggota->tanggal_daftar->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted p-1">Ditambahkan</td>
                        <td class="p-1 text-end">{{ $anggota->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted p-1">Diupdate</td>
                        <td class="p-1 text-end">{{ $anggota->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Riwayat Peminjaman --}}
<div class="row mt-4">
    <div class="col-12">
        <div class="card-modern">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                <span>
                    <i class="bi bi-clock-history me-2 text-primary"></i>Riwayat Peminjaman
                </span>
                <span class="badge bg-primary-50 text-primary badge-modern">
                    {{ $totalPinjam }} transaksi
                </span>
            </div>
            <div class="card-body">
                {{-- Statistik Peminjaman --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-3 col-6">
                        <div class="stat-card card">
                            <div class="card-body text-center py-3">
                                <div class="stat-value text-primary">{{ $totalPinjam }}</div>
                                <div class="stat-label">Total Pinjam</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card card">
                            <div class="card-body text-center py-3">
                                <div class="stat-value text-warning">{{ $sedangDipinjam }}</div>
                                <div class="stat-label">Sedang Dipinjam</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card card">
                            <div class="card-body text-center py-3">
                                <div class="stat-value text-success">{{ $sudahDikembalikan }}</div>
                                <div class="stat-label">Dikembalikan</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card card">
                            <div class="card-body text-center py-3">
                                <div class="stat-value text-danger">
                                    Rp {{ number_format($totalDenda, 0, ',', '.') }}
                                </div>
                                <div class="stat-label">Total Denda</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Filter Status --}}
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <form action="{{ route('anggota.show', $anggota->id) }}" method="GET" class="d-flex align-items-center gap-2">
                        <label for="status" class="form-label mb-0 text-nowrap">
                            <i class="bi bi-funnel"></i> Filter:
                        </label>
                        <select name="status" id="status" class="form-select form-select-sm"
                                style="width:auto;" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        </select>
                    </form>
                    @if(request('status'))
                        <a href="{{ route('anggota.show', $anggota->id) }}" class="btn btn-sm btn-outline-secondary btn-modern">
                            <i class="bi bi-x-circle"></i> Reset Filter
                        </a>
                    @endif
                </div>

                {{-- Tabel Riwayat --}}
                <div class="table-responsive">
                    <table class="table-modern table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Batas Kembali</th>
                                <th>Tgl Dikembalikan</th>
                                <th>Status</th>
                                <th>Denda</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayatTransaksi as $transaksi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><code>{{ $transaksi->kode_transaksi }}</code></td>
                                <td>
                                    <a href="{{ route('buku.show', $transaksi->buku_id) }}" class="text-decoration-none">
                                        {{ $transaksi->buku->judul }}
                                    </a>
                                </td>
                                <td class="small">{{ $transaksi->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td>
                                    <span class="small">{{ $transaksi->tanggal_kembali->format('d/m/Y') }}</span>
                                    @if($transaksi->terlambat > 0)
                                        <span class="badge bg-danger badge-modern ms-1" style="font-size:.65rem;">
                                            -{{ $transaksi->terlambat }} hr
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($transaksi->status == 'Dikembalikan')
                                        <span class="small">{{ $transaksi->tanggal_dikembalikan->format('d/m/Y') }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($transaksi->status == 'Dipinjam')
                                        @if($transaksi->terlambat > 0)
                                            <span class="badge bg-danger badge-modern">Terlambat</span>
                                        @else
                                            <span class="badge bg-warning text-dark badge-modern">Dipinjam</span>
                                        @endif
                                    @else
                                        @if($transaksi->terlambat > 0)
                                            <span class="badge bg-success badge-modern">Terlambat {{ $transaksi->terlambat }} hr</span>
                                        @else
                                            <span class="badge bg-success badge-modern">Tepat Waktu</span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if($transaksi->denda > 0)
                                        <span class="text-danger fw-semibold small">
                                            Rp {{ number_format($transaksi->denda, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
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
                                <td colspan="9">
                                    <div class="empty-state">
                                        <div class="empty-icon"><i class="bi bi-inbox"></i></div>
                                        <h5>
                                            @if(request('status'))
                                                Tidak ada transaksi dengan status "{{ request('status') }}"
                                            @else
                                                Belum ada riwayat peminjaman
                                            @endif
                                        </h5>
                                    </div>
                                </td>
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
