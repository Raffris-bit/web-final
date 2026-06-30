@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
<div class="page-header">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('buku.index') }}">Buku</a></li>
                <li class="breadcrumb-item"><a href="{{ route('buku.show', $buku->id) }}">{{ $buku->judul }}</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card-modern">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-pencil-square text-warning"></i>
                <span>Edit Buku: <strong>{{ $buku->judul }}</strong></span>
            </div>
            <div class="card-body">
                <form action="{{ route('buku.update', $buku->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Kode Buku --}}
                        <div class="col-md-4 mb-3">
                            <label for="kode_buku" class="form-label">
                                Kode Buku <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="kode_buku" id="kode_buku"
                                   class="form-control @error('kode_buku') is-invalid @enderror"
                                   value="{{ old('kode_buku', $buku->kode_buku) }}" required>
                            @error('kode_buku')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Judul --}}
                        <div class="col-md-8 mb-3">
                            <label for="judul" class="form-label">
                                Judul Buku <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="judul" id="judul"
                                   class="form-control @error('judul') is-invalid @enderror"
                                   value="{{ old('judul', $buku->judul) }}" required>
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
                                    <option value="{{ $kategori->nama }}"
                                        {{ old('kategori', $buku->kategori) == $kategori->nama ? 'selected' : '' }}>
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
                                   value="{{ old('pengarang', $buku->pengarang) }}" required>
                            @error('pengarang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Penerbit --}}
                        <div class="col-md-4 mb-3">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="text" name="penerbit" id="penerbit"
                                   class="form-control @error('penerbit') is-invalid @enderror"
                                   value="{{ old('penerbit', $buku->penerbit) }}">
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
                                   value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                                   min="1900" max="{{ date('Y') }}" required>
                            @error('tahun_terbit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ISBN --}}
                        <div class="col-md-3 mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="text" name="isbn" id="isbn"
                                   class="form-control @error('isbn') is-invalid @enderror"
                                   value="{{ old('isbn', $buku->isbn) }}">
                            @error('isbn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Bahasa --}}
                        <div class="col-md-3 mb-3">
                            <label for="bahasa" class="form-label">Bahasa</label>
                            <select name="bahasa" id="bahasa"
                                    class="form-select @error('bahasa') is-invalid @enderror">
                                <option value="Indonesia" {{ old('bahasa', $buku->bahasa) == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                <option value="Inggris" {{ old('bahasa', $buku->bahasa) == 'Inggris' ? 'selected' : '' }}>Inggris</option>
                                <option value="Arab" {{ old('bahasa', $buku->bahasa) == 'Arab' ? 'selected' : '' }}>Arab</option>
                                <option value="Lainnya" {{ old('bahasa', $buku->bahasa) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                                   value="{{ old('harga', $buku->harga) }}" min="0">
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
                                   value="{{ old('stok', $buku->stok) }}" min="0" required>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-md-8 mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      placeholder="Deskripsi singkat tentang buku">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-outline-secondary btn-modern">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-warning btn-modern px-4">
                            <i class="bi bi-save"></i> Update Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Info --}}
        <div class="card-modern mt-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-center gap-2 text-muted small">
                    <i class="bi bi-info-circle"></i>
                    <span>Buku ditambahkan {{ $buku->created_at->format('d M Y H:i') }}
                    — Terakhir diupdate {{ $buku->updated_at->format('d M Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
