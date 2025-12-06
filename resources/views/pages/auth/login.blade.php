@extends('layouts.auth.app') {{-- Sesuaikan layout Anda --}}

@section('content')

    {{-- Style Khusus Halaman Login & Register --}}
    <style>
        /* Mengatur body agar konten berada di tengah vertikal */
        body {
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
            /* Latar belakang abu-abu muda */
        }

        .container-custom {
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            position: relative;
            overflow: hidden;
            width: 800px;
            /* Lebar total container */
            max-width: 100%;
            min-height: 600px;
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

        /* Overlay Container (Sisi Hijau) */
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
            background: #1469b8;
            /* Warna Hijau Cyan Utama */
            background: linear-gradient(to right, #1469b8, #1469b8);
            /* Gradien Hijau */
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

        /* Panel di Sisi Hijau */
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

        /* Ketika class 'right-panel-active' ditambahkan ke container-custom */

        /* 1. Container utama geser ke kiri */
        .container-custom.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        /* 2. Form Sign In geser ke kanan dan hilang (z-index 1 agar tertutup) */
        .container-custom.right-panel-active .sign-in-container {
            transform: translateX(100%);
            opacity: 0;
            z-index: 1;
        }

        /* 3. Form Sign Up geser ke kanan dan muncul (z-index 5 agar terlihat) */
        .container-custom.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
        }

        /* 4. Overlay geser ke kanan (menampilkan panel kiri) */
        .container-custom.right-panel-active .overlay {
            transform: translateX(50%);
        }

        /* 5. Panel kanan di overlay geser hilang */
        .container-custom.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        /* 6. Panel kiri di overlay geser muncul */
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
            border: 1px solid #1469b8;
            background-color: #1469b8;
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
        <div class="sign-up-container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
        {{-- ================================================== --}}
        {{-- BAGIAN 1: FORM SIGN UP (REGISTER) - HANYA SATU INSTANCE --}}
        {{-- ================================================== --}}
        <div class="form-container sign-up-container">
            <form method="POST" action="{{ route('auth.store') }}">
                @csrf
                <h1 class="fw-bold mb-3">Create Account</h1>

                <div class="social-container mb-3">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>

                <span class="small text-muted mb-3">atau gunakan email Anda untuk mendaftar</span>

                {{-- Nama Lengkap (Repopulated) --}}
                <input type="text" placeholder="Nama Lengkap" name="name" value="{{ old('name') }}" required />
                @error('name')
                    <p class="text-danger small mt-n2 mb-2">{{ $message }}</p>
                @enderror

                {{-- Email (Repopulated) --}}
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
                <input type="password" placeholder="Password" name="password" required />
                @error('password')
                    <p class="text-danger small mt-n2 mb-2">{{ $message }}</p>
                @enderror

                {{-- Confirm Password --}}
                <input type="password" placeholder="Confirm Password" name="password_confirmation" required />

                <button type="submit" name="register" class="btn-custom mt-4">Sign Up</button>
            </form>
        </div>




        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('auth.store') }}">
                @csrf
                <h1 class="fw-bold mb-3">Sign in</h1>

                <div class="social-container mb-3">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>

                <span class="small text-muted mb-3">atau gunakan akun Anda</span>

                <input type="email" placeholder="Email" name="email" required />
                <input type="password" placeholder="Password" name="password" required />

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="small text-muted mt-2 mb-4">Lupa kata sandi anda?</a>
                @endif

                <button type="submit" name="login" class="btn-custom">Sign In</button>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">

                {{-- PANEL KANAN (Muncul saat LOGIN) --}}
                <div class="overlay-panel overlay-right">
                    <h1 class="fw-bold">Halo, Teman!</h1>
                    <p class="mt-3 mb-4">Daftarkan diri anda dan mulai gunakan layanan kami segera</p>
                    <button class="btn-custom ghost" id="signUp">Sign Up</button>
                </div>

                {{-- PANEL KIRI (Muncul saat REGISTER) --}}
                <div class="overlay-panel overlay-left">
                    <h1 class="fw-bold">Selamat Datang Kembali!</h1>
                    <p class="mt-3 mb-4">Untuk tetap terhubung dengan kami, silakan login dengan akun Anda</p>
                    <button class="btn-custom ghost" id="signIn">Sign In</button>
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

            // Optional: Mengatur default tampilan jika ada error (Misal, error register)
            @if ($errors->has('name') || $errors->has('email') || $errors->has('password') || session('status') == 'register_error')
                container.classList.add("right-panel-active");
            @endif
        });
    </script>

@endsection
