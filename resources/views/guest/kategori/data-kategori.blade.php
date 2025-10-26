@extends('layouts.admin.app')
@section('content')
    <!-- ========================= HERO SECTION ========================= -->
    <main class="container my-5" id="warga">
    <div class="text-center mb-4">
      <h2 class="fw-bold">Data Kategori Produk Hukum</h2>
      <p class="text-muted">Berikut adalah daftar kategori yang telah terdaftar dalam sistem Bina Desa.</p>
    </div>
    <div>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
    <div class="card shadow-lg border-0 rounded-3">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-primary text-center">
              <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($dataKategori as $item)
              <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->deskripsi }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="text-end mt-3">
          <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-hover">+ Tambah Kategori</a>
        </div>
      </div>
    </div>
  </main>
@endsection