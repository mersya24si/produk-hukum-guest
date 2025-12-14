@extends('layouts.guest.app')

@section('content')
    <br><br>

    <section id="form-edit-lampiran" class="pt-100 pb-100 bg-light">
        <div class="container">

            <div class="mb-4">
                {{-- Route kembali ke daftar lampiran --}}
                <a href="{{ route('lampirandokumen.index') }}" class="btn btn-secondary rounded-pill px-4">
                    <i class="lni lni-arrow-left me-1"></i> Kembali ke Daftar Lampiran
                </a>
            </div>

            <div class="section-title text-center mb-5 border-bottom pb-3">
                <h2 class="fw-bold text-logo-accent">Edit Lampiran Dokumen</h2>
                {{-- Judul dokumen terkait digunakan untuk keterangan --}}
                <p class="text-muted">Perbarui keterangan lampiran dan kelola file untuk Lampiran ID: **{{ $lampiran->lampiran_id }}**.</p>
            </div>

            <div class="row justify-content-center g-4">

                {{-- KOLOM KIRI: FORM EDIT DATA UTAMA (Lampiran) --}}
                <div class="col-lg-7">
                    <div class="card border-0 p-5 service-card-hover rounded-4 h-100">
                        <h5 class="fw-bold mb-3 text-logo-accent border-bottom pb-2"><i class="lni lni-pencil me-2"></i> Form Perubahan Data Lampiran</h5>

                        {{-- Form Update Data Teks --}}
                        <form action="{{ route('lampirandokumen.update', $lampiran->lampiran_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">

                                {{-- Dokumen ID (Relasi) --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold">Dokumen Hukum Terkait <span class="text-danger">*</span></label>
                                    {{-- Menggunakan variabel $dokumenHukum (list semua dokumen) --}}
                                    <select name="dokumen_id" class="form-select rounded-pill @error('dokumen_id') is-invalid @enderror" required>
                                        <option value="" disabled>-- Pilih Dokumen Hukum --</option>
                                        @foreach ($dokumenHukum as $d)
                                            <option value="{{ $d->dokumen_id }}"
                                                {{ old('dokumen_id', $lampiran->dokumen_id) == $d->dokumen_id ? 'selected' : '' }}>
                                                [{{ $d->nomor }}] {{ $d->judul }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('dokumen_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                {{-- Keterangan --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold">Keterangan Lampiran (Opsional)</label>
                                    <textarea name="keterangan" class="form-control rounded-4 @error('keterangan') is-invalid @enderror" rows="4"
                                        placeholder="Tuliskan keterangan singkat mengenai lampiran ini.">{{ old('keterangan', $lampiran->keterangan) }}</textarea>
                                    @error('keterangan') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>


                                {{-- INPUT FILE BARU (Pemisah Jelas) --}}
                                <div class="col-12 border rounded-4 p-4 bg-light mt-4">
                                    <label class="form-label fw-bold text-success">+ Tambah File Lampiran Baru (Opsional)</label>
                                    <input type="file" name="files[]" class="form-control @error('files.*') is-invalid @enderror" multiple>
                                    <div class="form-text text-muted">File yang di-upload akan ditambahkan ke lampiran ini.</div>
                                    @error('files.*') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12 d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-logo-primary btn-hover rounded-pill px-4 me-2">
                                        <i class="lni lni-save me-1"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('lampirandokumen.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
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
                        <h5 class="fw-bold mb-3 text-secondary border-bottom pb-2"><i class="lni lni-files me-2"></i> Kelola File Terlampir</h5>

                        {{-- Menggunakan relasi attachments pada variabel $lampiran --}}
                        @if($lampiran->attachments->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($lampiran->attachments as $media)
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
                                                <a href="{{ asset('storage/uploads/lampiran_dokumen/' . $media->file_name) }}"
                                                    target="_blank" class="text-decoration-none small text-info">
                                                    {{-- Perbaikan Path Download --}}
                                                    Lihat File ({{ strtoupper(pathinfo($media->file_name, PATHINFO_EXTENSION)) }})
                                                </a>
                                            </div>
                                        </div>

                                        {{-- Tombol Hapus --}}
                                        {{-- Menggunakan route lampirandokumen.media.destroy --}}
                                        <form action="{{ route('lampirandokumen.media.destroy', $media->media_id) }}" method="POST"
                                                onsubmit="return confirm('Yakin hapus file {{ $media->caption ?: $media->file_name }}?');" class="ms-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" title="Hapus File Permanen">
                                                <i class="lni lni-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-secondary text-center py-5 rounded-3">
                                <i class="lni lni-folder-open fa-3x mb-3 text-muted"></i>
                                <p class="mb-0">Belum ada file terlampir.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
