<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin & Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, admin, dashboard, template, responsive">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('assets/assets-admin/img/icons/icon-48x48.png') }}" />
    <title>Input Data Warga | AdminKit Demo</title>

    <link href="{{ asset('assets/assets-admin/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="#">
                    <span class="align-middle">AdminKit</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url ('guest.dashboard') }}">
                            <i class="align-middle" data-feather="sliders"></i> 
                            <span class="align-middle">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ route('warga.index') }}">
                            <i class="align-middle" data-feather="users"></i> 
                            <span class="align-middle">Data Warga</span>
                        </a>
                    </li>
                     <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ route('kategori.index') }}">
                            <i class="align-middle" data-feather="users"></i> 
                            <span class="align-middle">Kategori</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main -->
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="mb-3">
                        <h1 class="h3 d-inline align-middle">Input Data Warga</h1>
                        <a href="{{ route('warga.index') }}" class="btn btn-secondary btn-sm ms-2">Lihat Data</a>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Form Input</h5>
                                </div>

                                <form action="{{ route('warga.store') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <label>No KTP</label>
                                        <input type="text" class="form-control" placeholder="Masukkan No KTP"
                                            name="no_ktp" value="{{ old('no_ktp') }}">
                                    </div>

                                    <div class="card-body">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" placeholder="Masukkan Nama"
                                            name="nama" value="{{ old('nama') }}">
                                    </div>

                                    <div class="card-body">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-select">
                                            <option value="">-- Pilih --</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="card-body">
                                        <label>Agama</label>
                                        <input type="text" class="form-control" placeholder="Masukkan Agama"
                                            name="agama" value="{{ old('agama') }}">
                                    </div>

                                    <div class="card-body">
                                        <label>Pekerjaan</label>
                                        <input type="text" class="form-control" placeholder="Masukkan Pekerjaan"
                                            name="pekerjaan" value="{{ old('pekerjaan') }}">
                                    </div>

                                    <div class="card-body">
                                        <label>No Telepon</label>
                                        <input type="text" class="form-control" placeholder="Masukkan No Telepon"
                                            name="telp" value="{{ old('telp') }}">
                                    </div>

                                    <div class="card-body">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Masukkan Email"
                                            name="email" value="{{ old('email') }}">
                                    </div>

                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ route('warga.index') }}" class="btn btn-danger">Cancel</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid text-center">
                    <span class="text-muted">© 2025 AdminKit Laravel Template</span>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/assets-admin/js/app.js') }}"></script>
</body>

</html>
