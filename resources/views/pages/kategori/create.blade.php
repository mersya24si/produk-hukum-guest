@extends('layouts.guest.app')
@section('content')
    <br><br>

    <section id="form-input-kategori" class="pt-100 pb-100 bg-light">
        <div class="container">

            <div class="mb-4">
                <a href="{{ route('kategori.index') }}" class="btn btn-secondary rounded-pill px-4">
                    <i class="lni lni-arrow-left me-1"></i> Kembali ke Daftar Kategori
                </a>
            </div>

            <div class="section-title text-center mb-5 border-bottom pb-3">
                <h2 class="fw-bold text-logo-accent">Form Input Data Kategori</h2>
                <p class="text-muted">Isi data kategori untuk menambahkan kategori baru ke sistem Bina Desa.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 p-5 service-card-hover rounded-4">

                        <form action="{{ route('kategori.store') }}" method="POST">
                            @csrf

                            <div class="row g-4">
                                <div class="col-12">
                                    <label for="nama" class="form-label fw-bold">Nama Kategori</label>
                                    <input type="text" name="nama" id="nama" class="form-control rounded-pill"
                                        placeholder="Masukkan nama kategori" value="{{ old('nama') }}" required>
                                    @error('nama') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12">
                                    <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" class="form-control rounded-4" rows="4"
                                        placeholder="Masukkan deskripsi kategori" required>{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12 text-center mt-5">
                                    <button type="submit" class="btn btn-logo-primary btn-hover rounded-pill px-4 me-2">
                                        <i class="lni lni-save me-1"></i> Simpan Data
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary rounded-pill px-4">
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
