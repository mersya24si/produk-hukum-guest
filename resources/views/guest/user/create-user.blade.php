@extends('layouts.admin.app')
@section('content')
    <!-- ========================= HERO SECTION ========================= -->
        <section id="form" class="pt-100 pb-100 bg-light">
      <div class="container">
        <div class="section-title text-center mb-5">
          <h2 class="fw-bold">Form Input User</h2>
          <p class="text-muted">Isi data berikut untuk menambahkan User baru ke sistem Bina Desa.</p>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card shadow border-0 p-4">
              <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Name" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label fw-bold">Email</label>
                  <input type="email" name="" id="agama" class="form-control" placeholder="Masukkan Email" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label fw-bold">Password</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" value="{{ old('password') }}" required>
                </div>
                <div class="mb-3">
                  <label for="konfirmasi-password" class="form-label fw-bold">Konfirmasi Password</label>
                  <input type="password" name="konfirmasi-password" id="konfirmasi-password" class="form-control" placeholder="Masukkan konfirmasi password" value="{{ old('konfirmasi-password') }}" required>
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