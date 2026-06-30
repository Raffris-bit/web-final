@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<div class="page-header d-flex flex-wrap justify-content-between align-items-center">
    <div>
        <h1><i class="bi bi-book me-2"></i>Daftar Buku</h1>
        <p class="page-subtitle">Kelola koleksi buku perpustakaan</p>
    </div>
    <div class="d-flex gap-2 mt-2 mt-md-0">
        <a href="{{ route('buku.export') }}" class="btn btn-success btn-modern">
            <i class="bi bi-download"></i> Export CSV
        </a>
        <a href="{{ route('buku.create') }}" class="btn btn-primary btn-modern">
            <i class="bi bi-plus-circle"></i> Tambah Buku
        </a>
        <button type="button" id="bulkDeleteBtn" class="btn btn-danger btn-modern">
            <i class="bi bi-trash"></i> Hapus Massal
        </button>
    </div>
</div>

{{-- Statistik Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon flex-shrink-0" style="background: linear-gradient(135deg, #6366F1, #4F46E5); color:#fff;">
                    <i class="bi bi-book"></i>
                </div>
                <div>
                    <div class="stat-label">Total Buku</div>
                    <div class="stat-value">{{ $bukus->count() }}</div>
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
                    <div class="stat-label">Tersedia</div>
                    <div class="stat-value">{{ $bukus->where('stok', '>', 0)->count() }}</div>
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
                    <div class="stat-label">Stok Habis</div>
                    <div class="stat-value">{{ $bukus->where('stok', '<=', 0)->count() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Search --}}
<div class="card-modern mb-4">
    <div class="card-body">
        <form action="{{ route('buku.index') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-md-6">
                <label class="form-label">Cari Buku</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control"
                           placeholder="Cari berdasarkan judul, pengarang, atau penerbit..."
                           value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label">Tahun Terbit</label>
                <select name="tahun" class="form-select">
                    <option value="">Semua Tahun</option>
                    @foreach($tahunList as $tahun)
                        <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                            {{ $tahun }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-modern flex-grow-1">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                @if(request()->anyFilled(['search', 'tahun']))
                    <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary btn-modern">
                        <i class="bi bi-x-circle"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

{{-- Tabel Buku --}}
<div class="card-modern">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table-modern table">
                <thead>
                    <tr>
                        <th style="width:40px;">
                            <input type="checkbox" id="selectAll" class="form-check-input">
                        </th>
                        <th>Kode</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th style="width:140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bukus as $buku)
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input buku-checkbox" value="{{ $buku->id }}">
                        </td>
                        <td><code>{{ $buku->kode_buku }}</code></td>
                        <td>
                            <a href="{{ route('buku.show', $buku->id) }}" class="fw-semibold text-decoration-none">
                                {{ Str::limit($buku->judul, 40) }}
                            </a>
                        </td>
                        <td>{{ $buku->pengarang }}</td>
                        <td>
                            <span class="badge bg-primary-50 text-primary badge-modern">
                                {{ $buku->kategori }}
                            </span>
                        </td>
                        <td>
                            @if($buku->stok > 5)
                                <span class="badge bg-success badge-modern">{{ $buku->stok }}</span>
                            @elseif($buku->stok > 0)
                                <span class="badge bg-warning text-dark badge-modern">{{ $buku->stok }}</span>
                            @else
                                <span class="badge bg-danger badge-modern">Habis</span>
                            @endif
                        </td>
                        <td>Rp {{ number_format($buku->harga, 0, ',', '.') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('buku.show', $buku->id) }}"
                                   class="btn btn-sm btn-primary btn-modern" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('buku.edit', $buku->id) }}"
                                   class="btn btn-sm btn-warning btn-modern" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus buku {{ $buku->judul }}?')">
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
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="bi bi-book"></i></div>
                                <h5>Tidak ada data buku</h5>
                                <p class="mb-0">
                                    @if(request()->anyFilled(['search', 'kategori', 'stok']))
                                        Tidak ditemukan buku dengan filter yang dipilih.
                                    @else
                                        Belum ada buku yang ditambahkan.
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

{{-- Bulk Delete Form --}}
<form id="bulkDeleteForm" action="{{ route('buku.bulk-delete') }}" method="POST" style="display:none;">
    @csrf
    <input type="hidden" name="ids" id="bulkIds">
</form>
@endsection

@push('scripts')
<script>
    // Select All checkbox
    document.getElementById('selectAll')?.addEventListener('change', function() {
        document.querySelectorAll('.buku-checkbox').forEach(cb => cb.checked = this.checked);
    });

    // Bulk Delete
    document.getElementById('bulkDeleteBtn')?.addEventListener('click', function() {
        const checked = document.querySelectorAll('.buku-checkbox:checked');
        if (checked.length === 0) {
            Swal.fire('Pilih buku', 'Pilih minimal satu buku untuk dihapus.', 'warning');
            return;
        }
        Swal.fire({
            title: 'Hapus Massal',
            text: `Apakah Anda yakin ingin menghapus ${checked.length} buku terpilih?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#64748B',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then(result => {
            if (result.isConfirmed) {
                document.getElementById('bulkIds').value = Array.from(checked).map(cb => cb.value).join(',');
                document.getElementById('bulkDeleteForm').submit();
            }
        });
    });
</script>
@endpush
