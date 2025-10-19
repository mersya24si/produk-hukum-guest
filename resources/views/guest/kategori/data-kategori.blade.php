<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin & Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, admin, dashboard, template, responsive">

    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <title>Data Warga | AdminKit Demo</title>

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
                        <a class="sidebar-link" href="{{ url('guest/dashboard') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ route('warga.index') }}">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Data
                                Warga</span>
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
                        <h1 class="h3 d-inline align-middle">Data Kategori</h1>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                                </div>
                        @endif
                        <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm ms-2">+ Tambah
                            Kategori</a>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tabel Data Warga</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataKategori as $item)
                                        <tr>

                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->deskripsi }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('kategori.edit', $item->kategori_id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>

                                                    <form action="{{ route('kategori.destroy', $item->kategori_id) }}"
                                                        method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted">Tidak ada data Kategori.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
