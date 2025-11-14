@extends('layouts.guest.app')
@section('content')
<section id="form" class="pt-100 pb-100 bg-light">
    <div class="container">

        <div class="section-title text-center mb-5">
            <h2 class="fw-bold">Edit Dokumen Hukum</h2>
            <p class="text-muted">Perbarui data dokumen hukum.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card shadow border-0 p-4">
                    <form action="{{ route('dokumenhukum.update', $dokumen->dokumen_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenis Dokumen</label>
                            <select name="jenis_id" class="form-select" required>
                                @foreach ($jenis as $j)
                                    <option value="{{ $j->jenis_id }}"
                                        {{ $dokumen->jenis_id == $j->jenis_id ? 'selected' : '' }}>
                                        {{ $j->nama_jenis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori</label>
                            <select name="kategori_id" class="form-select" required>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->kategori_id }}"
                                        {{ $dokumen->kategori_id == $k->kategori_id ? 'selected' : '' }}>
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor</label>
                            <input type="text" name="nomor" class="form-control"
                                value="{{ $dokumen->nomor }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul</label>
                            <input type="text" name="judul" class="form-control"
                                value="{{ $dokumen->judul }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control"
                                value="{{ $dokumen->tanggal }}" required>
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

                        <div class="text-center">
                            <button class="main-btn btn-hover">Update</button>
                            <a href="{{ route('dokumenhukum.index') }}" class="main-btn btn-outline-secondary ms-2">Kembali</a>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>
</section>
@endsection
