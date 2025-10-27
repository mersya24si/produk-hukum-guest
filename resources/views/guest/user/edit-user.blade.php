@extends('layouts.admin.app')

@section('content')
<section id="edit-user" class="pt-100 pb-100 bg-light">
  <div class="container">
    <div class="section-title text-center mb-5">
      <h2 class="fw-bold">Edit Data User</h2>
      <p class="text-muted">Ubah data user sesuai kebutuhan.</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow border-0 p-4">
          <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label for="name" class="form-label fw-bold">Nama Lengkap</label>
              <input type="text" name="name" id="name" class="form-control"
                     value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label fw-bold">Email</label>
              <input type="email" name="email" id="email" class="form-control"
                     value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label fw-bold">Password (opsional)</label>
              <input type="password" name="password" id="password" class="form-control"
                     placeholder="Kosongkan jika tidak ingin mengubah password">
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-success">Update</button>
              <a href="{{ route('user.index') }}" class="btn btn-secondary ms-2">Kembali</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
