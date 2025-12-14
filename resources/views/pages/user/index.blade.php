@extends('layouts.guest.app')

@section('content')
    <br><br>

    <main class="container my-5" id="user">

        <div class="mb-4">
            <a href="{{ url('/dashboard#layanan') }}" class="btn btn-secondary rounded-pill px-4">
                <i class="lni lni-arrow-left me-1"></i> Kembali ke Layanan
            </a>
        </div>

        <div class="text-center mb-5 border-bottom pb-3">
            <h2 class="fw-bold text-logo-accent">Data User</h2>
            <p class="text-muted">Berikut adalah daftar user yang telah terdaftar dalam sistem Bina Desa.</p>
        </div>

        <div class="table-responsive">
            <form method="GET" action="{{ route('user.index') }}" class="mb-4">
                <div class="row align-items-end justify-content-center">

                    {{-- Filter Role (Tambahkan filter Role jika diperlukan, seperti di Warga) --}}
                    {{-- Search Input (Dibuat membulat dan menggunakan warna logo) --}}
                    <div class="col-md-6 col-lg-4">
                        <label for="search_input" class="form-label visually-hidden">Cari User</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control rounded-start-pill" id="search_input"
                                value="{{ request('search') }}" placeholder="Cari Nama atau Email" aria-label="Search">

                            @if (request('search'))
                                {{-- Tombol Clear Search --}}
                                <a href="{{ route('user.index', request()->except('search', 'page')) }}"
                                    class="btn btn-outline-secondary" title="Hapus Pencarian" style="height: 40px;">
                                    &times;
                                </a>
                            @endif

                            {{-- Tombol Submit Search (Menggunakan warna logo) --}}
                            <button type="submit" class="btn btn-logo-primary rounded-end-pill" title="Cari" style="height: 40px;">
                                <i class="lni lni-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div class="alert alert-success text-center mb-4">
                    {{ session('success') }}
                </div>
            @endif


            {{-- Daftar Kartu User --}}
            @if (!$dataUser->isEmpty())
                <div class="row g-4 mt-4">
                    @foreach ($dataUser as $item)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card border-0 rounded-4 h-100 service-card-hover">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-logo-accent mb-3 d-flex align-items-center">
                                        <i class="lni lni-user me-2" style="font-size: 1.2em;"></i>
                                        {{ $item->name }}
                                    </h5>

                                    <ul class="list-unstyled mb-0 small text-muted">
                                        <li><strong class="text-dark">Email:</strong> {{ $item->email }}</li>
                                        <li><strong class="text-dark">Role:</strong>
                                            <span class="badge {{ $item->role == 'Admin' ? 'bg-logo-accent' : 'bg-secondary' }}">{{ $item->role }}</span>
                                        </li>
                                    </ul>

                                    <div class="mt-3">
                                        <p class="card-text text-muted mb-0 small">
                                            <strong class="text-dark">Password (hashed):</strong><br>
                                            <code class="d-block bg-light p-1 rounded-3">{{ Str::limit($item->password, 30, '...') }}</code>
                                        </p>
                                    </div>
                                </div>

                                {{-- Tombol Aksi Admin --}}
                                @if (Auth::check() && Auth::user()->role === 'Admin')
                                    <div class="card-footer bg-light border-top d-flex justify-content-between p-3">
                                        <a href="{{ route('user.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm flex-fill me-2 rounded-pill">
                                            <i class="lni lni-pencil"></i> Edit
                                        </a>

                                        <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus data user {{ $item->name }}? Tindakan ini tidak dapat dibatalkan.')"
                                            class="flex-fill">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100 rounded-pill">
                                                <i class="lni lni-trash-can"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Paginasi --}}
                <div class="mt-5 d-flex justify-content-center">
                    {{ $dataUser->links('pagination::simple-bootstrap-5') }}
                </div>
            @else
                {{-- Jika data kosong --}}
                <div class="alert alert-info text-center mt-4 p-4 rounded-4 service-card-hover">
                    <i class="lni lni-information me-2"></i>
                    <p class="mb-0 fw-bold">Tidak ada data user yang ditemukan sesuai kriteria pencarian.</p>
                </div>
            @endif

            <div class="text-end mt-5">
                <a href="{{ route('user.create') }}" class="btn btn-logo-primary shadow-lg rounded-pill px-4 py-2 btn-hover">
                    <i class="lni lni-plus me-1"></i> Tambah Data User
                </a>
            </div>

        </div>
    </main>
@endsection
