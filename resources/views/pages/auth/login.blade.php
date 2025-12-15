@extends('layouts.auth.app') {{-- Sesuaikan layout Anda --}}

@section('content')

    {{-- Style Khusus Halaman Login & Register --}}
    <style>
        /* ================================================= */
        /* VARIABEL WARNA BARU */
        /* ================================================= */
        :root {
            --primary-color: #B89C5B; /* Emas Khaki */
            --primary-dark: #A88C4B; /* Shading untuk Gradient */
        }

        /* ================================================= */
        /* LATAR BELAKANG GAMBAR & EFEK BLUR */
        /* ================================================= */
        body {
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;

            /* GANTI URL INI DENGAN PATH GAMBAR LATAR BELAKANG ANDA */
            background-image: url('{{ asset('assets/assets-guest/img/hero/bglogin.jpg') }}');
            background-size: cover;
            background-position: center;

            /* FILTER BLUR RINGAN */
            position: relative;
        }

        /* Pseudo-element untuk efek Blur pada body */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.4); /* Opacity Putih/Abu-abu */
            backdrop-filter: blur(4px); /* Efek Blur 4px */
            z-index: -1;
        }

        /* Mengatur container utama */
        .container-custom {
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.35), 0 10px 10px rgba(0, 0, 0, 0.25);
            position: relative;
            overflow: hidden;
            width: 800px;
            max-width: 100%;
            min-height: 600px;
            z-index: 1;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
            padding: 40px;
        }

        /* Container Login (Kiri) */
        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        /* Container Register (Kanan, tersembunyi) */
        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        /* Overlay Container (Sisi Warna) */
        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        /* Overlay itu sendiri */
        .overlay {
            background: var(--primary-color);
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        /* Panel di Sisi Warna */
        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        /* Panel Overlay Kanan (Awalnya terlihat) */
        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        /* Panel Overlay Kiri (Awalnya tersembunyi) */
        .overlay-left {
            transform: translateX(-20%);
        }

        /* ================================== */
        /*     EFEK PERGESERAN (THE MAGIC)    */
        /* ================================== */
        .container-custom.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }
        .container-custom.right-panel-active .sign-in-container {
            transform: translateX(100%);
            opacity: 0;
            z-index: 1;
        }
        .container-custom.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
        }
        .container-custom.right-panel-active .overlay {
            transform: translateX(50%);
        }
        .container-custom.right-panel-active .overlay-right {
            transform: translateX(20%);
        }
        .container-custom.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        /* Gaya elemen form */
        .social-container a {
            border: 1px solid #ddd;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
            color: #333;
            transition: 0.3s;
        }

        .social-container a:hover {
            background-color: #f0f0f0;
        }

        .form-container form {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            height: 100%;
        }

        .form-container input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            border-radius: 8px;
        }

        .btn-custom {
            border-radius: 20px;
            border: 1px solid var(--primary-color);
            background-color: var(--primary-color); /* Menggunakan warna baru */
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
            cursor: pointer;
        }

        .btn-custom.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
            color: #FFFFFF;
        }
    </style>


    <div class="container-custom" id="container">

        {{-- KOTAK PESAN KESALAHAN/SUKSES --}}
        <div class="form-container sign-up-container">
            @if (session('success'))
                <div class="alert alert-success w-100">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger w-100">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger w-100">
                    <ul class="mb-0 text-start">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- Form Register --}}
            <form method="POST" action="{{ route('auth.store') }}" style="padding-top: 15px;">
                @csrf
                <h1 class="fw-bold mb-2">Buat Akun Baru</h1>

                <div class="social-container mb-2">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>

                <span class="small text-muted mb-2">atau gunakan email Anda untuk mendaftar</span>

                {{-- Nama Lengkap --}}
                <input type="text" placeholder="Nama Lengkap" name="name" value="{{ old('name') }}" required />
                @error('name')
                    <p class="text-danger small mt-n2 mb-2">{{ $message }}</p>
                @enderror

                {{-- Email --}}
                <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" required />
                @error('email')
                    <p class="text-danger small mt-n2 mb-2">{{ $message }}</p>
                @enderror

                {{-- Tambahan: Input Role --}}
                <select name="role" required class="form-control"
                    style="background-color: #eee; border: none; padding: 12px 15px; margin: 8px 0; width: 100%; border-radius: 8px;">
                    <option value="" disabled {{ old('role') == null ? 'selected' : '' }}>Pilih Role</option>
                    <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Warga" {{ old('role') == 'Warga' ? 'selected' : '' }}>Warga</option>
                </select>
                @error('role')
                    <p class="text-danger small mt-n2 mb-2">{{ $message }}</p>
                @enderror

                {{-- Password --}}
                <input type="password" placeholder="Kata Sandi" name="password" required />
                @error('password')
                    <p class="text-danger small mt-n2 mb-2">{{ $message }}</p>
                @enderror

                {{-- Confirm Password --}}
                <input type="password" placeholder="Konfirmasi Kata Sandi" name="password_confirmation" required />

                <button type="submit" name="register" class="btn-custom mt-4">Daftar (Sign Up)</button>
            </form>
        </div>




        {{-- ================================================== --}}
        {{-- BAGIAN 2: FORM SIGN IN (LOGIN) --}}
        {{-- ================================================== --}}
        <div class="form-container sign-in-container">
            @if (session('success'))
                <div class="alert alert-success w-100">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger w-100">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger w-100">
                    <ul class="mb-0 text-start">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('auth.store') }}">
                @csrf
                <h1 class="fw-bold mb-3">Selamat Datang</h1>

                <span class="small text-muted mb-3">Layanan Produk Hukum Desa</span>

                <input type="email" placeholder="Email" name="email" required />
                <input type="password" placeholder="Kata Sandi" name="password" required />

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="small text-muted mt-2 mb-4">Lupa kata sandi anda?</a>
                @endif

                <button type="submit" name="login" class="btn-custom">Masuk (Sign In)</button>
            </form>
        </div>

        {{-- ================================================== --}}
        {{-- BAGIAN 3: OVERLAY CONTAINER (THE SLIDING PANEL) --}}
        {{-- ================================================== --}}
        <div class="overlay-container">
            <div class="overlay">

                {{-- PANEL KANAN (Muncul saat LOGIN / Default) --}}
                <div class="overlay-panel overlay-right">
                    <h1 class="fw-bold">Selamat Datang!</h1>
                    <p class="mt-3 mb-4">Belum punya akun? Daftarkan diri Anda dan nikmati semua layanan kami.</p>
                    <button class="btn-custom ghost" id="signUp">Daftar (Sign Up)</button>
                </div>

                {{-- PANEL KIRI (Muncul saat REGISTER) --}}
                <div class="overlay-panel overlay-left">
                    <h1 class="fw-bold">Kembali ke Akun Anda!</h1>
                    <p class="mt-3 mb-4">Masukkan kredensial Anda untuk tetap terhubung dan mengakses dashboard.</p>
                    <button class="btn-custom ghost" id="signIn">Masuk (Sign In)</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Skrip JavaScript untuk Mengontrol Pergeseran --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const signUpButton = document.getElementById('signUp');
            const signInButton = document.getElementById('signIn');
            const container = document.getElementById('container');

            // Fungsi untuk mengaktifkan mode Register
            signUpButton.addEventListener('click', () => {
                container.classList.add("right-panel-active");
            });

            // Fungsi untuk mengaktifkan mode Login
            signInButton.addEventListener('click', () => {
                container.classList.remove("right-panel-active");
            });

            // Optional: Mengatur default tampilan jika ada error pada form Register
            @if ($errors->hasAny(['name', 'email', 'role', 'password']) || session('status') == 'register_error')
                container.classList.add("right-panel-active");
            @endif
        });
    </script>

@endsection
