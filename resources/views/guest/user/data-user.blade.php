@extends('layouts.admin.app')
@section('content')
    <!-- ========================= HERO SECTION ========================= -->
    <main class="container my-5" id="warga">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Data User</h2>
            <p class="text-muted">Berikut adalah daftar user yang telah terdaftar dalam sistem Bina Desa.</p>
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
                                <th>Email</th>
                                <th>Password</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataUser as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->password }}</td>
                                </tr>
                            @endforeach

                            @if ($dataUser->isEmpty())
                                <tr>
                                    <td colspan="9" class="text-center text-muted">Belum ada data user yang dimasukkan.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="text-end mt-3">
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-hover">+ Tambah Data User</a>
                </div>
            </div>
        </div>
    </main>
@endsection
