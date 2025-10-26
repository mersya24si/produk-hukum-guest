@extends('layouts.admin.app')
@section('content')
    <!-- ========================= HERO SECTION ========================= -->
        <section id="form" class="pt-100 pb-100 bg-light">
      <div class="container">
        <div class="section-title text-center mb-5">
          <h2 class="fw-bold">Form Input Data Warga</h2>
          <p class="text-muted">Isi data berikut untuk menambahkan warga baru ke sistem Bina Desa.</p>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card shadow border-0 p-4">
              <form action="{{ route('warga.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                  <label for="no_ktp" class="form-label fw-bold">Nomor KTP</label>
                  <input type="text" name="no_ktp" id="no_ktp" class="form-control" placeholder="Masukkan nomor KTP" value="{{ old('no_ktp') }}" required>
                </div>

                <div class="mb-3">
                  <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                  <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama warga" value="{{ old('nama') }}" required>
                </div>

                <div class="mb-3">
                  <label for="jenis_kelamin" class="form-label fw-bold">Jenis Kelamin</label>
                  <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="agama" class="form-label fw-bold">Agama</label>
                  <input type="text" name="agama" id="agama" class="form-control" placeholder="Masukkan Agama" value="{{ old('agama') }}" required>
                </div>

                <div class="mb-3">
                  <label for="pekerjaan" class="form-label fw-bold">Pekerjaan</label>
                  <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" placeholder="Masukkan pekerjaan" value="{{ old('pekerjaan') }}" required>
                </div>

                <div class="mb-3">
                  <label for="telp" class="form-label fw-bold">Nomor Telepon</label>
                  <input type="text" name="telp" id="telp" class="form-control" placeholder="Masukkan nomor telepon" value="{{ old('telp') }}" required>
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label fw-bold">Email</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan alamat email" value="{{ old('email') }}" required>
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