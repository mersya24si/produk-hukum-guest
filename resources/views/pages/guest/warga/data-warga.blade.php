@extends('layouts.admin.app')
@section('content')
    <!-- ========================= HERO SECTION ========================= -->
    <br><br>
    <main class="container my-5" id="warga">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Data Warga Desa</h2>
            <p class="text-muted">Berikut adalah daftar warga yang telah terdaftar dalam sistem Bina Desa.</p>
        </div>

        {{-- ✅ Notifikasi sukses --}}
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        {{-- ✅ Jika data ada --}}
        @if (!$dataWarga->isEmpty())
            <div class="row g-4">
                @foreach ($dataWarga as $item)
                    <div class="col-md-4 col-sm-6">
                        <div class="card shadow-sm border-0 rounded-4 h-100">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $item->nama }}</h5>
                                <p class="card-text mb-1"><strong>No. KTP:</strong> {{ $item->no_ktp }}</p>
                                <p class="card-text mb-1"><strong>Jenis Kelamin:</strong> {{ $item->jenis_kelamin }}</p>
                                <p class="card-text mb-1"><strong>Agama:</strong> {{ $item->agama }}</p>
                                <p class="card-text mb-1"><strong>Pekerjaan:</strong> {{ $item->pekerjaan }}</p>
                                <p class="card-text mb-1"><strong>Telepon:</strong> {{ $item->telp }}</p>
                                <p class="card-text mb-0"><strong>Email:</strong> {{ $item->email }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- ✅ Jika data kosong --}}
            <div class="text-center text-muted mt-4">
                <p>Belum ada data warga yang dimasukkan.</p>
            </div>
        @endif

        <div class="text-end mt-4">
            <a href="{{ route('warga.create') }}" class="btn btn-primary shadow-sm rounded-pill px-4 py-2">
                + Tambah Data Warga
            </a>
        </div>
    </main>

@endsection
