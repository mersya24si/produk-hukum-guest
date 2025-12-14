@extends('layouts.guest.app')

@section('content')
    <br><br>
    <main class="container my-5" id="riwayatPerubahan">

        <div class="d-flex justify-content-between align-items-center mb-4">
            {{-- Tombol Kembali ke Layanan --}}
            <a href="{{ url('/dashboard#layanan') }}" class="btn btn-secondary rounded-pill px-4">
                <i class="lni lni-arrow-left me-1"></i> Kembali ke Layanan
            </a>



        </div>

        <div class="text-center mb-5 border-bottom pb-3">
            <h2 class="fw-bold text-logo-accent">Riwayat Perubahan Dokumen Hukum</h2>
            <p class="text-muted">Daftar lengkap log perubahan yang tercatat pada dokumen-dokumen hukum.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">

                {{-- Notifikasi Sukses --}}
                @if (session('success'))
                    <div class="alert alert-success text-center mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Daftar Kartu Riwayat --}}
                @if (!$riwayat->isEmpty())
                    <div class="row g-4 mt-2">
                        @foreach ($riwayat as $item)
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card border-0 rounded-4 h-100 service-card-hover d-flex flex-column">
                                    <div class="card-body">

                                        {{-- JUDUL RIWAYAT --}}
                                    

                                        {{-- INFORMASI DOKUMEN TERKAIT --}}
                                        <p class="text-muted small mb-3 border-bottom pb-2">
                                            <i class="lni lni-book me-1"></i> Dokumen: <span class="fw-bold">{{ Str::limit($item->dokumen->judul ?? 'Dokumen Dihapus', 25) }}</span>
                                        </p>

                                        {{-- METADATA RIWAYAT --}}
                                        <ul class="list-unstyled small mb-3 text-muted">
                                            <li><strong class="text-dark">Nomor Dokumen:</strong> {{ $item->dokumen->nomor ?? '-' }}</li>
                                            <li>
                                                <strong class="text-dark">Tanggal Perubahan:</strong>
                                                <span class="badge bg-dark rounded-pill">{{ date('d F Y', strtotime($item->tanggal)) }}</span>
                                            </li>
                                            <li>
                                                <strong class="text-dark">Versi Dokumen:</strong>
                                                <span class="badge bg-info text-white rounded-pill">{{ $item->versi ?? 'N/A' }}</span>
                                            </li>
                                        </ul>

                                        {{-- URAIAN PERUBAHAN --}}
                                        <p class="card-text small border-top pt-2 text-secondary fst-italic">
                                            **Uraian:** {{ Str::limit($item->uraian_perubahan, 100) }}
                                        </p>
                                    </div>

                                    {{-- Tombol Aksi Admin --}}
                                    @if (Auth::check() && Auth::user()->role === 'Admin')
                                        <div class="card-footer bg-light border-top d-flex justify-content-between p-3 mt-auto">
                                            <a href="{{ route('riwayat.edit', $item->riwayat_id) }}"
                                                class="btn btn-warning btn-sm flex-fill me-2 rounded-pill">
                                                <i class="lni lni-pencil"></i> Edit
                                            </a>

                                            <form action="{{ route('riwayat.destroy', $item->riwayat_id) }}" method="POST"
                                                onsubmit="return confirm('Yakin hapus riwayat ID {{ $item->riwayat_id }}?')"
                                                class="flex-fill">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm w-100 rounded-pill">
                                                    <i class="lni lni-trash-can"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Paginasi --}}
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $riwayat->links('pagination::simple-bootstrap-5') }}
                    </div>
                @else
                    {{-- Jika data kosong --}}
                    <div class="alert alert-info text-center mt-4 p-4 rounded-4 service-card-hover">
                        <i class="lni lni-information me-2"></i>
                        <p class="mb-0 fw-bold">Tidak ada data riwayat perubahan yang ditemukan.</p>
                    </div>
                @endif

                <div class="text-end mt-5">
                <a href="{{ route('riwayat.create') }}"
                    class="btn btn-logo-primary shadow-lg rounded-pill px-4 py-2 btn-hover">
                    <i class="lni lni-plus me-1"></i> Tambah Riwayat Perubahan
                </a>
            </div>
            </div>
        </div>
    </main>

@endsection
