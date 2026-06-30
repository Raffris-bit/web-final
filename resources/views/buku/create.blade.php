@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
<div class="page-header">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('buku.index') }}">Buku</a></li>
                <li class="breadcrumb-item active">Tambah Buku</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card-modern">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-plus-circle text-primary"></i>
                <span>Tambah Buku Baru</span>
            </div>
            <div class="card-body">
                <form action="{{ route('buku.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        {{-- Kode Buku --}}
                        <div class="col-md-4 mb-3">
                            <label for="kode_buku" class="form-label">
                                Kode Buku <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="kode_buku" id="kode_buku"
                                   class="form-control @error('kode_buku') is-invalid @enderror"
                                   value="{{ old('kode_buku') }}" placeholder="BKU-001" required>
                            @error('kode_buku')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Format: BKP-XXX (contoh: BKU-001)</div>
                        </div>

                        {{-- Judul --}}
                        <div class="col-md-8 mb-3">
                            <label for="judul" class="form-label">
                                Judul Buku <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="judul" id="judul"
                                   class="form-control @error('judul') is-invalid @enderror"
                                   value="{{ old('judul') }}" placeholder="Masukkan judul buku" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- Kategori --}}
                        <div class="col-md-4 mb-3">
                            <label for="kategori" class="form-label">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <select name="kategori" id="kategori"
                                    class="form-select @error('kategori') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->nama }}" {{ old('kategori') == $kategori->nama ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Pengarang --}}
                        <div class="col-md-4 mb-3">
                            <label for="pengarang" class="form-label">
                                Pengarang <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="pengarang" id="pengarang"
                                   class="form-control @error('pengarang') is-invalid @enderror"
                                   value="{{ old('pengarang') }}" placeholder="Nama pengarang" required>
                            @error('pengarang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Penerbit --}}
                        <div class="col-md-4 mb-3">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="text" name="penerbit" id="penerbit"
                                   class="form-control @error('penerbit') is-invalid @enderror"
                                   value="{{ old('penerbit') }}" placeholder="Nama penerbit">
                            @error('penerbit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- Tahun Terbit --}}
                        <div class="col-md-3 mb-3">
                            <label for="tahun_terbit" class="form-label">
                                Tahun Terbit <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="tahun_terbit" id="tahun_terbit"
                                   class="form-control @error('tahun_terbit') is-invalid @enderror"
                                   value="{{ old('tahun_terbit', date('Y')) }}" min="1900" max="{{ date('Y') }}" required>
                            @error('tahun_terbit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ISBN --}}
                        <div class="col-md-3 mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="text" name="isbn" id="isbn"
                                   class="form-control @error('isbn') is-invalid @enderror"
                                   value="{{ old('isbn') }}" placeholder="ISBN (opsional)">
                            @error('isbn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Bahasa --}}
                        <div class="col-md-3 mb-3">
                            <label for="bahasa" class="form-label">Bahasa</label>
                            <select name="bahasa" id="bahasa"
                                    class="form-select @error('bahasa') is-invalid @enderror">
                                <option value="Indonesia" {{ old('bahasa') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                <option value="Inggris" {{ old('bahasa') == 'Inggris' ? 'selected' : '' }}>Inggris</option>
                                <option value="Arab" {{ old('bahasa') == 'Arab' ? 'selected' : '' }}>Arab</option>
                                <option value="Lainnya" {{ old('bahasa') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('bahasa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Harga --}}
                        <div class="col-md-3 mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" name="harga" id="harga"
                                   class="form-control @error('harga') is-invalid @enderror"
                                   value="{{ old('harga', 0) }}" min="0">
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- Stok --}}
                        <div class="col-md-4 mb-3">
                            <label for="stok" class="form-label">
                                Stok <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="stok" id="stok"
                                   class="form-control @error('stok') is-invalid @enderror"
                                   value="{{ old('stok', 1) }}" min="0" required>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Jumlah eksemplar buku tersedia</div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-md-8 mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      placeholder="Deskripsi singkat tentang buku (opsional)">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary btn-modern">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary btn-modern px-4">
                            <i class="bi bi-save"></i> Simpan Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
