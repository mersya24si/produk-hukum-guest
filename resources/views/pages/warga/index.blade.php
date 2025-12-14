@extends('layouts.guest.app')

@section('content')
    <br><br>
    <main class="container my-5" id="warga">

        <div class="mb-4">
            <a href="{{ url('/dashboard#layanan') }}" class="btn btn-secondary rounded-pill px-4">
                <i class="lni lni-arrow-left me-1"></i> Kembali ke Layanan
            </a>
        </div>

        <div class="text-center mb-5 border-bottom pb-3">
            <h2 class="fw-bold text-logo-accent">Data Warga Desa</h2>
            <p class="text-muted">Berikut adalah daftar warga yang telah terdaftar dalam sistem Bina Desa.</p>
        </div>

        <div class="table-responsive">
            <form method="GET" action="{{ route('warga.index') }}" class="mb-4">
                <div class="row align-items-end justify-content-center">
                    {{-- Search Input --}}
                    <div class="col-md-6 col-lg-4">
                        <label for="search_input" class="form-label visually-hidden">Cari Warga</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control rounded-start-pill" id="search_input"
                                value="{{ request('search') }}" placeholder="Cari Nama/No. KTP/Pekerjaan"
                                aria-label="Search">

                            @if (request('search'))
                                {{-- Tombol Clear Search --}}
                                <a href="{{ route('warga.index', array_merge(request()->except('search', 'page'), ['search' => null])) }}"
                                    class="btn btn-outline-secondary" id="clear-search" title="Hapus Pencarian" style="height: 40px;">
                                    &times;
                                </a>
                            @endif

                            {{-- Tombol Submit Search (Menggunakan warna logo) --}}
                            <button type="submit" class="btn btn-logo-primary rounded-end-pill" id="basic-addon2" title="Cari" style="height: 40px;">
                                <i class="lni lni-search"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Filter Jenis Kelamin --}}
                    <div class="col-md-3 col-lg-2 mb-3 mb-md-0">
                        <label for="jenis_kelamin_filter" class="form-label visually-hidden">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin_filter" class="form-select rounded-pill"
                            onchange="this.form.submit()">
                            <option value="">-- J. Kelamin --</option>
                            <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
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
                <div class="row g-4 mt-4">
                    @foreach ($dataWarga as $item)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card border-0 rounded-4 h-100 service-card-hover">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-logo-accent mb-3 d-flex align-items-center">
                                        <i class="lni lni-user me-2" style="font-size: 1.2em;"></i>
                                        {{ $item->nama }}
                                    </h5>
                                    <ul class="list-unstyled mb-0 small text-muted">
                                        <li><strong class="text-dark">No. KTP:</strong> {{ $item->no_ktp }}</li>
                                        <li><strong class="text-dark">J. Kelamin:</strong> {{ $item->jenis_kelamin }}</li>
                                        <li><strong class="text-dark">Agama:</strong> {{ $item->agama }}</li>
                                        <li><strong class="text-dark">Pekerjaan:</strong> {{ $item->pekerjaan }}</li>
                                        <li><strong class="text-dark">Telepon:</strong> {{ $item->telp }}</li>
                                        <li><strong class="text-dark">Email:</strong> {{ $item->email }}</li>
                                    </ul>
                                </div>

                                {{-- Tombol Aksi Admin --}}
                                @if (Auth::check() && Auth::user()->role === 'Admin')
                                    <div class="card-footer bg-light border-top d-flex justify-content-between p-3">
                                        <a href="{{ route('warga.edit', $item->warga_id) }}"
                                            class="btn btn-warning btn-sm flex-fill me-2 rounded-pill">
                                            <i class="lni lni-pencil"></i> Edit
                                        </a>

                                        <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus data ini? Tindakan ini tidak dapat dibatalkan.')"
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
                    {{ $dataWarga->links('pagination::simple-bootstrap-5') }}
                </div>
            @else
                {{-- Jika data kosong --}}
                <div class="alert alert-info text-center mt-4 p-4 rounded-4 service-card-hover">
                    <i class="lni lni-information me-2"></i>
                    <p class="mb-0 fw-bold">Tidak ada data warga yang ditemukan sesuai kriteria pencarian.</p>
                </div>
            @endif


            <div class="text-end mt-5">
                <a href="{{ route('warga.create') }}" class="btn btn-logo-primary shadow-lg rounded-pill px-4 py-2 btn-hover">
                    <i class="lni lni-plus me-1"></i> Tambah Data Warga
                </a>
            </div>
        </div>
    </main>
@endsection
