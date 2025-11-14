@extends('layouts.guest.app')
@section('content')
<section id="form" class="pt-100 pb-100 bg-light">
    <div class="container">

        <div class="section-title text-center mb-5">
            <h2 class="fw-bold">Form Input Dokumen Hukum</h2>
            <p class="text-muted">Isi data dokumen hukum ke sistem Bina Desa.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card shadow border-0 p-4">
                    <form action="{{ route('dokumenhukum.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenis Dokumen</label>
                            <select name="jenis_id" class="form-select" required>
                                <option value="">-- Pilih Jenis --</option>
                                @foreach ($jenis as $j)
                                    <option value="{{ $j->jenis_id }}">{{ $j->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori</label>
                            <select name="kategori_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->kategori_id }}">{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor</label>
                            <input type="text" name="nomor" class="form-control" required placeholder="Masukkan nomor dokumen">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul</label>
                            <input type="text" name="judul" class="form-control" required placeholder="Masukkan judul">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Ringkasan</label>
                            <textarea name="ringkasan" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="diproses">Diproses</option>
                                <option value="ditolak">Ditolak</option>
                                <option value="diterima">Diterima</option>
                            </select>
                        </div>

                        <div class="text-center">
                            <button class="main-btn btn-hover">Simpan</button>
                            <button type="reset" class="main-btn btn-outline-secondary ms-2">Reset</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
