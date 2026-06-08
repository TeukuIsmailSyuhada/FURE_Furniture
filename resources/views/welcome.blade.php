<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FURE - Kelola Furniture Lebih Rapi dan Efisien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .feature-card {
            padding: 30px;
            text-align: center;
            transition: transform 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--fure-primary);
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary fs-3" href="/">FURE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link px-3" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        @auth
                            <a class="btn btn-outline-primary ms-3 px-3 shadow-sm fw-bold"
                                href="{{ route('admin.dashboard') }}">KE DASHBOARD</a>
                            <form action="{{ route('logout') }}" method="POST" class="ms-2">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm px-3 fw-bold">LOGOUT</button>
                            </form>
                        @else
                            <a class="btn btn-primary ms-3 px-4 shadow-sm fw-bold" href="{{ route('login') }}">
                                <i class="bi bi-person-lock me-2"></i>LOGIN ADMIN
                            </a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section d-flex align-items-center">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-3 fw-bold mb-4">Kelola Furniture Lebih Rapi dan Efisien</h1>
                    <p class="lead mb-5 text-muted">FURE membantu pengelolaan data furniture, stok, lokasi, dan kondisi
                        barang dalam satu sistem berbasis web yang modern dan mudah digunakan.</p>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg px-5 py-3 shadow">BUKA
                            DASHBOARD</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 py-3 shadow">LOGIN</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <section id="features" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Fitur Utama FURE</h2>
                <div class="mx-auto bg-primary" style="height: 4px; width: 60px;"></div>
            </div>
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="card h-100 feature-card">
                        <div class="feature-icon">🪑</div>
                        <h4 class="fw-bold">Kelola Data Furniture</h4>
                        <p class="text-muted">Simpan data furniture lengkap dengan gambar, material, ukuran, dan
                            spesifikasi lainnya.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 feature-card">
                        <div class="feature-icon">📦</div>
                        <h4 class="fw-bold">Pantau Stok Barang</h4>
                        <p class="text-muted">Sistem stok otomatis dengan riwayat transaksi masuk dan keluar yang
                            tercatat rapi.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 feature-card">
                        <div class="feature-icon">🛡️</div>
                        <h4 class="fw-bold">Cek Kondisi Furniture</h4>
                        <p class="text-muted">Pantau kondisi setiap unit furniture dan catat riwayat perubahannya secara
                            berkala.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5 bg-white border-top">
        <div class="container text-center">
            <p class="mb-0 text-muted">&copy; 2026 FURE - Kelola Furniture Lebih Rapi dan Efisien.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>