@extends('layouts.guest.app')
@section('content')
    <br><br>

    <section id="form-input-dokumen" class="pt-100 pb-100 bg-light">
        <div class="container">

            <div class="mb-4">
                <a href="{{ route('dokumenhukum.index') }}" class="btn btn-secondary rounded-pill px-4">
                    <i class="lni lni-arrow-left me-1"></i> Kembali ke Daftar Dokumen
                </a>
            </div>

            <div class="section-title text-center mb-5 border-bottom pb-3">
                <h2 class="fw-bold text-logo-accent">Form Input Dokumen Hukum</h2>
                <p class="text-muted">Isi data dokumen hukum ke sistem Bina Desa.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="card border-0 p-5 service-card-hover rounded-4">

                        <form action="{{ route('dokumenhukum.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-4">

                                {{-- BARIS 1: Jenis & Kategori --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Jenis Dokumen</label>
                                    <select name="jenis_id" class="form-select rounded-pill" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        @foreach ($jenis as $j)
                                            <option value="{{ $j->jenis_id }}" {{ old('jenis_id') == $j->jenis_id ? 'selected' : '' }}>
                                                {{ $j->nama_jenis }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Kategori</label>
                                    <select name="kategori_id" class="form-select rounded-pill" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->kategori_id }}" {{ old('kategori_id') == $k->kategori_id ? 'selected' : '' }}>
                                                {{ $k->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                {{-- BARIS 2: Nomor & Tanggal --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nomor Dokumen</label>
                                    <input type="text" name="nomor" class="form-control rounded-pill" value="{{ old('nomor') }}" required placeholder="Masukkan nomor dokumen">
                                    @error('nomor') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Tanggal Penerbitan</label>
                                    <input type="date" name="tanggal" class="form-control rounded-pill" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                    @error('tanggal') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                {{-- BARIS 3: Judul & Status --}}
                                <div class="col-md-9">
                                    <label class="form-label fw-bold">Judul Dokumen</label>
                                    <input type="text" name="judul" class="form-control rounded-pill" value="{{ old('judul') }}" required placeholder="Masukkan judul dokumen">
                                    @error('judul') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Status</label>
                                    <select name="status" class="form-select rounded-pill" required>
                                        <option value="diproses" {{ old('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="diterima" {{ old('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                        <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    @error('status') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                {{-- BARIS 4: Ringkasan --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold">Ringkasan</label>
                                    <textarea name="ringkasan" class="form-control rounded-4" rows="4" required placeholder="Tuliskan ringkasan singkat isi dokumen">{{ old('ringkasan') }}</textarea>
                                    @error('ringkasan') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                {{-- BARIS 5: Input File Upload --}}
                                <div class="col-12 border rounded-4 p-4 bg-light">
                                    <label class="form-label fw-bold text-dark"><i class="lni lni-upload me-2"></i> Upload Lampiran</label>
                                    <input type="file" name="files[]" class="form-control" multiple>
                                    <div class="form-text text-muted">
                                        Bisa pilih banyak file sekaligus. Format: PDF, JPG, PNG. Maks 10MB per file.
                                    </div>
                                    @error('files') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12 text-center mt-5">
                                    <button type="submit" class="btn btn-logo-primary btn-hover rounded-pill px-4 me-2">
                                        <i class="lni lni-save me-1"></i> Simpan
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
