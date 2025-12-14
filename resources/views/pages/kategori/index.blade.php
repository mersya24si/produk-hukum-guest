@extends('layouts.guest.app')

@section('content')
    <br><br>
    <main class="container my-5" id="kategori">

        <div class="mb-4">
            <a href="{{ url('/dashboard#layanan') }}" class="btn btn-secondary rounded-pill px-4">
                <i class="lni lni-arrow-left me-1"></i> Kembali ke Layanan
            </a>
        </div>

        <div class="text-center mb-5 border-bottom pb-3">
            <h2 class="fw-bold text-logo-accent">Data Kategori Produk Hukum</h2>
            <p class="text-muted">Berikut adalah daftar kategori yang telah terdaftar dalam sistem Bina Desa.</p>
        </div>

        <div class="table-responsive">
            <form method="GET" action="{{ route('kategori.index') }}" class="mb-4">
                <div class="row align-items-end justify-content-center">

                    {{-- Search Input (Dibuat membulat dan menggunakan warna logo) --}}
                    <div class="col-md-6 col-lg-4">
                        <label for="search_input" class="form-label visually-hidden">Cari Kategori</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control rounded-start-pill" id="search_input"
                                value="{{ request('search') }}" placeholder="Cari Nama Kategori" aria-label="Search">

                            @if (request('search'))
                                {{-- Tombol Clear Search --}}
                                <a href="{{ route('kategori.index', request()->except('search', 'page')) }}"
                                    class="btn btn-outline-secondary" title="Hapus Pencarian" style="height: 40px;">
                                    &times;
                                </a>
                            @endif

                            {{-- Tombol Submit Search --}}
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


            {{-- Daftar Kartu Kategori --}}
            @if (!$dataKategori->isEmpty())
                <div class="row g-4 mt-4">
                    @foreach ($dataKategori as $item)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card border-0 rounded-4 h-100 service-card-hover">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-logo-accent mb-2 d-flex align-items-center">
                                        <i class="lni lni-folder me-2" style="font-size: 1.2em;"></i> {{ $item->nama }}
                                    </h5>
                                    <p class="card-text text-muted small">
                                        {{ $item->deskripsi ?: 'Tidak ada deskripsi yang tersedia untuk kategori ini.' }}
                                    </p>
                                </div>

                                {{-- Tombol Aksi Admin --}}
                                @if (Auth::check() && Auth::user()->role === 'Admin')
                                    <div class="card-footer bg-light border-top d-flex justify-content-between p-3">
                                        <a href="{{ route('kategori.edit', $item->kategori_id) }}"
                                            class="btn btn-warning btn-sm flex-fill me-2 rounded-pill">
                                            <i class="lni lni-pencil"></i> Edit
                                        </a>

                                        <form action="{{ route('kategori.destroy', $item->kategori_id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus kategori {{ $item->nama }}? Tindakan ini tidak dapat dibatalkan.')"
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
                    {{ $dataKategori->links('pagination::simple-bootstrap-5') }}
                </div>

            @else
                {{-- Jika data kosong --}}
                <div class="alert alert-info text-center mt-4 p-4 rounded-4 service-card-hover">
                    <i class="lni lni-information me-2"></i>
                    <p class="mb-0 fw-bold">Tidak ada kategori produk hukum yang ditemukan.</p>
                </div>
            @endif

            <div class="text-end mt-5">
                <a href="{{ route('kategori.create') }}" class="btn btn-logo-primary shadow-lg rounded-pill px-4 py-2 btn-hover">
                    <i class="lni lni-plus me-1"></i> Tambah Kategori
                </a>
            </div>

        </div>
    </main>

@endsection
