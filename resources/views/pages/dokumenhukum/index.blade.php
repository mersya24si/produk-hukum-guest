@extends('layouts.guest.app')

@section('content')
    <br><br>

    <main class="container my-5" id="dokumenHukum">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Data Dokumen Hukum</h2>
            <p class="text-muted">Berikut adalah daftar dokumen hukum yang telah terdaftar dalam sistem Bina Desa.</p>
        </div>
        <div class="table-responsive">
            <form method="GET" action="{{ route('dokumenhukum.index') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-2">
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="">Pilih Status</option>
                            <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>
                                Diterima
                            </option>
                            <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>
                                Diproses
                            </option>
                            <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>
                                Ditolak</option>
                        </select>
                    </div>
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
        <div class="mt-3">
                    {{ $dokumen->links('pagination::simple-bootstrap-5') }}
                </div>
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
