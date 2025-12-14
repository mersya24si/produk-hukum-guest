@extends('layouts.guest.app')

@section('content')
    <br><br>
    <main class="container my-5" id="lampiranDokumen">

        <div class="mb-4 d-flex justify-content-between align-items-center">
            <a href="{{ url('/dashboard#layanan') }}" class="btn btn-secondary rounded-pill px-4">
                <i class="lni lni-arrow-left me-1"></i> Kembali ke Layanan
            </a>

        </div>

        <div class="text-center mb-5 border-bottom pb-3">
            <h2 class="fw-bold text-logo-accent">Data Lampiran Dokumen</h2>
            <p class="text-muted">Berikut adalah daftar semua file lampiran dokumen yang terdaftar dalam sistem.</p>
        </div>

        <div class="mb-4">
            {{-- Form Pencarian disederhanakan karena Lampiran Dokumen hanya punya kolom 'keterangan' --}}
            <form method="GET" action="{{ route('lampirandokumen.index') }}">
                <div class="row g-3 align-items-end justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <label for="search_input" class="form-label small text-muted mb-1">Cari Keterangan</label>
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" id="search_input" class="form-control rounded-start-pill"
                                value="{{ request('search') }}" placeholder="Cari berdasarkan Keterangan"
                                aria-label="Search">
                            <button type="submit" class="btn btn-logo-primary" title="Cari">
                                <i class="lni lni-search"></i>
                            </button>
                            @if (request('search'))
                                <a href="{{ route('lampirandokumen.index', request()->except('search', 'page')) }}"
                                    class="btn btn-outline-secondary rounded-end-pill" title="Hapus Filter">
                                    &times;
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div>
            @if (session('success'))
                <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
            @endif

            {{-- Menggunakan variabel $lampiran dari controller --}}
            @if ($lampiran->isEmpty())
                <div class="alert alert-info text-center my-5 p-4 rounded-4 service-card-hover">
                    <i class="lni lni-information me-1"></i> Tidak ada lampiran dokumen yang ditemukan.
                </div>
            @else
                <div class="row g-4 mt-4">
                    {{-- Loop menggunakan variabel $lampiran --}}
                    @foreach ($lampiran as $item)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card border-0 rounded-4 h-100 service-card-hover d-flex flex-column">
                                <div class="card-body pb-2">

                                    {{-- JUDUL/KETERANGAN --}}
                                    <h5 class="card-title fw-bold text-logo-accent mb-3 d-flex align-items-center">
                                        <i class="lni lni-paperclip me-2"></i>
                                        {{-- Jika keterangan kosong, tampilkan ID dan Dokumen Terkait --}}
                                        {{ $item->keterangan ?: 'Lampiran ID #' . $item->lampiran_id }}
                                    </h5>

                                    {{-- INFO SINGKAT --}}
                                    <ul class="list-unstyled small mb-3 text-muted">
                                        <li><strong class="text-dark">Terdaftar pada:</strong>
                                            {{ date('d M Y', strtotime($item->created_at)) }}</li>
                                        <li><strong class="text-dark">Dokumen Terkait:</strong>
                                            {{-- Menampilkan judul dokumen hukum terkait --}}
                                            @if ($item->dokumenHukum)
                                                <span class="text-logo-accent fw-bold">{{ $item->dokumenHukum->judul }}</span>
                                            @else
                                                -
                                            @endif
                                        </li>
                                    </ul>

                                    {{-- RINGKASAN KETERANGAN --}}
                                    <p class="card-text text-muted fst-italic border-top pt-2" style="font-size: 13px;">
                                        Keterangan: {{ Str::limit($item->keterangan ?: 'Tidak ada keterangan', 120, '...') }}
                                    </p>

                                </div>

                                {{-- CARD FOOTER: DETAIL & ACTIONS --}}
                                <div class="card-footer bg-white border-top p-3 d-flex flex-column gap-2 mt-auto">

                                    {{-- TOMBOL LIHAT DETAIL --}}
                                    <button type="button" class="btn btn-info btn-sm text-white w-100 rounded-pill"
                                        data-bs-toggle="modal" data-bs-target="#detailModal-{{ $item->lampiran_id }}">
                                        <i class="lni lni-eye me-1"></i> Lihat File
                                        @if ($item->attachments->count() > 0)
                                            ({{ $item->attachments->count() }})
                                        @else
                                            (0)
                                        @endif
                                    </button>

                                    {{-- ACTION BUTTONS ADMIN --}}
                                    {{-- Hapus logika Auth jika tidak relevan --}}
                                    @if (Auth::check() && Auth::user()->role === 'Admin')
                                        <div class="d-flex justify-content-between gap-2 mt-1">
                                            <a href="{{ route('lampirandokumen.edit', $item->lampiran_id) }}"
                                                class="btn btn-warning btn-sm flex-fill rounded-pill">
                                                <i class="lni lni-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('lampirandokumen.destroy', $item->lampiran_id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin hapus lampiran {{ $item->lampiran_id }}? Ini juga akan menghapus file fisiknya.')"
                                                class="flex-fill">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm w-100 rounded-pill">
                                                    <i class="lni lni-trash-can"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- ========================================== --}}
                        {{-- MODAL POPUP (Diletakkan di dalam Loop) --}}
                        {{-- ========================================== --}}
                        <div class="modal fade" id="detailModal-{{ $item->lampiran_id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">

                                    <div class="modal-header bg-logo-accent text-white">
                                        <h5 class="modal-title fw-bold"><i class="lni lni-paperclip me-2"></i> Detail Lampiran</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">

                                        <h4 class="text-dark fw-bold mb-3">
                                            {{ $item->keterangan ?: 'Lampiran ID #' . $item->lampiran_id }}
                                        </h4>

                                        {{-- BAGIAN 1: DATA UTAMA --}}
                                        <h6 class="fw-bold text-secondary border-bottom pb-1 mb-3">Informasi Lampiran</h6>
                                        <table class="table table-sm table-borderless small">
                                            <tbody>
                                                <tr>
                                                    <th width="30%">Dokumen Terkait</th>
                                                    <td>: <span class="fw-bold text-logo-primary">
                                                        {{ $item->dokumenHukum ? $item->dokumenHukum->judul : '-' }}
                                                    </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Keterangan</th>
                                                    <td>: {{ $item->keterangan ?: 'Tidak ada keterangan spesifik.' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Waktu Input</th>
                                                    <td>: {{ date('d F Y H:i', strtotime($item->created_at)) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        {{-- BAGIAN 2: LAMPIRAN FILE --}}
                                        <h5 class="fw-bold border-bottom pb-2 mb-3 mt-4"><i
                                                class="lni lni-folder-open me-2"></i> File Terlampir (Total: {{ $item->attachments->count() }})
                                        </h5>

                                        @if ($item->attachments->count() > 0)
                                            <div class="row g-3">
                                                @foreach ($item->attachments as $media)
                                                    <div class="col-md-6">
                                                        <div class="card h-100 border service-card-hover">
                                                            <div class="card-body text-center p-3">

                                                                {{-- Preview: Ikon Dokumen --}}
                                                                @php
                                                                    $fileIcon = 'lni-files'; // default
                                                                    if (str_contains($media->mime_type, 'pdf')) {
                                                                        $fileIcon = 'lni-file-pdf';
                                                                    } elseif (str_contains($media->mime_type, 'word')) {
                                                                        $fileIcon = 'lni-file-xml';
                                                                    } elseif (str_contains($media->mime_type, 'image')) {
                                                                        $fileIcon = 'lni-image';
                                                                    }
                                                                @endphp
                                                                <div class="py-3 text-logo-accent"> <i
                                                                        class="lni {{ $fileIcon }}"
                                                                        style="font-size: 3em;"></i>
                                                                </div>

                                                                <h6 class="text-truncate px-2 mb-2 fw-bold"
                                                                    title="{{ $media->caption }}">
                                                                    {{ $media->caption ?: $media->file_name }}
                                                                </h6>
                                                                <p class="text-muted small mb-3">
                                                                    ({{ strtoupper(pathinfo($media->file_name, PATHINFO_EXTENSION)) }}
                                                                    - {{ round($media->size / 1024, 2) }} KB)</p>

                                                                {{-- PERUBAHAN PATH DOWNLOAD --}}
                                                                <a href="{{ asset('storage/uploads/lampiran_dokumen/' . $media->file_name) }}"
                                                                    target="_blank"
                                                                    class="btn btn-logo-primary btn-sm w-100 mt-2 rounded-pill">
                                                                    <i class="lni lni-download me-1"></i> Buka / Download
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="alert alert-light text-center py-5 rounded-3 border">
                                                <div class="text-secondary mb-3">
                                                    <i class="lni lni-file-search" style="font-size: 4em;"></i>
                                                </div>
                                                <h6 class="mb-0 text-muted">Tidak ada file yang terlampir pada lampiran ini.</h6>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="modal-footer bg-light">
                                        <button type="button" class="btn btn-secondary rounded-pill"
                                            data-bs-dismiss="modal">Tutup</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- END MODAL --}}
                    @endforeach
                </div>

                {{-- Paginasi --}}
                <div class="mt-5 d-flex justify-content-center">
                    {{ $lampiran->links('pagination::simple-bootstrap-5') }}
                </div>
            @endif
            <div class="text-end mt-5">
                <a href="{{ route('lampirandokumen.create') }}"
                    class="btn btn-logo-primary shadow-lg rounded-pill px-4 py-2 btn-hover">
                    <i class="lni lni-plus me-1"></i> Tambah Lampiran Dokumen
                </a>
            </div>
        </div>
    </main>
@endsection
