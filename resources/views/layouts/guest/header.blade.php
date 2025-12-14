<header class="header">
    <div class="navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">

                        <a class="navbar-brand" href="{{ route('dashboard.index') }}">
                            <img src="{{ asset('assets/assets-guest/img/about/logo.png') }}" alt="Logo Bina Desa"
                                width="60" style="height: auto;" />
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">

                            <ul id="nav" class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                                        href="{{ route('dashboard.index') }}#home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dashboard.index') }}#about">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dashboard.index') }}#layanan">Layanan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dashboard.index') }}#profile">Dev</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dashboard.index') }}#kontak">Kontak</a>
                                </li>
                            </ul>

                            <div class="d-flex align-items-center ms-lg-3 mt-3 mt-lg-0">
                                @if (Auth::check())
                                    <form action="{{ route('auth.destroy', auth()->user()->id ?? 1) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin logout?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-logo-primary btn-hover d-flex align-items-center"
                                            style="padding: 10px 20px; border-radius: 50px;">
                                            <i class="lni lni-exit me-2"></i> <span>Logout</span>
                                        </button>
                                    </form>
                                @else
                                    <a class="btn btn-logo-primary btn-hover d-flex align-items-center"
                                        href="{{ route('auth.index') }}"
                                        style="padding: 10px 20px; border-radius: 50px;">
                                        <i class="lni lni-enter me-2"></i> <span>Login</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
