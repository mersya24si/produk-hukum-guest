@extends('layouts.guest.app')
@section('content')
    <!-- ========================= HERO SECTION ========================= -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <div>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                        <span class="wow fadeInLeft" data-wow-delay=".2s">Selamat Datang di Bina Desa</span>
                        <h1 class="wow fadeInUp" data-wow-delay=".4s">Sistem Informasi Produk Hukum Desa</h1>
                        <p class="wow fadeInUp" data-wow-delay=".6s">
                            Platform digital untuk pengelolaan, publikasi, dan dokumentasi produk hukum desa secara
                            mudah, cepat, dan transparan.
                        </p>
                        <a href="#about" class="main-btn btn-hover wow fadeInUp" data-wow-delay=".8s">Halaman Selanjutnya</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-img wow fadeInUp" data-wow-delay=".5s">
                        <img src="{{ asset('assets/assets-guest/img/hero/hero-img.svg') }}" alt="Hero Image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================= ABOUT SECTION ========================= -->
    <section id="about" class="about-section pt-100 pb-100 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="about-img wow fadeInLeft" data-wow-delay=".3s">
                        <img src="{{ asset('assets/assets-guest/img/about/logo_about.png') }}"
                            alt="Tentang Produk Hukum Desa" class="img-fluid rounded">
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

    <!-- ========================= LAYANAN SECTION ========================= -->
    <section id="layanan" class="services-section pt-100 pb-100">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold">Layanan Bina Desa</h2>
                <p class="text-muted">Pilih layanan berikut untuk mengakses fitur dan informasi yang tersedia di sistem
                    Bina Desa.</p>
            </div>

            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm border-0 h-100 text-center p-4 wow fadeInUp" data-wow-delay=".2s">
                        <div class="icon mb-3 text-primary">
                            <i class="lni lni-users" style="font-size:40px;"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Data Warga</h5>
                        <p class="text-muted mb-3">Data penduduk desa secara akurat dan terstruktur.</p>
                        <a href="{{ route('warga.index') }}" class="main-btn btn-hover">Buka</a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm border-0 h-100 text-center p-4 wow fadeInUp" data-wow-delay=".4s">
                        <div class="icon mb-3 text-success">
                            <i class="lni lni-briefcase" style="font-size:40px;"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Data User</h5>
                        <p class="text-muted mb-3">Informasi dan manajemen data perangkat desa.</p>
                        <a href="{{ route('user.index') }}" class="main-btn btn-hover">Buka</a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm border-0 h-100 text-center p-4 wow fadeInUp" data-wow-delay=".6s">
                        <div class="icon mb-3 text-warning">
                            <i class="lni lni-library" style="font-size:40px;"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Kategori</h5>
                        <p class="text-muted mb-3">Akses daftar peraturan dan keputusan desa terbaru.</p>
                        <a href="{{ route('kategori.index') }}" class="main-btn btn-hover">Buka</a>
                    </div>
                </div>
                <div class="row g-4">
                <!-- Card 4 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm border-0 h-100 text-center p-4 wow fadeInUp" data-wow-delay=".2s">
                        <div class="icon mb-3 text-primary">
                            <i class="lni lni-users" style="font-size:40px;"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Jenis Dokumen</h5>
                        <p class="text-muted mb-3">Datakan Jenis Dokumen Anda disini.</p>
                        <a href="{{ route('jenisdokumen.index') }}" class="main-btn btn-hover">Buka</a>
                    </div>
                </div>
                <!-- Card 5 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm border-0 h-100 text-center p-4 wow fadeInUp" data-wow-delay=".2s">
                        <div class="icon mb-3 text-primary">
                            <i class="lni lni-users" style="font-size:40px;"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Dokumen Hukum</h5>
                        <p class="text-muted mb-3">Dokumen Hukum Bina Desa.</p>
                        <a href="{{ route('dokumenhukum.index') }}" class="main-btn btn-hover">Buka</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- ========================= KONTAK SECTION ========================= -->
    <section id="kontak" class="contact-section pt-100 pb-100 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold">Kontak Kami</h2>
                <p class="text-muted">Hubungi kami untuk pertanyaan, saran, atau kerja sama terkait Sistem Informasi Produk Hukum Desa.</p>
            </div>

            <div class="row align-items-center">
                <!-- Contact Info -->
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="contact-info wow fadeInLeft" data-wow-delay=".3s">
                        <h5 class="fw-bold mb-3">Informasi Kontak</h5>
                        <p class="text-muted mb-2"><i class="lni lni-map-marker me-2 text-primary"></i>Jl. Rowo Sari No. 10, Kecamatan Rumbai, Kabupaten Rumbai</p>
                        <p class="text-muted mb-2"><i class="lni lni-envelope me-2 text-primary"></i>bina.desa@example.com</p>
                        <p class="text-muted mb-2"><i class="lni lni-phone me-2 text-primary"></i>+62 81267498272</p>
                        <p class="text-muted"><i class="lni lni-timer me-2 text-primary"></i>Senin - Jumat, 08.00 - 16.00 WIB</p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="contact-form wow fadeInRight" data-wow-delay=".4s">
                        <form action="" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Alamat Email" required>
                                </div>
                                <div class="col-12">
                                    <input type="text" name="subjek" class="form-control" placeholder="Subjek Pesan" required>
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
