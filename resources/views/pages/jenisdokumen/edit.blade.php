@extends('layouts.guest.app')
@section('content')
    <!-- ========================= EDIT FORM SECTION ========================= -->
    <section id="form" class="pt-100 pb-100 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold">Form Edit Jenis Dokumen</h2>
                <p class="text-muted">Ubah data berikut untuk memperbarui informasi Jenis Dokumen produk hukum desa.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow border-0 p-4">
                        <form action="{{ route('jenisdokumen.update', $dataJenis->jenis_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama jenis" class="form-label fw-bold">Nama Kategori</label>
                                <input type="text" name="nama_jenis" id="nama_jenis" class="form-control"
                                    placeholder="Masukkan nama kategori"
                                    value="{{ old('nama_jenis', $dataJenis->nama_jenis) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"
                                    placeholder="Masukkan deskripsi Jenis Dokumen (opsional)">{{ old('deskripsi', $dataJenis->deskripsi) }}</textarea>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="main-btn btn-hover">Simpan Perubahan</button>
                                <a href="{{ route('jenisdokumen.index') }}" class="main-btn btn-outline-secondary ms-2">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

