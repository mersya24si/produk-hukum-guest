@extends('layouts.guest.app')

@section('content')
    <br><br>

    <section id="form-edit-dokumen" class="pt-100 pb-100 bg-light">
        <div class="container">

            <div class="mb-4">
                <a href="{{ route('dokumenhukum.index') }}" class="btn btn-secondary rounded-pill px-4">
                    <i class="lni lni-arrow-left me-1"></i> Kembali ke Daftar Dokumen
                </a>
            </div>

            <div class="section-title text-center mb-5 border-bottom pb-3">
                <h2 class="fw-bold text-logo-accent">Edit Dokumen Hukum</h2>
                <p class="text-muted">Perbarui data dokumen dan kelola lampiran file untuk dokumen: **{{ $dokumen->judul }}**.</p>
            </div>

            <div class="row justify-content-center g-4">

                {{-- KOLOM KIRI: FORM EDIT DATA UTAMA --}}
                <div class="col-lg-7">
                    <div class="card border-0 p-5 service-card-hover rounded-4 h-100">
                        <h5 class="fw-bold mb-3 text-logo-accent border-bottom pb-2"><i class="lni lni-pencil me-2"></i> Form Perubahan Data</h5>

                        <form action="{{ route('dokumenhukum.update', $dokumen->dokumen_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Jenis Dokumen</label>
                                    <select name="jenis_id" class="form-select rounded-pill" required>
                                        @foreach ($jenis as $j)
                                            <option value="{{ $j->jenis_id }}" {{ $dokumen->jenis_id == $j->jenis_id ? 'selected' : '' }}>
                                                {{ $j->nama_jenis }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Kategori</label>
                                    <select name="kategori_id" class="form-select rounded-pill" required>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->kategori_id }}" {{ $dokumen->kategori_id == $k->kategori_id ? 'selected' : '' }}>
                                                {{ $k->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nomor</label>
                                    <input type="text" name="nomor" class="form-control rounded-pill" value="{{ $dokumen->nomor }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control rounded-pill" value="{{ $dokumen->tanggal }}" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold">Judul</label>
                                    <input type="text" name="judul" class="form-control rounded-pill" value="{{ $dokumen->judul }}" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold">Ringkasan</label>
                                    <textarea name="ringkasan" class="form-control rounded-4" rows="4" required>{{ $dokumen->ringkasan }}</textarea>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold">Status</label>
                                    <select name="status" class="form-select rounded-pill" required>
                                        <option value="diproses" {{ $dokumen->status=='diproses'?'selected':'' }}>Diproses</option>
                                        <option value="ditolak" {{ $dokumen->status=='ditolak'?'selected':'' }}>Ditolak</option>
                                        <option value="diterima" {{ $dokumen->status=='diterima'?'selected':'' }}>Diterima</option>
                                    </select>
                                </div>

                                {{-- INPUT FILE BARU (Pemisah Jelas) --}}
                                <div class="col-12 border rounded-4 p-4 bg-light mt-4">
                                    <label class="form-label fw-bold text-success">+ Tambah Lampiran Baru</label>
                                    <input type="file" name="files[]" class="form-control" multiple>
                                    <div class="form-text text-muted">Biarkan kosong jika tidak ingin menambah file.</div>
                                </div>

                                <div class="col-12 d-flex justify-content-end mt-4">
                                    <button class="btn btn-logo-primary btn-hover rounded-pill px-4 me-2">
                                        <i class="lni lni-save me-1"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('dokumenhukum.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- KOLOM KANAN: LIST FILE LAMA (Kelola Lampiran) --}}
                <div class="col-lg-5">
                    <div class="card border-0 p-4 service-card-hover rounded-4 h-100">
                        <h5 class="fw-bold mb-3 text-secondary border-bottom pb-2"><i class="lni lni-files me-2"></i> Kelola Lampiran Lama</h5>

                        @if($dokumen->attachments->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($dokumen->attachments as $media)
                                    <div class="list-group-item d-flex align-items-center justify-content-between px-0 py-3 service-card-hover">

                                        {{-- Info File --}}
                                        <div class="d-flex align-items-center" style="overflow: hidden;">
                                            <div class="me-3 text-center" style="min-width: 40px;">
                                                <i class="lni lni-file-empty text-logo-accent fs-4"></i>
                                            </div>
                                            <div style="overflow: hidden;">
                                                <h6 class="mb-0 text-truncate fw-bold" title="{{ $media->caption }}" style="font-size: 14px;">
                                                    {{ $media->caption ?: $media->file_name }}
                                                </h6>
                                                <a href="{{ asset('storage/uploads/dokumen_hukum/' . $media->file_name) }}"
                                                   target="_blank" class="text-decoration-none small text-info">
                                                    Lihat File ({{ strtoupper(pathinfo($media->file_name, PATHINFO_EXTENSION)) }})
                                                </a>
                                            </div>
                                        </div>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('dokumenhukum.deleteMedia', $media->media_id) }}" method="POST"
                                              onsubmit="return confirm('Yakin hapus file {{ $media->caption ?: $media->file_name }}?');" class="ms-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" title="Hapus File">
                                                <i class="lni lni-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-secondary text-center py-5 rounded-3">
                                <i class="lni lni-folder-open fa-3x mb-3 text-muted"></i>
                                <p class="mb-0">Tidak ada lampiran file yang tersimpan untuk dokumen ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
