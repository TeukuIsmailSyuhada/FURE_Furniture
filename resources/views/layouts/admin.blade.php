<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Console FURE</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&family=Lora:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--fure-bg);
            color: var(--fure-text);
        }

        .wrapper {
            display: flex;
            align-items: stretch;
            min-height: 100vh;
        }

        #sidebar {
            width: 280px;
            min-width: 280px;
            background: #fff;
            color: var(--fure-text);
            transition: all 0.3s;
            border-right: 1px solid var(--fure-border);
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        #sidebar.active {
            margin-left: -280px;
        }

        .sidebar-header {
            padding: 40px 30px;
            border-bottom: 1px solid var(--fure-bg);
        }

        .sidebar-brand {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--fure-primary);
            text-decoration: none;
            letter-spacing: -0.03em;
        }

        .sidebar-heading {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            font-weight: 700;
            color: var(--fure-text-muted);
            padding: 30px 30px 10px;
        }

        #sidebar .nav-link {
            padding: 12px 30px;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--fure-text);
            display: flex;
            align-items: center;
            border-left: 4px solid transparent;
            transition: all 0.2s;
        }

        #sidebar .nav-link i {
            margin-right: 15px;
            font-size: 1.1rem;
            color: var(--fure-text-muted);
        }

        #sidebar .nav-link:hover {
            background: var(--fure-bg);
            color: var(--fure-primary);
            border-left-color: var(--fure-accent);
        }

        #sidebar .nav-link.active {
            background: var(--fure-bg);
            color: var(--fure-primary);
            border-left-color: var(--fure-primary);
            font-weight: 600;
        }

        #sidebar .nav-link.active i {
            color: var(--fure-primary);
        }

        #content {
            width: 100%;
            padding: 0;
            min-height: 100vh;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        /* Topbar */
        .topbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--fure-border);
            padding: 15px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .breadcrumb-item a {
            color: var(--fure-text-muted);
            text-decoration: none;
            font-size: 0.85rem;
        }

        .breadcrumb-item.active {
            color: var(--fure-primary);
            font-weight: 600;
            font-size: 0.85rem;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: var(--fure-primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .main-content {
            padding: 40px;
            flex-grow: 1;
        }

        /* Page Headers */
        .page-header {
            margin-bottom: 40px;
        }

        .page-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.02em;
        }

        .page-subtitle {
            color: var(--fure-text-muted);
            font-size: 0.95rem;
        }

        /* Admin Layout Footer */
        .admin-footer {
            padding: 20px 40px;
            background: #fff;
            border-top: 1px solid var(--fure-border);
            font-size: 0.8rem;
            color: var(--fure-text-muted);
            text-align: center;
        }

        @media (max-width: 992px) {
            #sidebar {
                margin-left: -280px;
                position: fixed;
                height: 100vh;
            }
            #sidebar.active {
                margin-left: 0;
            }
            .topbar {
                padding: 15px 20px;
            }
            .main-content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                    <div class="bg-fure-primary text-white p-2 d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                        <i class="bi bi-chair-fill small"></i>
                    </div>
                    <span class="brand-text text-fure-primary fs-4">FURE</span>
                </a>
            </div>

            <div class="sidebar-menu overflow-y-auto">
                <div class="sidebar-heading">Ringkasan</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-grid"></i> Dashboard
                        </a>
                    </li>
                </ul>

                <div class="sidebar-heading">Inventaris</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('furnitures.index') }}" class="nav-link {{ request()->routeIs('furnitures.*') ? 'active' : '' }}">
                            <i class="bi bi-box-seam"></i> Furniture
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                            <i class="bi bi-collection"></i> Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('locations.index') }}" class="nav-link {{ request()->routeIs('locations.*') ? 'active' : '' }}">
                            <i class="bi bi-geo-alt"></i> Lokasi Gedung
                        </a>
                    </li>
                </ul>

                <div class="sidebar-heading">Logistik</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('stock-transactions.index') }}" class="nav-link {{ request()->routeIs('stock-transactions.*') ? 'active' : '' }}">
                            <i class="bi bi-arrow-down-up"></i> Pergerakan Stok
                        </a>
                    </li>
                </ul>

                <div class="sidebar-heading">Analitik</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                            <i class="bi bi-journal-text"></i> Laporan Aset
                        </a>
                    </li>
                </ul>

                <div class="mt-auto py-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link text-danger w-100 border-0 bg-transparent text-start">
                            <i class="bi bi-box-arrow-right"></i> Keluar Sesi
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div id="content">
            <header class="topbar">
                <button type="button" id="sidebarCollapse" class="btn btn-link p-0 text-fure-primary d-lg-none">
                    <i class="bi bi-list fs-3"></i>
                </button>
                
                <nav aria-label="breadcrumb" class="d-none d-md-block">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Console</a></li>
                        @yield('breadcrumb')
                    </ol>
                </nav>

                <div class="user-profile dropdown">
                    <div class="text-end d-none d-sm-block">
                        <div class="small fw-bold">{{ auth()->user()->name }}</div>
                        <div class="text-muted tiny" style="font-size: 10px; text-transform: uppercase; letter-spacing: 1px;">Administrator</div>
                    </div>
                    <div class="user-avatar dropdown-toggle" data-bs-toggle="dropdown">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3">
                        <li><a class="dropdown-item py-2" href="#"><i class="bi bi-person me-2"></i> Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger py-2">
                                    <i class="bi bi-box-arrow-right me-2"></i> Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </header>

            <main class="main-content">
                @if(session('success'))
                    <div class="alert alert-success border-0 bg-white border-start border-4 border-success shadow-sm mb-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger border-0 bg-white border-start border-4 border-danger shadow-sm mb-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill text-danger fs-4 me-3"></i>
                            <div>{{ session('error') }}</div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>

            <footer class="admin-footer">
                &copy; 2026 FURE - Elegant Workspace Management. Versi 2.0 Redesign.
            </footer>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.getElementById('sidebarCollapse')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
    @stack('scripts')
</body>
</html>
