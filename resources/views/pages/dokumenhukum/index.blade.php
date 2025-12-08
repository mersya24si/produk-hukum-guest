@extends('layouts.guest.app')

@section('content')
    <br><br>
    <main class="container my-5" id="dokumenHukum">

       <div class="mb-4">
            <a href="{{ url('/dashboard#layanan') }}" class="btn btn-secondary rounded-pill px-4">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Layanan
            </a>
        </div>

        <div class="text-center mb-4">
            <h2 class="fw-bold">Data Dokumen Hukum</h2>
            <p class="text-muted">Berikut adalah daftar dokumen hukum yang telah terdaftar dalam sistem Bina Desa.</p>
        </div>

        <div class="mb-4">
            <form method="GET" action="{{ route('dokumenhukum.index') }}">
                <div class="row g-3 align-items-end">

                    {{-- Filter Status --}}
                    <div class="col-md-3 col-lg-2">
                        <label for="status_filter" class="form-label small text-muted mb-1">Filter Status</label>
                        <select name="status" id="status_filter" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    {{-- Search Input --}}
                    <div class="col-md-6 col-lg-4">
                        <label for="search_input" class="form-label small text-muted mb-1">Cari Judul / Nomor</label>
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" id="search_input" class="form-control"
                                value="{{ request('search') }}" placeholder="Cari Judul atau Nomor Dokumen" aria-label="Search">

                            {{-- Tombol Search --}}
                            <button type="submit" class="btn btn-primary" title="Cari">
                                <i class="fas fa-search"></i>
                            </button>

                            @if (request('search') || request('status'))
                                {{-- Tombol Clear Search/Filter (Jika ada parameter aktif) --}}
                                <a href="{{ route('dokumenhukum.index', request()->except('search', 'status', 'page')) }}"
                                    class="btn btn-outline-secondary" title="Hapus Filter">
                                    &times;
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive">

            @if (session('success'))
                <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
            @endif

            @if ($dokumen->isEmpty())
                <div class="alert alert-info text-center my-5">
                    <i class="fas fa-info-circle me-1"></i> Tidak ada dokumen hukum yang ditemukan.
                </div>
            @else
                <div class="row g-4">
                    @foreach ($dokumen as $item)
                        <div class="col-md-4 col-sm-6">
                            <div class="card shadow-sm border-0 rounded-4 h-100 d-flex flex-column">
                                <div class="card-body pb-2">

                                    {{-- JUDUL --}}
                                    <h5 class="card-title fw-bold text-primary mb-3">
                                        <i class="fas fa-scroll me-2"></i> {{ $item->judul }}
                                    </h5>

                                    {{-- INFO SINGKAT --}}
                                    <ul class="list-unstyled small mb-3">
                                        <li><strong>Nomor:</strong> {{ $item->nomor }}</li>
                                        <li><strong>Tanggal:</strong> {{ date('d M Y', strtotime($item->tanggal)) }}</li>
                                        <li><strong>Jenis:</strong> {{ $item->jenis ? $item->jenis->nama_jenis : '-' }}</li>
                                        <li><strong>Kategori:</strong> {{ $item->kategori ? $item->kategori->nama : '-' }}</li>
                                        <li><strong>Status:</strong>
                                            @php
                                                $statusClass = [
                                                    'diterima' => 'bg-success',
                                                    'diproses' => 'bg-warning text-dark',
                                                    'ditolak' => 'bg-danger',
                                                ][$item->status] ?? 'bg-secondary';
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ ucfirst($item->status) }}</span>
                                        </li>
                                    </ul>

                                    {{-- RINGKASAN --}}
                                    <p class="card-text text-muted fst-italic border-top pt-2" style="font-size: 13px;">
                                        {{ Str::limit($item->ringkasan, 120, '...') }}
                                    </p>

                                </div>

                                {{-- CARD FOOTER: DETAIL & ACTIONS --}}
                                <div class="card-footer bg-white border-top p-3 d-flex flex-column gap-2">

                                    {{-- TOMBOL PEMICU MODAL --}}
                                    <button type="button" class="btn btn-info btn-sm text-white w-100"
                                            data-bs-toggle="modal" data-bs-target="#detailModal-{{ $item->dokumen_id }}">
                                        <i class="fas fa-eye me-1"></i> Lihat Detail & Lampiran
                                        @if($item->attachments->count() > 0)
                                            ({{ $item->attachments->count() }})
                                        @endif
                                    </button>

                                    {{-- ACTION BUTTONS --}}
                                @if (Auth::check() && Auth::user()->role === 'Admin')
                                    <div class="d-flex justify-content-between gap-2 mt-1">
                                        <a href="{{ route('dokumenhukum.edit', $item->dokumen_id) }}"
                                            class="btn btn-warning btn-sm flex-fill">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('dokumenhukum.destroy', $item->dokumen_id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus dokumen {{ $item->judul }}? Tindakan ini tidak dapat dibatalkan.')"
                                            class="flex-fill">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div>

                        {{-- ========================================== --}}
                        {{--  MODAL POPUP (Diletakkan di dalam Loop)    --}}
                        {{-- ========================================== --}}
                        <div class="modal fade" id="detailModal-{{ $item->dokumen_id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">

                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title fw-bold"><i class="fas fa-info-circle me-2"></i> Detail Dokumen Hukum</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">

                                        <h4 class="text-dark fw-bold mb-3">{{ $item->judul }}</h4>

                                        {{-- BAGIAN 1: DATA UTAMA --}}
                                        <h6 class="fw-bold text-secondary border-bottom pb-1 mb-3">Informasi Utama</h6>
                                        <table class="table table-sm table-borderless small">
                                            <tbody>
                                                <tr>
                                                    <th width="20%">Nomor Dokumen</th>
                                                    <td>: **{{ $item->nomor }}**</td>
                                                </tr>
                                                <tr>
                                                    <th>Jenis</th>
                                                    <td>: {{ $item->jenis ? $item->jenis->nama_jenis : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Kategori</th>
                                                    <td>: {{ $item->kategori ? $item->kategori->nama : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Penerbitan</th>
                                                    <td>: {{ date('d F Y', strtotime($item->tanggal)) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>:
                                                        <span class="badge {{ $statusClass }}">
                                                            {{ ucfirst($item->status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <h6 class="fw-bold text-secondary border-bottom pb-1 mb-3 mt-4">Ringkasan Dokumen</h6>
                                        <p class="alert alert-light">{{ $item->ringkasan ?: 'Tidak ada ringkasan yang tersedia.' }}</p>


                                        {{-- BAGIAN 2: LAMPIRAN FILE --}}
                                        <h5 class="fw-bold border-bottom pb-2 mb-3 mt-4"><i class="fas fa-paperclip me-2"></i> Lampiran File</h5>

                                        @if($item->attachments->count() > 0)
                                            <div class="row g-3">
                                                @foreach($item->attachments as $media)
                                                    <div class="col-md-6">
                                                        <div class="card h-100 border bg-light">
                                                            <div class="card-body text-center p-3">

                                                                {{-- Preview: Ikon Dokumen --}}
                                                                @php
                                                                    $fileIcon = 'fa-file-alt'; // default
                                                                    if (str_contains($media->mime_type, 'pdf')) $fileIcon = 'fa-file-pdf';
                                                                    elseif (str_contains($media->mime_type, 'word')) $fileIcon = 'fa-file-word';
                                                                    elseif (str_contains($media->mime_type, 'image')) $fileIcon = 'fa-file-image';
                                                                @endphp
                                                                <div class="py-3 text-secondary">
                                                                    <i class="fas {{ $fileIcon }} fa-4x"></i>
                                                                </div>

                                                                <h6 class="text-truncate px-2 mb-2" title="{{ $media->caption }}">
                                                                    {{ $media->caption ?: $media->file_name }}
                                                                </h6>
                                                                <p class="text-muted small mb-3">({{ strtoupper(pathinfo($media->file_name, PATHINFO_EXTENSION)) }} - {{ round($media->size / 1024, 2) }} KB)</p>

                                                                <a href="{{ asset('storage/uploads/dokumen_hukum/' . $media->file_name) }}"
                                                                    target="_blank"
                                                                    class="btn btn-primary btn-sm w-100 mt-2">
                                                                    <i class="fas fa-download me-1"></i> Buka / Download
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="alert alert-secondary text-center py-4">
                                                <i class="fas fa-ban fa-2x mb-2 text-muted"></i><br>
                                                Tidak ada lampiran pada dokumen ini.
                                            </div>
                                        @endif
                                    </div>

                                    <div class="modal-footer bg-light">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- END MODAL --}}

                    @endforeach
                </div>

                {{-- Paginasi --}}
                <div class="mt-4 d-flex justify-content-center">
                    {{ $dokumen->links('pagination::simple-bootstrap-5') }}
                </div>
            @endif

            <div class="text-end mt-5">
                <a href="{{ route('dokumenhukum.create') }}" class="btn btn-success shadow-lg rounded-pill px-4 py-2">
                    <i class="fas fa-plus me-1"></i> Tambah Dokumen Hukum
                </a>
            </div>
        </div>
    </main>
@endsection
