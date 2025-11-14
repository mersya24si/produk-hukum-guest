@extends('layouts.guest.app')

@section('content')
    <br><br>

    <main class="container my-5" id="dokumenHukum">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Data Dokumen Hukum</h2>
            <p class="text-muted">Berikut adalah daftar dokumen hukum yang telah terdaftar dalam sistem Bina Desa.</p>
        </div>

        {{-- ALERT SUCCESS --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        {{-- JIKA DATA KOSONG --}}
        @if ($dokumen->isEmpty())
            <div class="text-center text-muted my-5">
                Belum ada dokumen hukum yang dimasukkan.
            </div>

        @else
            <div class="row g-4">
                @foreach ($dokumen as $item)
                    <div class="col-md-4 col-sm-6">
                        <div class="card shadow-sm border-0 h-100">

                            <div class="card-body">

                                {{-- JUDUL --}}
                                <h5 class="card-title fw-bold text-primary">
                                    {{ $item->judul }}
                                </h5>

                                {{-- INFORMASI SINGKAT --}}
                                <p class="text-muted mb-1"><strong>Nomor:</strong> {{ $item->nomor }}</p>
                                <p class="text-muted mb-1"><strong>Tanggal:</strong> {{ $item->tanggal }}</p>
                                <p class="text-muted mb-1"><strong>Status:</strong>
                                    <span class="
                                        @if($item->status == 'diterima') text-success
                                        @elseif($item->status == 'diproses') text-warning
                                        @elseif($item->status == 'ditolak') text-danger
                                        @endif
                                    ">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </p>

                                <p class="card-text mt-2 text-muted" style="font-size: 14px;">
                                    {{ Str::limit($item->ringkasan, 100, '...') }}
                                </p>

                                {{-- ACTION BUTTON --}}
                                <div class="mt-3 d-flex justify-content-between">
                                    <a href="{{ route('dokumenhukum.edit', $item->dokumen_id) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('dokumenhukum.destroy', $item->dokumen_id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- TOMBOL TAMBAH --}}
        <div class="text-end mt-4">
            <a href="{{ route('dokumenhukum.create') }}" class="btn btn-primary btn-hover">
                + Tambah Dokumen
            </a>
        </div>

    </main>
@endsection
