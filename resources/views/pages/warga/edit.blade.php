@extends('layouts.guest.app')

@section('content')
    <br><br>

    <section id="form-edit-warga" class="pt-100 pb-100 bg-light">
        <div class="container">

            <div class="mb-4">
                <a href="{{ route('warga.index') }}" class="btn btn-secondary rounded-pill px-4">
                    <i class="lni lni-arrow-left me-1"></i> Kembali ke Daftar Warga
                </a>
            </div>

            <div class="section-title text-center mb-5 border-bottom pb-3">
                <h2 class="fw-bold text-logo-accent">Form Edit Data Warga</h2>
                <p class="text-muted">Ubah data berikut untuk memperbarui informasi warga **{{ $dataWarga->nama }}** di sistem Bina Desa.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 p-5 service-card-hover rounded-4">

                        <form action="{{ route('warga.update', $dataWarga->warga_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">

                                <div class="col-md-6">
                                    <label for="no_ktp" class="form-label fw-bold">Nomor KTP</label>
                                    <input type="text" name="no_ktp" id="no_ktp" class="form-control rounded-pill"
                                        value="{{ old('no_ktp', $dataWarga->no_ktp) }}" required>
                                    @error('no_ktp') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama" class="form-control rounded-pill"
                                        value="{{ old('nama', $dataWarga->nama) }}" required>
                                    @error('nama') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="jenis_kelamin" class="form-label fw-bold">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select rounded-pill" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        @php
                                            $jkOptions = ['Laki-laki', 'Perempuan'];
                                            $selectedJK = old('jenis_kelamin', $dataWarga->jenis_kelamin);
                                        @endphp
                                        @foreach ($jkOptions as $option)
                                            <option value="{{ $option }}" {{ $selectedJK == $option ? 'selected' : '' }}>
                                                {{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_kelamin') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="agama" class="form-label fw-bold">Agama</label>
                                    <input type="text" name="agama" id="agama" class="form-control rounded-pill"
                                        value="{{ old('agama', $dataWarga->agama) }}" required>
                                    @error('agama') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="pekerjaan" class="form-label fw-bold">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" id="pekerjaan" class="form-control rounded-pill"
                                        value="{{ old('pekerjaan', $dataWarga->pekerjaan) }}" required>
                                    @error('pekerjaan') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="telp" class="form-label fw-bold">Nomor Telepon</label>
                                    <input type="text" name="telp" id="telp" class="form-control rounded-pill"
                                        value="{{ old('telp', $dataWarga->telp) }}" required>
                                    @error('telp') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="email" name="email" id="email" class="form-control rounded-pill"
                                        value="{{ old('email', $dataWarga->email) }}" required>
                                    @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12 d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-logo-primary btn-hover rounded-pill px-4 me-2">
                                        <i class="lni lni-save me-1"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                        Batal
                                    </a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
