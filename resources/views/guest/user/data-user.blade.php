@extends('layouts.admin.app')
@section('content')
    <!-- ========================= HERO SECTION ========================= -->
    <br><br>
    <main class="container my-5" id="user">
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

        @if ($dataUser->isEmpty())
            <div class="text-center text-muted my-5">
                Belum ada data user yang dimasukkan.
            </div>
        @else
            <div class="row g-4">
                @foreach ($dataUser as $item)
                    <div class="col-md-4 col-sm-6">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body">
                                <h5 class="card-title fw-bold mb-2">{{ $item->name }}</h5>
                                <p class="card-text mb-1"><strong>Email:</strong> {{ $item->email }}</p>
                                <p class="card-text text-muted"><strong>Password (hashed):</strong><br>
                                    <code>{{ Str::limit($item->password, 20, '...') }}</code>
                                </p>
                            </div>
                            <div class="mt-3 d-flex justify-content-between">
                                <a href="{{ route('user.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="text-end mt-4">
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-hover">+ Tambah Data User</a>
        </div>
    </main>

@endsection
