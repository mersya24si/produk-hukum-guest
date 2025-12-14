@extends('layouts.guest.app')
@section('content')
    <br><br>

    <section id="form-input-lampiran" class="pt-100 pb-100 bg-light">
        <div class="container">

            <div class="mb-4">
                {{-- Menggunakan route lampirandokumen.index --}}
                <a href="{{ route('lampirandokumen.index') }}" class="btn btn-secondary rounded-pill px-4">
                    <i class="lni lni-arrow-left me-1"></i> Kembali ke Daftar Lampiran
                </a>
            </div>

            <div class="section-title text-center mb-5 border-bottom pb-3">
                <h2 class="fw-bold text-logo-accent">Form Input Lampiran Dokumen</h2>
                <p class="text-muted">Tambahkan lampiran file dan hubungkan dengan Dokumen Hukum yang relevan.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="card border-0 p-5 service-card-hover rounded-4">

                        {{-- Menggunakan route lampirandokumen.store --}}
                        <form action="{{ route('lampirandokumen.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-4">

                                {{-- BARIS 1: Dokumen Terkait --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold">Dokumen Hukum Terkait <span class="text-danger">*</span></label>
                                    {{-- Variabel $dokumenHukum di pass dari controller --}}
                                    <select name="dokumen_id" class="form-select rounded-pill" required>
                                        <option value="">-- Pilih Dokumen Hukum --</option>
                                        @foreach ($dokumenHukum as $d)
                                            <option value="{{ $d->dokumen_id }}"
                                                {{ old('dokumen_id') == $d->dokumen_id ? 'selected' : '' }}>
                                                [{{ $d->nomor }}] {{ $d->judul }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('dokumen_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                {{-- BARIS 2: Keterangan --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold">Keterangan Lampiran (Opsional)</label>
                                    {{-- Menggunakan field 'keterangan' dari model LampiranDokumen --}}
                                    <textarea name="keterangan" class="form-control rounded-4" rows="3" placeholder="Tuliskan keterangan singkat mengenai lampiran ini.">{{ old('keterangan') }}</textarea>
                                    @error('keterangan') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>


                                {{-- BARIS 3: Input File Upload (REQUIRED) --}}
                                <div class="col-12 border rounded-4 p-4 bg-light">
                                    <label class="form-label fw-bold text-dark"><i class="lni lni-upload me-2"></i> Upload File Lampiran <span class="text-danger">*</span></label>
                                    <input type="file" name="files[]" class="form-control" multiple required>
                                    <div class="form-text text-muted">
                                        Pilih minimal satu file. Bisa pilih banyak file sekaligus. Format: PDF, JPG, PNG, DOCX. Maks 10MB per file.
                                    </div>
                                    {{-- Jika ada error validasi untuk array files --}}
                                    @error('files.*') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    @error('files') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12 text-center mt-5">
                                    <button type="submit" class="btn btn-logo-primary btn-hover rounded-pill px-4 me-2">
                                        <i class="lni lni-save me-1"></i> Simpan Lampiran
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
