@extends('layouts.guest.app')

@section('content')
    <br><br>

    <section id="form-input-warga" class="pt-100 pb-100 bg-light">
        <div class="container">

            <div class="mb-4">
                <a href="{{ route('warga.index') }}" class="btn btn-secondary rounded-pill px-4">
                    <i class="lni lni-arrow-left me-1"></i> Kembali ke Daftar Warga
                </a>
            </div>

            <div class="section-title text-center mb-5 border-bottom pb-3">
                <h2 class="fw-bold text-logo-accent">Form Input Data Warga</h2>
                <p class="text-muted">Isi data berikut untuk menambahkan warga baru ke sistem Bina Desa.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 p-5 service-card-hover rounded-4">

                        <form action="{{ route('warga.store') }}" method="POST">
                            @csrf

                            <div class="row g-4">

                                <div class="col-md-6">
                                    <label for="no_ktp" class="form-label fw-bold">Nomor KTP</label>
                                    <input type="text" name="no_ktp" id="no_ktp" class="form-control rounded-pill"
                                        placeholder="Masukkan nomor KTP" value="{{ old('no_ktp') }}" required>
                                    @error('no_ktp') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama" class="form-control rounded-pill"
                                        placeholder="Masukkan nama warga" value="{{ old('nama') }}" required>
                                    @error('nama') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="jenis_kelamin" class="form-label fw-bold">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select rounded-pill" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="agama" class="form-label fw-bold">Agama</label>
                                    <input type="text" name="agama" id="agama" class="form-control rounded-pill"
                                        placeholder="Masukkan Agama" value="{{ old('agama') }}" required>
                                    @error('agama') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="pekerjaan" class="form-label fw-bold">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" id="pekerjaan" class="form-control rounded-pill"
                                        placeholder="Masukkan pekerjaan" value="{{ old('pekerjaan') }}" required>
                                    @error('pekerjaan') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="telp" class="form-label fw-bold">Nomor Telepon</label>
                                    <input type="text" name="telp" id="telp" class="form-control rounded-pill"
                                        placeholder="Masukkan nomor telepon" value="{{ old('telp') }}" required>
                                    @error('telp') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="email" name="email" id="email" class="form-control rounded-pill"
                                        placeholder="Masukkan alamat email" value="{{ old('email') }}" required>
                                    @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12 d-flex justify-content-end mt-4">
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
