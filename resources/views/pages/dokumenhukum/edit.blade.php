@extends('layouts.guest.app')

@section('content')
<section id="form" class="pt-100 pb-100 bg-light">
    <div class="container">

        <div class="section-title text-center mb-5">
            <h2 class="fw-bold">Edit Dokumen Hukum</h2>
            <p class="text-muted">Perbarui data dokumen dan kelola lampiran file.</p>
        </div>

        <div class="row justify-content-center">

            {{-- KOLOM KIRI: FORM EDIT DATA --}}
            <div class="col-lg-7 mb-4">
                <div class="card shadow border-0 p-4 h-100">
                    <h5 class="fw-bold mb-3 text-primary">Form Perubahan Data</h5>
                    <hr>

                    {{-- Form Update (enctype wajib ada untuk upload file baru) --}}
                    <form action="{{ route('dokumenhukum.update', $dokumen->dokumen_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jenis Dokumen</label>
                                <select name="jenis_id" class="form-select" required>
                                    @foreach ($jenis as $j)
                                        <option value="{{ $j->jenis_id }}" {{ $dokumen->jenis_id == $j->jenis_id ? 'selected' : '' }}>
                                            {{ $j->nama_jenis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kategori</label>
                                <select name="kategori_id" class="form-select" required>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->kategori_id }}" {{ $dokumen->kategori_id == $k->kategori_id ? 'selected' : '' }}>
                                            {{ $k->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor</label>
                            <input type="text" name="nomor" class="form-control" value="{{ $dokumen->nomor }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul</label>
                            <input type="text" name="judul" class="form-control" value="{{ $dokumen->judul }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ $dokumen->tanggal }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Ringkasan</label>
                            <textarea name="ringkasan" class="form-control" rows="3" required>{{ $dokumen->ringkasan }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="diproses" {{ $dokumen->status=='diproses'?'selected':'' }}>Diproses</option>
                                <option value="ditolak" {{ $dokumen->status=='ditolak'?'selected':'' }}>Ditolak</option>
                                <option value="diterima" {{ $dokumen->status=='diterima'?'selected':'' }}>Diterima</option>
                            </select>
                        </div>

                        {{-- INPUT FILE BARU --}}
                        <div class="mb-4 p-3 bg-light border rounded">
                            <label class="form-label fw-bold text-success">+ Tambah Lampiran Baru</label>
                            <input type="file" name="files[]" class="form-control" multiple>
                            <div class="form-text text-muted">
                                Biarkan kosong jika tidak ingin menambah file.
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-hover fw-bold py-2">Simpan Perubahan</button>
                            <a href="{{ route('dokumenhukum.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        </div>

                    </form>
                </div>
            </div>

            {{-- KOLOM KANAN: LIST FILE LAMA --}}
            <div class="col-lg-5 mb-4">
                <div class="card shadow border-0 p-4 h-100">
                    <h5 class="fw-bold mb-3 text-secondary">Kelola Lampiran</h5>
                    <hr>

                    @if($dokumen->attachments->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($dokumen->attachments as $media)
                                <div class="list-group-item d-flex align-items-center justify-content-between px-0 py-3">

                                    {{-- Info File --}}
                                    <div class="d-flex align-items-center" style="overflow: hidden;">
                                        <div class="me-3 text-center" style="min-width: 40px;">
                                            @if(str_contains($media->mime_type, 'image'))
                                                <img src="{{ asset('storage/uploads/dokumen_hukum/' . $media->file_name) }}"
                                                     class="rounded shadow-sm" style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <i class="fa fa-file-text text-primary fs-3"></i>
                                            @endif
                                        </div>
                                        <div style="overflow: hidden;">
                                            <h6 class="mb-0 text-truncate" title="{{ $media->caption }}" style="font-size: 14px;">
                                                {{ $media->caption }}
                                            </h6>
                                            <a href="{{ asset('storage/uploads/dokumen_hukum/' . $media->file_name) }}"
                                               target="_blank" class="text-decoration-none small text-info">
                                               Lihat File
                                            </a>
                                        </div>
                                    </div>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('dokumenhukum.deleteMedia', $media->media_id) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus file ini?');" class="ms-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus File">
                                            <i class="fa fa-trash">X</i>
                                        </button>
                                    </form>

                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-secondary text-center py-5">
                            <i class="fa fa-folder-open fa-3x mb-3 text-muted"></i>
                            <p class="mb-0">Belum ada lampiran.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
