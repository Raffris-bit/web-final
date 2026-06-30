@extends('layouts.app')

@section('title', 'Transaksi Peminjaman')

@section('content')
<div class="page-header">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Transaksi</a></li>
                <li class="breadcrumb-item active">Pinjam Buku</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card-modern">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-plus-circle text-primary"></i>
                <span>Form Peminjaman Buku</span>
            </div>
            <div class="card-body">
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf

                    {{-- Pilih Anggota --}}
                    <div class="mb-4">
                        <label for="anggota_id" class="form-label">
                            Pilih Anggota <span class="text-danger">*</span>
                        </label>
                        <select name="anggota_id" id="anggota_id"
                                class="form-select @error('anggota_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Anggota --</option>
                            @foreach($anggotas as $anggota)
                                <option value="{{ $anggota->id }}" {{ old('anggota_id') == $anggota->id ? 'selected' : '' }}>
                                    {{ $anggota->kode_anggota }} — {{ $anggota->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('anggota_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="bi bi-info-circle"></i>
                            Hanya anggota dengan status Aktif yang dapat meminjam
                        </div>
                    </div>

                    {{-- Pilih Buku --}}
                    <div class="mb-4">
                        <label for="buku_id" class="form-label">
                            Pilih Buku <span class="text-danger">*</span>
                        </label>
                        <select name="buku_id" id="buku_id"
                                class="form-select @error('buku_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Buku --</option>
                            @foreach($bukus as $buku)
                                <option value="{{ $buku->id }}" {{ old('buku_id') == $buku->id ? 'selected' : '' }}>
                                    {{ $buku->judul }} — Stok: {{ $buku->stok }}
                                </option>
                            @endforeach
                        </select>
                        @error('buku_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="bi bi-info-circle"></i>
                            Hanya buku dengan stok tersedia yang dapat dipinjam
                        </div>
                    </div>

                    <div class="row">
                        {{-- Tanggal Pinjam --}}
                        <div class="col-md-6 mb-4">
                            <label for="tanggal_pinjam" class="form-label">
                                Tanggal Pinjam <span class="text-danger">*</span>
                            </label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam"
                                   class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                                   value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                                   max="{{ date('Y-m-d') }}">
                            @error('tanggal_pinjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="bi bi-calendar"></i>
                                Tanggal kembali otomatis 7 hari dari tanggal pinjam
                            </div>
                        </div>

                        {{-- Keterangan --}}
                        <div class="col-md-6 mb-4">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="3"
                                      class="form-control @error('keterangan') is-invalid @enderror"
                                      placeholder="Keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Info Box --}}
                    <div class="alert alert-info alert-modern d-flex gap-3">
                        <i class="bi bi-info-circle fs-4 flex-shrink-0"></i>
                        <div>
                            <strong>Informasi Peminjaman:</strong>
                            <ul class="mb-0 mt-2">
                                <li>Durasi peminjaman: <strong>7 hari</strong></li>
                                <li>Denda keterlambatan: <strong>Rp 5.000/hari</strong></li>
                                <li>Stok buku akan berkurang otomatis setelah peminjaman</li>
                            </ul>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary btn-modern">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary btn-modern px-4">
                            <i class="bi bi-save"></i> Proses Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
