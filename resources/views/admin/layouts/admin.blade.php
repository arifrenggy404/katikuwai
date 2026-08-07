<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Desa Katikuwai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --sidebar-width: 250px;
            --primary-green: #198754;
            --dark-bg: #1e293b;
        }
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: #f8fafc;
        }
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--dark-bg);
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            transition: all 0.3s;
        }
        #sidebar .nav-link {
            color: #94a3b8;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 4px 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        #sidebar .nav-link:hover, #sidebar .nav-link.active {
            color: #fff;
            background: var(--primary-green);
        }
        #main-content {
            margin-left: var(--sidebar-width);
            padding: 24px;
        }
        .navbar-top {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 24px;
            margin-left: var(--sidebar-width);
        }
        .card-dash {
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        .card-dash:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div id="sidebar">
        <div class="p-3 text-center border-bottom border-secondary">
            <h5 class="fw-bold mb-0 text-white"><i class="bi bi-shield-lock text-success me-2"></i>Admin Panel</h5>
            <small class="text-muted">Desa Katikuwai</small>
        </div>
        <div class="py-3">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('admin.news.index') }}" class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                <i class="bi bi-newspaper"></i> Berita Desa
            </a>
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Kategori Berita
            </a>
            <a href="{{ route('admin.pengaduan.index') }}" class="nav-link {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">
                <i class="bi bi-chat-left-dots"></i> Pengaduan
            </a>
            <a href="{{ route('admin.letters.index') }}" class="nav-link {{ request()->routeIs('admin.letters.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-check"></i> Surat Online
            </a>
            <a href="{{ route('admin.events.index') }}" class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                <i class="bi bi-calendar-event"></i> Agenda Desa
            </a>
            <a href="{{ route('admin.officials.index') }}" class="nav-link {{ request()->routeIs('admin.officials.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Perangkat Desa
            </a>
            <a href="{{ route('admin.dokumen.index') }}" class="nav-link {{ request()->routeIs('admin.dokumen.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> Dokumen Publik
            </a>
            <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i> Pengaturan & Footer
            </a>
            <a href="{{ route('home') }}" target="_blank" class="nav-link">
                <i class="bi bi-box-arrow-up-right"></i> Lihat Website
            </a>
            <hr class="mx-3 text-secondary">
            <form action="{{ route('admin.logout') }}" method="POST" class="px-3">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 rounded-3 text-start px-3 py-2">
                    <i class="bi bi-box-arrow-right me-2"></i> Keluar
                </button>
            </form>
        </div>
    </div>

    <!-- Topbar -->
    <div class="navbar-top d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0 fw-bold text-dark">@yield('title', 'Dashboard')</h5>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="text-muted small"><i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name ?? auth()->user()->email }}</span>
        </div>
    </div>

    <!-- Main Content -->
    <div id="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
