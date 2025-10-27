@extends('layouts.admin.app')
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
                        <img src="{{ asset('assets/assets-admin/img/hero/hero-img.svg') }}" alt="Hero Image">
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
                        <img src="{{ asset('assets/assets-admin/img/about/logo_about.png') }}"
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
            </div>
        </div>
    </section>
@endsection
