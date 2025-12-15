@extends('layouts.guest.app')

@section('content')
    <br><br>

    <section id="form-input-riwayat" class="pt-100 pb-100 bg-light">
        <div class="container">

            <div class="mb-4">
                <a href="{{ route('riwayat.index') }}" class="btn btn-secondary rounded-pill px-4">
                    <i class="lni lni-arrow-left me-1"></i> Kembali ke Daftar Riwayat
                </a>
            </div>

            <div class="section-title text-center mb-5 border-bottom pb-3">
                <h2 class="fw-bold text-logo-accent">Form Input Riwayat Perubahan</h2>
                <p class="text-muted">Tambahkan log perubahan manual untuk dokumen hukum tertentu.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 p-5 service-card-hover rounded-4">

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Gagal!</strong> Mohon periksa kembali data input Anda.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('riwayat.store') }}" method="POST">
                            @csrf

                            <div class="row g-4">

                                {{-- Dokumen ID --}}
                                <div class="col-12">
                                    <label for="dokumen_id" class="form-label fw-bold">Dokumen Terkait <span class="text-danger">*</span></label>
                                    <select name="dokumen_id" id="dokumen_id" class="form-select rounded-pill @error('dokumen_id') is-invalid @enderror" required>
                                        <option value="" disabled selected>-- Pilih Dokumen Hukum --</option>
                                        @foreach ($dokumenList as $dokumen)
                                            <option value="{{ $dokumen->dokumen_id }}" {{ old('dokumen_id') == $dokumen->dokumen_id ? 'selected' : '' }}>
                                                [{{ $dokumen->nomor }}] {{ $dokumen->judul }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('dokumen_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                {{-- Tanggal dan Versi --}}
                                <div class="col-md-6">
                                    <label for="tanggal" class="form-label fw-bold">Tanggal Perubahan <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control rounded-pill @error('tanggal') is-invalid @enderror"
                                        value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                    @error('tanggal') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="versi" class="form-label fw-bold">Nomor Versi (Opsional)</label>
                                    <input type="text" name="versi" id="versi" class="form-control rounded-pill @error('versi') is-invalid @enderror"
                                        placeholder="Contoh: 2.1" value="{{ old('versi') }}">
                                    @error('versi') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                {{-- Uraian Perubahan --}}
                                <div class="col-12">
                                    <label for="uraian_perubahan" class="form-label fw-bold">Uraian Detail Perubahan <span class="text-danger">*</span></label>
                                    <textarea name="uraian_perubahan" id="uraian_perubahan" class="form-control rounded-4 @error('uraian_perubahan') is-invalid @enderror" rows="5"
                                        placeholder="Jelaskan perubahan spesifik yang terjadi pada dokumen ini." required>{{ old('uraian_perubahan') }}</textarea>
                                    @error('uraian_perubahan') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12 text-center mt-5">
                                    <button type="submit" class="btn btn-logo-primary btn-hover rounded-pill px-4 me-2">
                                        <i class="lni lni-save me-1"></i> Simpan Riwayat
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
