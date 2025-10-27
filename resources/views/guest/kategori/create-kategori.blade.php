@extends('layouts.guest.app')
@section('content')
    <!-- ========================= HERO SECTION ========================= -->
    <section id="form" class="pt-100 pb-100 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold">Form Input Data Kategori</h2>
                <p class="text-muted">Isi data kategori ke sistem Bina Desa.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow border-0 p-4">
                        <form action="{{ route('kategori.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label fw-bold">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    placeholder="Masukkan nama" required {{ old('nama') }}>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" placeholder="Masukkan deskripsi kategori"
                                    required>{{ old('deskripsi') }}</textarea>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="main-btn btn-hover">Simpan Data</button>
                                <button type="reset" class="main-btn btn-outline-secondary ms-2">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
