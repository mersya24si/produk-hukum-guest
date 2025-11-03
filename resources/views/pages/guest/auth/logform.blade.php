@extends('layouts.auth.app')
@section('content')
<div class="card p-4">
    <h3 class="text-center mb-3">Login</h3>

   {{-- Notifikasi sukses atau error --}}
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            {{-- Notifikasi error validasi --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                @endif

    <form method="POST" action="{{ route('auth.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Masukkan email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>

        <p class="text-center mt-3">
            Belum punya akun? <a href="{{ route('auth.create') }}">Daftar</a>
        </p>
    </form>
</div>
@endsection
