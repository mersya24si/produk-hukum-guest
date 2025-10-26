@extends('layouts.admin.app')
@section('content')
    <!-- ========================= HERO SECTION ========================= -->
    <main class="container my-5" id="warga">
    <div class="text-center mb-4">
      <h2 class="fw-bold">Data Warga Desa</h2>
      <p class="text-muted">Berikut adalah daftar warga yang telah terdaftar dalam sistem Bina Desa.</p>
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
                <th>No. KTP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Pekerjaan</th>
                <th>Telepon</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              @foreach($dataWarga as $item)
              <tr>
                <td>{{ $item->no_ktp }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jenis_kelamin }}</td>
                <td>{{ $item->agama }}</td>
                <td>{{ $item->pekerjaan }}</td>
                <td>{{ $item->telp }}</td>
                <td>{{ $item->email }}</td>
              </tr>
              @endforeach

              @if($dataWarga->isEmpty())
              <tr>
                <td colspan="9" class="text-center text-muted">Belum ada data warga yang dimasukkan.</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>

        <div class="text-end mt-3">
          <a href="{{ route('warga.create') }}" class="btn btn-primary btn-hover">+ Tambah Data Warga</a>
        </div>
      </div>
    </div>
  </main>
@endsection