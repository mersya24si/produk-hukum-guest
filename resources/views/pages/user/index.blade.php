@extends('layouts.guest.app')
@section('content')
    <!-- ========================= HERO SECTION ========================= -->
    <br><br>
    <main class="container my-5" id="user">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Data User</h2>
            <p class="text-muted">Berikut adalah daftar user yang telah terdaftar dalam sistem Bina Desa.</p>
        </div>
        <div class="table-responsive">
            <form method="GET" action="{{ route('user.index') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" id="exampleInputIconRight"
                                value="{{ request('search') }}" placeholder="Search" aria-label="Search">
                            <button type="submit" class="input-group-text" id="basic-addon2">
                                <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            @if (request('search'))
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                    class="btn btn-outline-secondary ml-3" id="clear-search"> Clear</a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
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
            <div class="mt-3">
                {{ $dataUser->links('pagination::simple-bootstrap-5') }}
            </div>

            <div class="text-end mt-4">
                <a href="{{ route('user.create') }}" class="btn btn-primary btn-hover">+ Tambah Data User</a>
            </div>
        </div>
    </main>

@endsection
