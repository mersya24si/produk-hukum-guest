<header class="header">
    <div class="navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg"> <a class="navbar-brand" href="{{ route('dashboard.index') }}">
                            <img src="{{ asset('assets/assets-admin/img/about/logo_about.png') }}" alt="Logo"
                                width="60" style="height: auto;" /> </a> <button class="navbar-toggler"
                            type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span> <span class="toggler-icon"></span> <span
                                class="toggler-icon"></span> </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">
                                <li class="nav-item"> <a
                                        class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                                        href="{{ route('dashboard.index') }}#home"> Home </a> </li>
                                <li class="nav-item"> <a
                                        class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                                        href="{{ route('dashboard.index') }}#about"> About </a> </li>
                                <li class="nav-item"> <a
                                        class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                                        href="{{ route('dashboard.index') }}#layanan"> Layanan </a> </li>
                                <li class="nav-item"> <a
                                        class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                                        href="{{ route('dashboard.index') }}#kontak"> Kontak </a> </li>
                                <li class="nav-item {{ request()->routeIs('auth.*') ? 'active' : '' }}">
                                    <form action="{{ route('auth.destroy', auth()->user()->id ?? 1) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin logout?')" style="display:inline;"> @csrf
                                        @method('DELETE') <button type="submit" class="nav-link btn btn-link p-0"
                                            style="text-decoration:none; color:inherit;"> <span
                                                class="menu-title">Logout</span> </button> </form>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
