@extends('layouts.guest.app')

@section('content')
    <br><br>
    <main class="container my-5" id="warga">

        <div class="text-center mb-4">
            <h2 class="fw-bold">Data Warga Desa</h2>
            <p class="text-muted">Berikut adalah daftar warga yang telah terdaftar dalam sistem Bina Desa.</p>
        </div>

        <div class="table-responsive">
            <form method="GET" action="{{ route('warga.index') }}" class="mb-4">
                <div class="row align-items-end">

                    {{-- Filter Jenis Kelamin --}}
                    <div class="col-md-3 col-lg-2 mb-3 mb-md-0">
                        <label for="jenis_kelamin_filter" class="form-label visually-hidden">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin_filter" class="form-select"
                            onchange="this.form.submit()">
                            <option value="">-- Jenis Kelamin --</option>
                            <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>

                    {{-- Search Input --}}
                    <div class="col-md-5 col-lg-4">
                        <label for="search_input" class="form-label visually-hidden">Cari Warga</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" id="search_input"
                                value="{{ request('search') }}" placeholder="Cari Nama/No. KTP/Pekerjaan"
                                aria-label="Search">

                            @if (request('search'))
                                {{-- Tombol Clear Search (Jika ada pencarian aktif) --}}
                                <a href="{{ route('warga.index', array_merge(request()->except('search', 'page'), ['search' => null])) }}"
                                    class="btn btn-outline-secondary" id="clear-search" title="Hapus Pencarian">
                                    &times;
                                </a>
                            @endif

                            {{-- Tombol Submit Search --}}
                            <button type="submit" class="btn btn-primary" id="basic-addon2" title="Cari">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
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


            {{-- Daftar Kartu Warga --}}
            @if (!$dataWarga->isEmpty())
                <div class="row g-4">
                    @foreach ($dataWarga as $item)
                        <div class="col-md-4 col-sm-6">
                            <div class="card shadow-sm border-0 rounded-4 h-100">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-primary mb-3">{{ $item->nama }}</h5>
                                    <ul class="list-unstyled mb-0 small">
                                        <li><strong>No. KTP:</strong> {{ $item->no_ktp }}</li>
                                        <li><strong>Jenis Kelamin:</strong> {{ $item->jenis_kelamin }}</li>
                                        <li><strong>Agama:</strong> {{ $item->agama }}</li>
                                        <li><strong>Pekerjaan:</strong> {{ $item->pekerjaan }}</li>
                                        <li><strong>Telepon:</strong> {{ $item->telp }}</li>
                                        <li><strong>Email:</strong> {{ $item->email }}</li>
                                    </ul>
                                </div>

                                {{-- Tombol Aksi Admin --}}
                                @if (Auth::check() && Auth::user()->role === 'Admin')
                                    <div class="card-footer bg-light border-top d-flex justify-content-between p-3">
                                        <a href="{{ route('warga.edit', $item->warga_id) }}"
                                            class="btn btn-warning btn-sm flex-fill me-2">
                                            Edit
                                        </a>

                                        <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus data ini? Tindakan ini tidak dapat dibatalkan.')"
                                            class="flex-fill">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Paginasi --}}
                <div class="mt-4 d-flex justify-content-center">
                    {{ $dataWarga->links('pagination::simple-bootstrap-5') }}
                </div>
            @else
                {{-- Jika data kosong --}}
                <div class="alert alert-info text-center mt-4">
                    <p class="mb-0">Tidak ada data warga yang ditemukan sesuai kriteria pencarian.</p>
                </div>
            @endif


            <div class="text-end mt-5">
                <a href="{{ route('warga.create') }}" class="btn btn-success shadow-lg rounded-pill px-4 py-2">
                    <i class="fas fa-plus me-1"></i> Tambah Data Warga
                </a>
            </div>
           

        </div>
    </main>
@endsection
