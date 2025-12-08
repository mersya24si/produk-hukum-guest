@extends('layouts.guest.app')

@section('content')
    <br><br>
    <main class="container my-5" id="jenisdokumen">

        <div class="mb-4">
            <a href="{{ url('/dashboard#layanan') }}" class="btn btn-secondary rounded-pill px-4">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Layanan
            </a>
        </div>

        <div class="text-center mb-4">
            <h2 class="fw-bold">Data Jenis Dokumen Produk Hukum</h2>
            <p class="text-muted">Berikut adalah daftar jenis dokumen produk hukum yang telah terdaftar dalam sistem Bina Desa.</p>
        </div>

        <div class="table-responsive">
            <form method="GET" action="{{ route('jenisdokumen.index') }}" class="mb-4">
                <div class="row align-items-end">

                    {{-- Search Input --}}
                    <div class="col-md-5 col-lg-4">
                        <label for="search_input" class="form-label visually-hidden">Cari Jenis Dokumen</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" id="search_input"
                                value="{{ request('search') }}" placeholder="Cari Nama Jenis Dokumen" aria-label="Search">

                            @if (request('search'))
                                {{-- Tombol Clear Search (Jika ada pencarian aktif) --}}
                                <a href="{{ route('jenisdokumen.index', request()->except('search', 'page')) }}"
                                    class="btn btn-outline-secondary" title="Hapus Pencarian">
                                    &times;
                                </a>
                            @endif

                            {{-- Tombol Submit Search (Menggunakan ikon Bootstrap) --}}
                            <button type="submit" class="btn btn-primary" title="Cari">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
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


            {{-- Daftar Kartu Jenis Dokumen --}}
            @if (!$dataJenis->isEmpty())
                <div class="row g-4">
                    @foreach ($dataJenis as $item)
                        <div class="col-md-4 col-sm-6">
                            <div class="card shadow-sm border-0 rounded-4 h-100">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-primary mb-2">
                                        <i class="fas fa-file-alt me-2"></i> {{ $item->nama_jenis }}
                                    </h5>
                                    <p class="card-text text-muted">
                                        {{ $item->deskripsi ?: 'Tidak ada deskripsi yang tersedia untuk jenis dokumen ini.' }}
                                    </p>
                                </div>

                                {{-- Tombol Aksi Admin --}}
                             @if (Auth::check() && Auth::user()->role === 'Admin')
                                <div class="card-footer bg-light border-top d-flex justify-content-between p-3">
                                    <a href="{{ route('jenisdokumen.edit', $item->jenis_id) }}"
                                        class="btn btn-warning btn-sm flex-fill me-2">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>

                                    <form action="{{ route('jenisdokumen.destroy', $item->jenis_id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus jenis dokumen {{ $item->nama_jenis }}? Tindakan ini tidak dapat dibatalkan.')"
                                        class="flex-fill">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            <i class="fas fa-trash me-1"></i> Hapus
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
                    {{ $dataJenis->links('pagination::simple-bootstrap-5') }}
                </div>

            @else
                {{-- Jika data kosong --}}
                <div class="alert alert-info text-center mt-4">
                    <p class="mb-0">Tidak ada jenis dokumen produk hukum yang ditemukan.</p>
                </div>
            @endif

            <div class="text-end mt-5">
                <a href="{{ route('jenisdokumen.create') }}" class="btn btn-success shadow-lg rounded-pill px-4 py-2">
                    <i class="fas fa-plus me-1"></i> Tambah Jenis Dokumen
                </a>
            </div>

        </div>
    </main>

@endsection
