<style>
    .footer-modern {
        background: #1E293B;
        color: rgba(255,255,255,0.6);
        font-size: 0.875rem;
        margin-top: auto;
    }
    .footer-modern .footer-top {
        padding: 2.5rem 0 1.5rem;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .footer-modern .footer-bottom {
        padding: 1.25rem 0;
        font-size: 0.8rem;
        text-align: center;
    }
    .footer-modern h5, .footer-modern h6 {
        color: #fff;
        font-weight: 600;
    }
    .footer-modern .brand-icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #6366F1, #8B5CF6);
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        color: #fff;
    }
    .footer-modern a {
        color: rgba(255,255,255,0.6);
        text-decoration: none;
        transition: color 0.2s;
    }
    .footer-modern a:hover {
        color: #818CF8;
    }
    .footer-modern .social-links a {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: rgba(255,255,255,0.06);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,0.5);
        transition: all 0.2s;
    }
    .footer-modern .social-links a:hover {
        background: rgba(99, 102, 241, 0.2);
        color: #818CF8;
    }
    .footer-modern .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .footer-modern .footer-links li {
        margin-bottom: 0.5rem;
    }
    .footer-modern .footer-links li:last-child {
        margin-bottom: 0;
    }
    .footer-modern .footer-divider {
        border-color: rgba(255,255,255,0.06);
    }
</style>

<footer class="footer-modern">
    <div class="container-fluid px-4">
        <div class="footer-top">
            <div class="row g-4">
                <div class="col-md-5">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="brand-icon">
                            <i class="bi bi-book-half"></i>
                        </span>
                        <h5 class="mb-0">Sistem Perpustakaan</h5>
                    </div>
                    <p class="mb-2" style="max-width: 360px;">
                        Sistem manajemen perpustakaan digital untuk mengelola data buku,
                        anggota, dan transaksi peminjaman secara efisien dan modern.
                    </p>
                    <div class="social-links d-flex gap-2 mt-3">
                        <a href="#" title="Email"><i class="bi bi-envelope"></i></a>
                        <a href="#" title="Telepon"><i class="bi bi-telephone"></i></a>
                        <a href="#" title="Github"><i class="bi bi-github"></i></a>
                    </div>
                </div>
                <div class="col-md-3 offset-md-1">
                    <h6 class="mb-3">Menu</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('dashboard') }}"><i class="bi bi-chevron-right me-1" style="font-size:.7rem;"></i> Dashboard</a></li>
                        <li><a href="{{ route('buku.index') }}"><i class="bi bi-chevron-right me-1" style="font-size:.7rem;"></i> Buku</a></li>
                        <li><a href="{{ route('anggota.index') }}"><i class="bi bi-chevron-right me-1" style="font-size:.7rem;"></i> Anggota</a></li>
                        <li><a href="{{ route('transaksi.index') }}"><i class="bi bi-chevron-right me-1" style="font-size:.7rem;"></i> Transaksi</a></li>
                        <li><a href="{{ route('transaksi.laporan') }}"><i class="bi bi-chevron-right me-1" style="font-size:.7rem;"></i> Laporan</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="mb-3">Kontak</h6>
                    <ul class="footer-links">
                        <li>
                            <i class="bi bi-envelope me-2"></i>
                            perpustakaan@example.com
                        </li>
                        <li>
                            <i class="bi bi-telephone me-2"></i>
                            (021) 1234-5678
                        </li>
                        <li>
                            <i class="bi bi-geo-alt me-2"></i>
                            Jakarta, Indonesia
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} Sistem Perpustakaan.
            Built with <i class="bi bi-heart-fill text-danger"></i> using Laravel.
        </div>
    </div>
</footer>
