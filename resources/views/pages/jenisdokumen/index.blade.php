@extends('layouts.guest.app')
@section('content')
    <!-- ========================= HERO SECTION ========================= -->
    <br><br>
    <main class="container my-5" id="kategori">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Data Jenis Dokumen Produk Hukum</h2>
            <p class="text-muted">Berikut adalah daftar kategori yang telah terdaftar dalam sistem Bina Desa.</p>
        </div>

        <div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        @if ($dataJenis->isEmpty())
            <div class="text-center text-muted my-5">
                Belum ada kategori yang dimasukkan.
            </div>
        @else
            <div class="row g-4">
                @foreach ($dataJenis as $item)
                    <div class="col-md-4 col-sm-6">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-primary">{{ $item->nama_jenis }}</h5>
                                <p class="card-text text-muted">{{ $item->deskripsi ?: 'Tidak ada deskripsi.' }}</p>
                                                       <div class="mt-3 d-flex justify-content-between">
                                <a href="{{ route('jenisdokumen.edit', $item->jenis_id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('jenisdokumen.destroy', $item->jenis_id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div> </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="text-end mt-4">
            <a href="{{ route('jenisdokumen.create') }}" class="btn btn-primary btn-hover">+ Tambah Jenis Dokumen</a>
        </div>
    </main>

@endsection
