<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Perpustakaan') — Sistem Perpustakaan</title>

    {{-- Fonts — Inter & JetBrains Mono --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">

    @stack('styles')

    {{-- Design System --}}
    <style>
        :root {
            --primary: #4F46E5;
            --primary-light: #6366F1;
            --primary-dark: #4338CA;
            --primary-50: #EEF2FF;
            --primary-100: #E0E7FF;
            --secondary: #0EA5E9;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --bg-body: #F1F5F9;
            --bg-card: #FFFFFF;
            --text-primary: #1E293B;
            --text-secondary: #64748B;
            --border-color: #E2E8F0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --radius-sm: 0.5rem;
            --radius: 0.75rem;
            --radius-lg: 1rem;
            --radius-xl: 1.25rem;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-body);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ─── Scrollbar ─── */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94A3B8; }

        /* ─── Main Content ─── */
        .main-content {
            flex: 1;
            padding-top: 1.5rem;
            padding-bottom: 2.5rem;
        }

        /* ─── Cards ─── */
        .card-modern {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: box-shadow 0.2s ease, transform 0.2s ease;
        }
        .card-modern:hover {
            box-shadow: var(--shadow-md);
        }
        .card-modern .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 1.5rem;
            font-weight: 600;
        }
        .card-modern .card-body {
            padding: 1.5rem;
        }

        /* ─── Stats Cards ─── */
        .stat-card {
            position: relative;
            overflow: hidden;
            border: none;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }
        .stat-card .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        .stat-card .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            line-height: 1.2;
        }
        .stat-card .stat-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 0.25rem;
        }

        /* ─── Tables ─── */
        .table-modern {
            margin-bottom: 0;
        }
        .table-modern thead th {
            background: #F8FAFC;
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.8125rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            padding: 0.75rem 1rem;
            border-bottom: 2px solid var(--border-color);
        }
        .table-modern tbody td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #F1F5F9;
            font-size: 0.9rem;
        }
        .table-modern tbody tr:hover {
            background: var(--primary-50);
        }
        .table-modern tbody tr:last-child td {
            border-bottom: none;
        }

        /* ─── Buttons ─── */
        .btn-modern {
            border-radius: var(--radius-sm);
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }
        .btn-modern.btn-sm {
            padding: 0.375rem 0.875rem;
            font-size: 0.8125rem;
        }
        .btn-modern.btn-lg {
            padding: 0.75rem 2rem;
            font-size: 1rem;
        }
        .btn-primary-modern {
            background: var(--primary);
            color: #fff;
            border: none;
        }
        .btn-primary-modern:hover {
            background: var(--primary-dark);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
        }

        /* ─── Badges ─── */
        .badge-modern {
            font-weight: 500;
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
            border-radius: 6px;
        }

        /* ─── Form Controls ─── */
        .form-control, .form-select {
            border-radius: var(--radius-sm);
            border: 1.5px solid var(--border-color);
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        }
        .form-label {
            font-weight: 500;
            font-size: 0.875rem;
            color: var(--text-primary);
            margin-bottom: 0.4rem;
        }
        .form-text {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        /* ─── Alerts ─── */
        .alert-modern {
            border: none;
            border-radius: var(--radius-sm);
            padding: 1rem 1.25rem;
        }

        /* ─── Breadcrumbs ─── */
        .breadcrumb-modern {
            background: transparent;
            padding: 0;
            margin-bottom: 1.25rem;
        }
        .breadcrumb-modern .breadcrumb-item + .breadcrumb-item::before {
            color: var(--text-secondary);
        }
        .breadcrumb-modern .breadcrumb-item a {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .breadcrumb-modern .breadcrumb-item a:hover {
            color: var(--primary);
        }
        .breadcrumb-modern .breadcrumb-item.active {
            color: var(--text-primary);
            font-weight: 600;
        }

        /* ─── Page Header ─── */
        .page-header {
            margin-bottom: 1.75rem;
        }
        .page-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
        }
        .page-header .page-subtitle {
            font-size: 0.875rem;
            color: var(--text-secondary);
            margin-top: 0.25rem;
        }

        /* ─── Empty State ─── */
        .empty-state {
            padding: 3rem 1.5rem;
            text-align: center;
        }
        .empty-state .empty-icon {
            font-size: 3.5rem;
            color: #CBD5E1;
            margin-bottom: 1rem;
        }
        .empty-state h5 {
            color: var(--text-secondary);
            font-weight: 600;
        }
        .empty-state p {
            color: #94A3B8;
            font-size: 0.9rem;
        }

        /* ─── Section Divider ─── */
        .section-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-100);
        }

        /* ─── Responsive refinements ─── */
        @media (max-width: 768px) {
            .stat-card .stat-value { font-size: 1.5rem; }
            .stat-card .stat-icon { width: 48px; height: 48px; font-size: 1.25rem; }
            .card-modern .card-body { padding: 1.25rem; }
            .page-header h1 { font-size: 1.25rem; }
        }
        @media (max-width: 576px) {
            .main-content { padding-top: 1rem; }
            .table-responsive { border-radius: var(--radius-sm); }
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Flash Messages --}}
    @if (session('success') || session('error') || session('info') || session('warning'))
    <div class="container-fluid px-4 mt-3">
        <div class="row justify-content-center">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show alert-modern d-flex align-items-center gap-2" role="alert">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show alert-modern d-flex align-items-center gap-2" role="alert">
                        <i class="bi bi-x-circle-fill fs-5"></i>
                        <span>{{ session('error') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if (session('info'))
                    <div class="alert alert-info alert-dismissible fade show alert-modern d-flex align-items-center gap-2" role="alert">
                        <i class="bi bi-info-circle-fill fs-5"></i>
                        <span>{{ session('info') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if (session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show alert-modern d-flex align-items-center gap-2" role="alert">
                        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                        <span>{{ session('warning') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    {{-- Page Content --}}
    <main class="main-content">
        <div class="container-fluid px-4">
            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

    @stack('scripts')

    <script>
        // Auto-dismiss flash alerts
        document.querySelectorAll('.alert-dismissible').forEach(alert => {
            setTimeout(() => {
                let bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            }, 5000);
        });
    </script>
</body>
</html>
