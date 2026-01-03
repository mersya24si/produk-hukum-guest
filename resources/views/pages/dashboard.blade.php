@extends('layouts.guest.app')
@section('content')
    <section id="home" class="hero-section pb-5">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <span class="wow fadeInLeft text-logo-accent fw-bold" data-wow-delay=".2s">Selamat Datang Di Layanan
                            Produk Hukum</span>
                        <h1 class="wow fadeInUp" data-wow-delay=".4s">Sistem Informasi Produk Hukum Desa</h1>
                        <p class="wow fadeInUp" data-wow-delay=".6s">
                            Platform digital untuk pengelolaan, publikasi, dan dokumentasi produk hukum desa secara
                            mudah, cepat, dan transparan.
                        </p>
                        <a href="#about" class="main-btn btn-hover wow fadeInUp" data-wow-delay=".8s">Halaman
                            Selanjutnya</a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div id="heroImageCarousel" class="carousel slide wow fadeInRight" data-bs-ride="carousel"
                        data-bs-interval="4000" data-wow-delay=".5s">
                        <div class="carousel-inner rounded shadow-lg">
                           
                            <div class="carousel-item">
                                <img src="{{ asset('assets/assets-guest/img/hero/bg2.webp') }}"
                                    class="d-block w-100 img-fluid" alt="Slide 2 - Layanan Warga"
                                    style="max-height: 450px; object-fit: contain;">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/assets-guest/img/hero/bg3.avif') }}"
                                    class="d-block w-100 img-fluid" alt="Slide 3 - Transparansi"
                                    style="max-height: 450px; object-fit: contain;">
                            </div>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#heroImageCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#heroImageCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container pb-5">
        <hr class="border-3 text-muted opacity-25">
    </div>

    <section id="about" class="about-section pt-100 pb-100 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="about-img wow fadeInLeft rounded-3 shadow-lg" data-wow-delay=".3s">
                        <img src="{{ asset('assets/assets-guest/img/about/logo.png') }}" alt="Tentang Produk Hukum Desa"
                            class="img-fluid rounded">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content wow fadeInRight" data-wow-delay=".4s">
                        <h2 class="mb-3 fw-bold">Tentang Produk Hukum Desa</h2>
                        <p class="text-muted mb-3">
                            Produk hukum desa adalah peraturan atau keputusan yang ditetapkan oleh pemerintah desa
                            sebagai dasar dalam penyelenggaraan pemerintahan, pembangunan, dan pemberdayaan masyarakat
                            di tingkat desa.
                        </p>
                        <a href="#layanan" class="main-btn btn-hover">Lihat Layanan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container pt-5 pb-5">
        <hr class="border-3 text-muted opacity-25">
    </div>

    <section id="layanan" class="services-section pt-100 pb-100">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold">Layanan Bina Desa</h2>
                <p class="text-muted">Pilih layanan berikut untuk mengakses fitur dan informasi yang tersedia di sistem Bina
                    Desa.</p>
            </div>

            <div class="row g-4 justify-content-center">
                @php
                    $layanan = [
                        [
                            'icon' => 'lni lni-users',
                            'color' => 'text-logo-accent',
                            'title' => 'Data Warga',
                            'desc' => 'Data penduduk desa secara akurat dan terstruktur.',
                            'route' => route('warga.index'),
                        ],
                        [
                            'icon' => 'lni lni-briefcase',
                            'color' => 'text-success',
                            'title' => 'Data User',
                            'desc' => 'Informasi dan manajemen data perangkat desa.',
                            'route' => route('user.index'),
                        ],
                        [
                            'icon' => 'lni lni-library',
                            'color' => 'text-warning',
                            'title' => 'Kategori',
                            'desc' => 'Akses daftar peraturan dan keputusan desa terbaru.',
                            'route' => route('kategori.index'),
                        ],
                        [
                            'icon' => 'lni lni-files',
                            'color' => 'text-info',
                            'title' => 'Jenis Dokumen',
                            'desc' => 'Datakan Jenis Dokumen Anda disini.',
                            'route' => route('jenisdokumen.index'),
                        ],
                        [
                            'icon' => 'lni lni-folder',
                            'color' => 'text-danger',
                            'title' => 'Dokumen Hukum',
                            'desc' => 'Dokumen Hukum Bina Desa.',
                            'route' => route('dokumenhukum.index'),
                        ],
                        // START: Penambahan baru
                        [
                            'icon' => 'lni lni-vector', // Ikon untuk Riwayat
                            'color' => 'text-secondary', // Warna baru
                            'title' => 'Riwayat Dokumen',
                            'desc' => 'Lihat riwayat perubahan dan versi dokumen hukum.',
                            // Ganti 'riwayat.index' jika rute Anda berbeda
                            'route' => route('riwayat.index'),
                        ],
                        [
                            'icon' => 'lni lni-paperclip', // Ikon untuk Lampiran
                            'color' => 'text-primary', // Warna baru
                            'title' => 'Lampiran Dokumen',
                            'desc' => 'Kelola dan lihat file-file yang dilampirkan ke dokumen.',
                            // Menggunakan rute yang telah kita buat
                            'route' => route('lampirandokumen.index'),
                        ],
                        // END: Penambahan baru
                    ];
                    $delay = 0.2;
                @endphp

                @foreach ($layanan as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="card border-0 h-100 text-center p-4 wow fadeInUp service-card-hover"
                            data-wow-delay=".{{ $delay }}s" onclick="window.location.href='{{ $item['route'] }}'">

                            <div class="icon mb-3 {{ $item['color'] }}">
                                <i class="{{ $item['icon'] }}" style="font-size:40px;"></i>
                            </div>

                            <h5 class="fw-bold mb-2">{{ $item['title'] }}</h5>
                            <p class="text-muted mb-3">{{ $item['desc'] }}</p>
                            <a href="{{ $item['route'] }}" class="main-btn btn-hover mt-auto">Buka</a>
                        </div>
                    </div>
                    @php $delay += 0.2; @endphp
                @endforeach
            </div>
        </div>
    </section>


    <div class="container pt-5 pb-5">
        <hr class="border-3 text-muted opacity-25">
    </div>

    <section id="profile" class="container my-5 pt-5 pb-5">
        <div class="text-center mb-4">
            <h4 class="fw-bold">Identitas Pengembang</h4>
            <p class="text-muted">Informasi singkat mengenai pengembang aplikasi Bina Desa.</p>
        </div>

        <div class="d-flex flex-column align-items-center service-card-hover p-4 rounded-3 w-50 mx-auto">
            <img src="{{ asset('assets/assets-guest/img/about/foto.jpg') }}" alt="Foto Mersya"
                class="rounded-circle mb-3 border border-4 border-light"
                style="width: 140px; height: 140px; object-fit: cover;">

            <h5 class="fw-bold mb-1">Nama: Mersya Meylani Putri</h5>
            <p class="text-muted mb-1">NIM: 2457301084</p>
            <p class="text-muted mb-3">Program Studi: Sistem Informasi</p>

            <div>
                <a href="https://www.linkedin.com/in/mersya-meylani-putri-94a212394/" class="mx-2 text-decoration-none text-logo-accent">LinkedIn</a>
                <a href="https://github.com/mersya24si" class="mx-2 text-decoration-none text-logo-accent">GitHub</a>
                <a href="https://www.instagram.com/mersyamylnip/" class="mx-2 text-decoration-none text-logo-accent">Instagram</a>
            </div>
        </div>
    </section>

    <div class="container pt-5">
        <hr class="border-3 text-muted opacity-25">
    </div>

    <section id="kontak" class="contact-section pt-100 pb-100 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold">Kontak Kami</h2>
                <p class="text-muted">Hubungi kami untuk pertanyaan, saran, atau kerja sama terkait Sistem Informasi Produk
                    Hukum Desa.</p>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="contact-info wow fadeInLeft p-4 rounded-3 service-card-hover bg-white"
                        data-wow-delay=".3s">
                        <h5 class="fw-bold mb-3">Informasi Kontak</h5>
                        <p class="text-muted mb-2"><i class="lni lni-map-marker me-2 text-logo-accent"></i>Jl. Rowo Sari
                            No.
                            10, Kecamatan Rumbai, Kabupaten Rumbai</p>
                        <p class="text-muted mb-2"><i
                                class="lni lni-envelope me-2 text-logo-accent"></i>bina.desa@example.com
                        </p>
                        <p class="text-muted mb-2"><i class="lni lni-phone me-2 text-logo-accent"></i>+62 81267498272</p>
                        <p class="text-muted"><i class="lni lni-timer me-2 text-logo-accent"></i>Senin - Jumat, 08.00 -
                            16.00 WIB</p>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="contact-form wow fadeInRight p-4 rounded-3 service-card-hover bg-white"
                        data-wow-delay=".4s">
                        <form action="" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Alamat Email"
                                        required>
                                </div>
                                <div class="col-12">
                                    <input type="text" name="subjek" class="form-control" placeholder="Subjek Pesan"
                                        required>
                                </div>
                                <div class="col-12">
                                    <textarea name="pesan" rows="5" class="form-control" placeholder="Tulis pesan Anda di sini..." required></textarea>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="main-btn btn-hover">Kirim Pesan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
    /* CSS Kustom Tambahan */

    /* Warna Aksen Logo: #B89C5B */
    .text-logo-accent {
        color: #B89C5B !important;
    }

    .main-btn,
    .btn-logo-primary {
        background-color: #B89C5B !important;
        border-color: #B89C5B !important;
    }

    .main-btn:hover,
    .btn-logo-primary:hover {
        background-color: #a38953 !important;
        border-color: #a38953 !important;
    }

    /* Efek Hover Card Modern (Shadow Box) */
    .service-card-hover {
        transition: all 0.3s ease;
        cursor: pointer;
        border-radius: 10px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, .05);
    }

    .service-card-hover:hover {
        transform: translateY(-5px);
        /* Menggunakan warna aksen untuk bayangan saat hover */
        box-shadow: 0 1rem 3rem rgba(184, 156, 91, 0.2) !important;
    }
</style>
