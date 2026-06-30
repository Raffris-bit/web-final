@extends('layouts.app')

@section('title', 'Tambah Anggota')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
<div class="page-header">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('anggota.index') }}">Anggota</a></li>
                <li class="breadcrumb-item active">Tambah Anggota</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card-modern">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-person-plus text-success"></i>
                <span>Tambah Anggota Baru</span>
            </div>
            <div class="card-body">
                <form action="{{ route('anggota.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        {{-- Kode Anggota --}}
                        <div class="col-md-4 mb-3">
                            <label for="kode_anggota" class="form-label">
                                Kode Anggota <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="kode_anggota" id="kode_anggota"
                                   class="form-control @error('kode_anggota') is-invalid @enderror"
                                   value="{{ old('kode_anggota', $kodeAnggota) }}" readonly>
                            @error('kode_anggota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Kode otomatis dari sistem</div>
                        </div>

                        {{-- Nama --}}
                        <div class="col-md-8 mb-3">
                            <label for="nama" class="form-label">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nama" id="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- Email --}}
                        <div class="col-md-4 mb-3">
                            <label for="email" class="form-label">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" placeholder="email@example.com" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Telepon --}}
                        <div class="col-md-4 mb-3">
                            <label for="telepon" class="form-label">
                                Telepon <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="telepon" id="telepon"
                                   class="form-control @error('telepon') is-invalid @enderror"
                                   value="{{ old('telepon') }}" placeholder="08xxxxxxxxxx" required>
                            @error('telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="col-md-4 mb-3">
                            <label for="jenis_kelamin" class="form-label">
                                Jenis Kelamin <span class="text-danger">*</span>
                            </label>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                    class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- Tanggal Lahir --}}
                        <div class="col-md-4 mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="text" name="tanggal_lahir" id="tanggal_lahir"
                                   class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                   value="{{ old('tanggal_lahir') }}" placeholder="Pilih tanggal">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Pekerjaan --}}
                        <div class="col-md-4 mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" name="pekerjaan" id="pekerjaan"
                                   class="form-control @error('pekerjaan') is-invalid @enderror"
                                   value="{{ old('pekerjaan') }}" placeholder="Pekerjaan (opsional)">
                            @error('pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status"
                                    class="form-select @error('status') is-invalid @enderror">
                                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- Tanggal Daftar --}}
                        <div class="col-md-4 mb-3">
                            <label for="tanggal_daftar" class="form-label">Tanggal Daftar</label>
                            <input type="text" name="tanggal_daftar" id="tanggal_daftar"
                                   class="form-control @error('tanggal_daftar') is-invalid @enderror"
                                   value="{{ old('tanggal_daftar', date('Y-m-d')) }}">
                            @error('tanggal_daftar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="col-md-8 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="3"
                                      class="form-control @error('alamat') is-invalid @enderror"
                                      placeholder="Alamat lengkap (opsional)">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary btn-modern">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success btn-modern px-4">
                            <i class="bi bi-save"></i> Simpan Anggota
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
<script>
    flatpickr("#tanggal_lahir", {
        dateFormat: "Y-m-d",
        maxDate: "today",
        locale: "id",
        altInput: true,
        altFormat: "d F Y",
    });

    flatpickr("#tanggal_daftar", {
        dateFormat: "Y-m-d",
        maxDate: "today",
        locale: "id",
        altInput: true,
        altFormat: "d F Y",
        defaultDate: "today",
    });

    document.getElementById('telepon').addEventListener('input', function() {
        this.value = this.value.replace(/[^\d+]/g, '');
    });
</script>
@endpush
