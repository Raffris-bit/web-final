<style>
    .navbar-modern {
        background: linear-gradient(135deg, #1E293B 0%, #334155 100%);
        padding: 0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        position: sticky;
        top: 0;
        z-index: 1050;
    }
    .navbar-modern .navbar-brand {
        padding: 0.875rem 0;
        font-weight: 700;
        font-size: 1.125rem;
        letter-spacing: -0.02em;
        color: #fff;
    }
    .navbar-modern .navbar-brand .brand-icon {
        width: 38px;
        height: 38px;
        background: linear-gradient(135deg, #6366F1, #8B5CF6);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.125rem;
        color: #fff;
    }
    .navbar-modern .navbar-brand .brand-badge {
        font-size: 0.625rem;
        background: rgba(255,255,255,0.15);
        padding: 0.15rem 0.5rem;
        border-radius: 4px;
        font-weight: 500;
        letter-spacing: 0.04em;
        margin-left: 0.25rem;
    }
    .navbar-modern .nav-link {
        color: rgba(255,255,255,0.75) !important;
        font-weight: 500;
        font-size: 0.875rem;
        padding: 0.75rem 1rem !important;
        border-radius: 8px;
        transition: all 0.2s ease;
        position: relative;
    }
    .navbar-modern .nav-link:hover {
        color: #fff !important;
        background: rgba(255,255,255,0.08);
    }
    .navbar-modern .nav-link.active {
        color: #fff !important;
        background: rgba(99, 102, 241, 0.25);
    }
    .navbar-modern .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 2px;
        background: #6366F1;
        border-radius: 1px;
    }
    .navbar-modern .nav-link i {
        margin-right: 0.4rem;
        font-size: 1rem;
    }
    .navbar-modern .dropdown-menu {
        background: #1E293B;
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 12px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        padding: 0.5rem;
        margin-top: 0.5rem;
    }
    .navbar-modern .dropdown-menu .dropdown-item {
        color: rgba(255,255,255,0.75);
        border-radius: 8px;
        padding: 0.6rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    .navbar-modern .dropdown-menu .dropdown-item:hover {
        background: rgba(99, 102, 241, 0.2);
        color: #fff;
    }
    .navbar-modern .dropdown-menu .dropdown-divider {
        border-color: rgba(255,255,255,0.08);
        margin: 0.4rem 0;
    }
    .navbar-modern .dropdown-menu .dropdown-header {
        color: rgba(255,255,255,0.4);
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 0.5rem 1rem 0.25rem;
    }
    .navbar-modern .user-dropdown .nav-link {
        padding: 0.5rem 0.75rem !important;
        border-radius: 10px;
        background: rgba(255,255,255,0.06);
    }
    .navbar-modern .user-dropdown .nav-link:hover {
        background: rgba(255,255,255,0.12);
    }
    .navbar-modern .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: linear-gradient(135deg, #6366F1, #8B5CF6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 0.85rem;
        font-weight: 600;
    }
    .navbar-modern .search-form {
        position: relative;
    }
    .navbar-modern .search-form .form-control {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px;
        color: #fff;
        padding: 0.5rem 1rem 0.5rem 2.5rem;
        font-size: 0.85rem;
        width: 260px;
        transition: all 0.3s;
    }
    .navbar-modern .search-form .form-control::placeholder {
        color: rgba(255,255,255,0.4);
    }
    .navbar-modern .search-form .form-control:focus {
        background: rgba(255,255,255,0.12);
        border-color: rgba(99, 102, 241, 0.5);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        width: 300px;
    }
    .navbar-modern .search-form .search-icon {
        position: absolute;
        left: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255,255,255,0.4);
        font-size: 0.9rem;
        pointer-events: none;
    }
    .navbar-modern .navbar-toggler {
        border: none;
        padding: 0.5rem;
        color: rgba(255,255,255,0.75);
    }
    .navbar-modern .navbar-toggler:focus {
        box-shadow: none;
    }

    @media (max-width: 991.98px) {
        .navbar-modern .search-form .form-control {
            width: 100%;
        }
        .navbar-modern .search-form .form-control:focus {
            width: 100%;
        }
        .navbar-modern .nav-link {
            padding: 0.6rem 1rem !important;
        }
        .navbar-modern .nav-link.active::after {
            display: none;
        }
        .navbar-modern .navbar-collapse {
            padding-bottom: 1rem;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-modern">
    <div class="container-fluid px-4">
        {{-- Brand --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
            <span class="brand-icon">
                <i class="bi bi-book-half"></i>
            </span>
            <div class="d-flex align-items-center">
                <span>Perpustakaan</span>
                <span class="brand-badge">v2.0</span>
            </div>
        </a>

        {{-- Toggler --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list fs-4"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            {{-- Left Nav --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('buku.*') ? 'active' : '' }}"
                       href="{{ route('buku.index') }}">
                        <i class="bi bi-book"></i> Buku
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('anggota.*') ? 'active' : '' }}"
                       href="{{ route('anggota.index') }}">
                        <i class="bi bi-people"></i> Anggota
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('transaksi.*') ? 'active' : '' }}"
                       href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-arrow-left-right"></i> Transaksi
                    </a>
                    <ul class="dropdown-menu shadow">
                        <li><h6 class="dropdown-header">Transaksi</h6></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('transaksi.index') }}">
                                <i class="bi bi-list-check"></i> Daftar Transaksi
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('transaksi.create') }}">
                                <i class="bi bi-plus-circle"></i> Pinjam Buku
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('transaksi.laporan') }}">
                                <i class="bi bi-file-earmark-bar-graph"></i> Laporan
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            {{-- Right Nav --}}
            <ul class="navbar-nav align-items-center gap-2">
                {{-- Search --}}
                <li class="nav-item search-form">
                    <form action="{{ route('search') }}" method="GET" class="d-none d-lg-block">
                        <i class="bi bi-search search-icon"></i>
                        <input class="form-control" type="search" name="q"
                               placeholder="Cari buku, anggota..." value="{{ request('q') }}">
                    </form>
                </li>

                {{-- User Dropdown --}}
                @auth
                <li class="nav-item dropdown user-dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                       href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                        <span class="d-none d-lg-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <div class="px-3 py-2 text-center border-bottom" style="border-color: rgba(255,255,255,0.08) !important;">
                                <div class="user-avatar mx-auto mb-2" style="width:40px;height:40px;font-size:1rem;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="fw-semibold text-white small">{{ Auth::user()->name }}</div>
                                <div class="text-muted" style="font-size:0.75rem;">{{ Auth::user()->email }}</div>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('laporan.index') }}">
                                <i class="bi bi-bar-chart"></i> Laporan
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right"></i> Log Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
