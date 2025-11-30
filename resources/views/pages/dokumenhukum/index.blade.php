@extends('layouts.guest.app')

@section('content')
    <br><br>

    <main class="container my-5" id="dokumenHukum">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Data Dokumen Hukum</h2>
            <p class="text-muted">Berikut adalah daftar dokumen hukum yang telah terdaftar dalam sistem Bina Desa.</p>
        </div>

        <div class="table-responsive">
            {{-- Form Search & Filter (Sama seperti sebelumnya) --}}
            <form method="GET" action="{{ route('dokumenhukum.index') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-2">
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="">Pilih Status</option>
                            <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search..." aria-label="Search">
                            <button type="submit" class="input-group-text"><i class="fa fa-search"></i></button>
                            @if (request('search'))
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="btn btn-outline-secondary ml-3">Clear</a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($dokumen->isEmpty())
                <div class="text-center text-muted my-5">Belum ada dokumen hukum.</div>
            @else
                <div class="row g-4">
                    @foreach ($dokumen as $item)
                        <div class="col-md-4 col-sm-6">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body">
                                    {{-- JUDUL --}}
                                    <h5 class="card-title fw-bold text-primary">{{ $item->judul }}</h5>

                                    {{-- INFO SINGKAT --}}
                                    <p class="text-muted mb-1"><strong>Nomor:</strong> {{ $item->nomor }}</p>
                                    <p class="text-muted mb-1"><strong>Tanggal:</strong> {{ date('d M Y', strtotime($item->tanggal)) }}</p>
                                    <p class="text-muted mb-1"><strong>Status:</strong>
                                        <span class="badge @if ($item->status == 'diterima') bg-success @elseif($item->status == 'diproses') bg-warning @else bg-danger @endif">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </p>
                                    <p class="card-text mt-2 text-muted" style="font-size: 14px;">
                                        {{ Str::limit($item->ringkasan, 100, '...') }}
                                    </p>

                                    <hr>

                                    {{-- TOMBOL PEMICU MODAL --}}
                                    <div class="mb-3 text-center">
                                        <button type="button" class="btn btn-info btn-sm text-white w-100"
                                                data-bs-toggle="modal"
                                                data-bs-target="#detailModal-{{ $item->dokumen_id }}">
                                            <i class="fa fa-eye"></i> Lihat Detail & Lampiran
                                            @if($item->attachments->count() > 0)
                                                ({{ $item->attachments->count() }})
                                            @endif
                                        </button>
                                    </div>

                                    {{-- ACTION BUTTONS --}}
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('dokumenhukum.edit', $item->dokumen_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('dokumenhukum.destroy', $item->dokumen_id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ========================================== --}}
                        {{--  MODAL POPUP (Diletakkan di dalam Loop)    --}}
                        {{-- ========================================== --}}
                        <div class="modal fade" id="detailModal-{{ $item->dokumen_id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable"> {{-- modal-lg biar lebar --}}
                                <div class="modal-content">

                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title fw-bold text-dark">Detail Dokumen</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        {{-- BAGIAN 1: DATA UTAMA --}}
                                        <div class="row mb-4">
                                            <div class="col-md-12">
                                                <h4 class="text-primary fw-bold">{{ $item->judul }}</h4>
                                                <hr>
                                                <table class="table table-borderless table-sm">
                                                    <tr>
                                                        <th width="20%">Nomor</th>
                                                        <td>: {{ $item->nomor }}</td>
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
                                                        <th>Tanggal</th>
                                                        <td>: {{ date('d F Y', strtotime($item->tanggal)) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status</th>
                                                        <td>:
                                                            <span class="badge @if ($item->status == 'diterima') bg-success @elseif($item->status == 'diproses') bg-warning @else bg-danger @endif">
                                                                {{ ucfirst($item->status) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Ringkasan</th>
                                                        <td class="text-break">: {{ $item->ringkasan }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- BAGIAN 2: LAMPIRAN FILE --}}
                                        <h5 class="fw-bold border-bottom pb-2 mb-3"><i class="fa fa-paperclip"></i> Lampiran File</h5>

                                        @if($item->attachments->count() > 0)
                                            <div class="row g-3">
                                                @foreach($item->attachments as $media)
                                                    <div class="col-md-6">
                                                        <div class="card h-100 border bg-light">
                                                            <div class="card-body text-center p-3">

                                                                {{-- Preview: Jika Gambar --}}
                                                                @if(str_contains($media->mime_type, 'image'))
                                                                    <img src="{{ asset('storage/uploads/dokumen_hukum/' . $media->file_name) }}"
                                                                         class="img-fluid rounded mb-2 shadow-sm"
                                                                         style="height: 150px; object-fit: cover;"
                                                                         alt="Preview">
                                                                @else
                                                                {{-- Preview: Jika Dokumen --}}
                                                                    <div class="py-4 text-secondary">
                                                                        <i class="fa fa-file-text fa-4x"></i>
                                                                        <p class="mt-2 text-xs">Dokumen PDF/DOCX</p>
                                                                    </div>
                                                                @endif

                                                                <h6 class="text-truncate px-2" title="{{ $media->caption }}">
                                                                    {{ $media->caption }}
                                                                </h6>

                                                                <a href="{{ asset('storage/uploads/dokumen_hukum/' . $media->file_name) }}"
                                                                   target="_blank"
                                                                   class="btn btn-primary btn-sm w-100 mt-2">
                                                                    <i class="fa fa-download"></i> Buka / Download
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="alert alert-secondary text-center py-4">
                                                <i class="fa fa-ban fa-2x mb-2 text-muted"></i><br>
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

                <div class="mt-4">
                    {{ $dokumen->links('pagination::simple-bootstrap-5') }}
                </div>
            @endif

            <div class="text-end mt-4">
                <a href="{{ route('dokumenhukum.create') }}" class="btn btn-primary btn-hover">+ Tambah Dokumen</a>
            </div>
        </div>
    </main>
@endsection
