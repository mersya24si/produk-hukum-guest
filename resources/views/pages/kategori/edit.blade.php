@extends('layouts.guest.app')
@section('content')
    <!-- ========================= EDIT FORM SECTION ========================= -->
    <section id="form" class="pt-100 pb-100 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold">Form Edit Kategori</h2>
                <p class="text-muted">Ubah data berikut untuk memperbarui informasi kategori produk hukum desa.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow border-0 p-4">
                        <form action="{{ route('kategori.update', $dataKategori->kategori_id) }}" method="POST">
                            @@csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama" class="form-label fw-bold">Nama Kategori</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    placeholder="Masukkan nama kategori"
                                    value="{{ old('nama', $dataKategori->nama) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"
                                    placeholder="Masukkan deskripsi kategori (opsional)">{{ old('deskripsi', $dataKategori->deskripsi) }}</textarea>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="main-btn btn-hover">Simpan Perubahan</button>
                                <a href="{{ route('kategori.index') }}" class="main-btn btn-outline-secondary ms-2">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
