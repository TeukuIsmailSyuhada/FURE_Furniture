<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin FURE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .wrapper {
            display: flex;
            width: 100%;
        }
        #sidebar {
            width: 280px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 999;
            background: #fff;
            transition: all 0.3s;
            overflow-y: auto;
        }
        #content {
            width: calc(100% - 280px);
            margin-left: 280px;
            transition: all 0.3s;
            min-height: 100vh;
        }
        .navbar-admin {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar">
            <div class="p-4 mb-3 border-bottom">
                <a href="{{ route('admin.dashboard') }}" class="text-decoration-none d-flex align-items-center">
                    <span class="fs-4 fw-bold text-primary">FURE</span>
                </a>
            </div>

            <div class="px-2">
                <p class="text-uppercase text-muted small fw-bold px-3 mt-4 mb-2">Utama</p>
                <div class="nav flex-column">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                    <a href="{{ route('furnitures.index') }}" class="nav-link {{ request()->routeIs('furnitures.*') ? 'active' : '' }}">
                        <i class="bi bi-chair me-2"></i> Data Furniture
                    </a>
                </div>

                <p class="text-uppercase text-muted small fw-bold px-3 mt-4 mb-2">Master Data</p>
                <div class="nav flex-column">
                    <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <i class="bi bi-tags me-2"></i> Kategori
                    </a>
                    <a href="{{ route('locations.index') }}" class="nav-link {{ request()->routeIs('locations.*') ? 'active' : '' }}">
                        <i class="bi bi-geo-alt me-2"></i> Lokasi
                    </a>
                </div>

                <p class="text-uppercase text-muted small fw-bold px-3 mt-4 mb-2">Riwayat & Kondisi</p>
                <div class="nav flex-column">
                    <a href="{{ route('stock-transactions.index') }}" class="nav-link {{ request()->routeIs('stock-transactions.*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam me-2"></i> Riwayat Stok Barang
                    </a>
                </div>

                <p class="text-uppercase text-muted small fw-bold px-3 mt-4 mb-2">Lainnya</p>
                <div class="nav flex-column">
                    <a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-bar-graph me-2"></i> Laporan Data
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="nav-link text-danger w-100 text-start border-0 bg-transparent">
                            <i class="bi bi-box-arrow-right me-2"></i> Keluar
                        </button>
                    </form>
                </div>
                <div class="mt-auto p-3 border-top bg-light user-session-sidebar">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white me-2" style="width: 35px; height: 35px; font-size: 14px;">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="overflow-hidden">
                            <div class="small fw-bold text-dark text-truncate">{{ auth()->user()->name }}</div>
                            <div class="text-muted tiny" style="font-size: 10px;">Login aktif: Admin</div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-admin py-3 px-4 sticky-top">
                <div class="container-fluid">
                    <span class="navbar-text text-muted">
                        Halo, <strong>{{ auth()->user()->name }}</strong>
                    </span>
                    <div class="ms-auto d-flex align-items-center">
                        <div class="text-end me-3">
                            <div class="small fw-bold">{{ auth()->user()->name }}</div>
                            <div class="text-muted small">Administrator</div>
                        </div>
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 40px; height: 40px;">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </nav>

            <main class="p-4 p-lg-5">
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger border-0 shadow-sm mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>

            <footer class="p-4 border-top mt-auto bg-white">
                <div class="text-center text-muted small">
                    &copy; 2026 FURE - Kelola Furniture Lebih Rapi dan Efisien
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
