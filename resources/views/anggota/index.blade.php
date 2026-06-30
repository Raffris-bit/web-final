@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')
<div class="page-header d-flex flex-wrap justify-content-between align-items-center">
    <div>
        <h1><i class="bi bi-people me-2"></i>Daftar Anggota</h1>
        <p class="page-subtitle">Kelola data anggota perpustakaan</p>
    </div>
    <div class="d-flex gap-2 mt-2 mt-md-0">
        <a href="{{ route('anggota.export') }}" class="btn btn-success btn-modern">
            <i class="bi bi-file-excel"></i> Export Excel
        </a>
        <a href="{{ route('anggota.create') }}" class="btn btn-primary btn-modern">
            <i class="bi bi-plus-circle"></i> Tambah Anggota
        </a>
    </div>
</div>

{{-- Statistik --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon flex-shrink-0" style="background: linear-gradient(135deg, #6366F1, #4F46E5); color:#fff;">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <div class="stat-label">Total Anggota</div>
                    <div class="stat-value">{{ $totalAnggota }}</div>
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
                    <div class="stat-label">Aktif</div>
                    <div class="stat-value">{{ $anggotaAktif }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon flex-shrink-0" style="background: linear-gradient(135deg, #EF4444, #DC2626); color:#fff;">
                    <i class="bi bi-x-circle"></i>
                </div>
                <div>
                    <div class="stat-label">Nonaktif</div>
                    <div class="stat-value">{{ $anggotaNonaktif }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Search --}}
<div class="card-modern mb-4">
    <div class="card-body">
        <form action="{{ route('anggota.index') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label">Cari Anggota</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control"
                           placeholder="Nama, email, atau telepon..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Nonaktif" {{ request('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-modern flex-grow-1">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                @if(request()->anyFilled(['search', 'status']))
                    <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary btn-modern">
                        <i class="bi bi-x-circle"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

{{-- Tabel Anggota --}}
<div class="card-modern">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table-modern table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Jenis Kelamin</th>
                        <th>Status</th>
                        <th style="width:130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anggotas as $anggota)
                    <tr>
                        <td><code>{{ $anggota->kode_anggota }}</code></td>
                        <td>
                            <a href="{{ route('anggota.show', $anggota->id) }}" class="fw-semibold text-decoration-none">
                                {{ $anggota->nama }}
                            </a>
                        </td>
                        <td>
                            <span class="text-muted small">{{ $anggota->email }}</span>
                        </td>
                        <td>{{ $anggota->telepon }}</td>
                        <td>
                            <span class="badge bg-primary-50 text-primary badge-modern">
                                {{ $anggota->jenis_kelamin }}
                            </span>
                        </td>
                        <td>
                            @if($anggota->status == 'Aktif')
                                <span class="badge bg-success badge-modern">
                                    <i class="bi bi-check-circle"></i> Aktif
                                </span>
                            @else
                                <span class="badge bg-secondary badge-modern">
                                    <i class="bi bi-x-circle"></i> Nonaktif
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('anggota.show', $anggota->id) }}"
                                   class="btn btn-sm btn-primary btn-modern" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('anggota.edit', $anggota->id) }}"
                                   class="btn btn-sm btn-warning btn-modern" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus {{ $anggota->nama }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-modern" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="bi bi-people"></i></div>
                                <h5>Tidak ada data anggota</h5>
                                <p class="mb-0">
                                    @if(request()->anyFilled(['search', 'status']))
                                        Tidak ditemukan anggota dengan filter yang dipilih.
                                    @else
                                        Belum ada anggota yang ditambahkan.
                                    @endif
                                </p>
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
