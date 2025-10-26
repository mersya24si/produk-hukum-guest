@extends('layouts.admin.app')
@section('content')
    <!-- ========================= HERO SECTION ========================= -->
    <br><br>
    <main class="container my-5" id="kategori">
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

        @if ($dataKategori->isEmpty())
            <div class="text-center text-muted my-5">
                Belum ada kategori yang dimasukkan.
            </div>
        @else
            <div class="row g-4">
                @foreach ($dataKategori as $item)
                    <div class="col-md-4 col-sm-6">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-primary">{{ $item->nama }}</h5>
                                <p class="card-text text-muted">{{ $item->deskripsi ?: 'Tidak ada deskripsi.' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="text-end mt-4">
            <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-hover">+ Tambah Kategori</a>
        </div>
    </main>

@endsection
