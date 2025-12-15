@extends('layouts.guest.app')

@section('content')
    <br><br>

    <section id="form-edit-user" class="pt-100 pb-100 bg-light">
        <div class="container">

            <div class="mb-4">
                <a href="{{ route('user.index') }}" class="btn btn-secondary rounded-pill px-4">
                    <i class="lni lni-arrow-left me-1"></i> Kembali ke Daftar User
                </a>
            </div>

            <div class="section-title text-center mb-5 border-bottom pb-3">
                <h2 class="fw-bold text-logo-accent">Edit Data User</h2>
                <p class="text-muted">Ubah data user **{{ $user->name }}** sesuai kebutuhan.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 p-5 service-card-hover rounded-4">

                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">

                                <div class="col-md-12">
                                    <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" class="form-control rounded-pill"
                                        value="{{ old('name', $user->name) }}" required>
                                    @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="email" name="email" id="email" class="form-control rounded-pill"
                                        value="{{ old('email', $user->email) }}" required>
                                    @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="role" class="form-label fw-bold">Role Pengguna</label>
                                    <select id="role" name="role" class="form-select rounded-pill" required>
                                        <option value="">-- Pilih Role --</option>
                                        @php
                                            $roleOptions = ['Admin', 'Warga'];
                                            $selectedRole = old('role', $user->role);
                                        @endphp
                                        @foreach ($roleOptions as $option)
                                            <option value="{{ $option }}" {{ $selectedRole == $option ? 'selected' : '' }}>
                                                {{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password" class="form-label fw-bold">Password Baru (opsional)</label>
                                    <input type="password" name="password" id="password" class="form-control rounded-pill"
                                        placeholder="Kosongkan jika tidak ingin mengubah password">
                                    <small class="text-muted">Isi hanya jika Anda ingin mengganti password.</small>
                                    @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-pill"
                                        placeholder="Ulangi password baru">
                                </div>

                                <div class="col-12 d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-logo-primary btn-hover rounded-pill px-4 me-2">
                                        <i class="lni lni-save me-1"></i> Update Data
                                    </button>
                                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
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
