<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FURE - Eksklusivitas Pengelolaan Furniture</title>
    <!-- CSS Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&family=Lora:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--fure-bg);
        }
        
        .hero-title {
            font-size: 3.25rem;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: var(--fure-primary);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.25rem; /* Smoother scaling */
            }
        }

        .hero-subtitle {
            font-size: 1.1rem; /* Smaller subtitle */
            color: var(--fure-text-muted);
            max-width: 550px;
            margin-bottom: 2.5rem;
            border-left: 2px solid var(--fure-accent);
            padding-left: 20px;
        }

        .nav-link {
            text-transform: none; /* Less aggressive caps */
            font-size: 0.85rem;
            letter-spacing: 0.02em;
            font-weight: 500;
            color: var(--fure-text) !important;
        }

        .nav-link:hover {
            color: var(--fure-primary) !important;
        }

        .section-tag {
            text-transform: uppercase;
            letter-spacing: 0.15rem;
            font-size: 0.75rem;
            color: var(--fure-primary-light);
            font-weight: 700;
            display: block;
            margin-bottom: 0.75rem;
        }

        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            color: var(--fure-primary);
        }

        .hero-section {
            padding: 160px 0;
            background: linear-gradient(rgba(252, 251, 250, 0.7), rgba(252, 251, 250, 0.7)), url('https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
            box-shadow: inset 0 0 150px rgba(0,0,0,0.1);
        }

        .furniture-preview {
            position: relative;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            height: 600px;
            border: none;
            transition: all 0.7s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .furniture-preview:hover {
            transform: scale(1.02);
            background-size: 110%;
        }

        .overlay-text {
            position: absolute;
            bottom: 50px;
            left: 50px;
            color: white;
            z-index: 2;
            transition: all 0.5s ease;
        }

        .furniture-preview:hover .overlay-text {
            transform: translateY(-15px);
        }

        .furniture-preview::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            opacity: 0.7;
            transition: opacity 0.5s;
        }

        .furniture-preview:hover::after {
            opacity: 0.95;
        }
    </style>
</head>

<body class="overflow-hidden">
    <!-- Pre-loader -->
    <div id="fure-loader">
        <div class="loader-content">
            <div class="bg-fure-primary text-white p-3 d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px; border-radius: 0;">
                <i class="bi bi-chair-fill fs-3"></i>
            </div>
            <h2 class="brand-text text-fure-primary fs-3 fw-800" style="letter-spacing: -0.03em;">FURE</h2>
            <div class="mt-3">
                <div class="progress bg-accent bg-opacity-25" style="height: 3px; width: 120px; border-radius: 0; margin: 0 auto;">
                    <div class="progress-bar bg-fure-primary" style="width: 100%; transition: width 2s ease-in-out;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg py-3 sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <div class="bg-fure-primary text-white p-2 d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                    <i class="bi bi-chair-fill small"></i>
                </div>
                <span class="brand-text text-fure-primary fs-4">FURE</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-2"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link px-3" href="#vision">Visi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="#gallery">Galeri</a>
                    </li>
                    <li class="nav-item ms-lg-4">
                        @auth
                            <a class="btn btn-primary btn-sm px-4 shadow-sm" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        @else
                            <a class="btn btn-primary btn-sm px-4 shadow-sm" href="{{ route('login') }}">
                                <i class="bi bi-lock-fill me-2 small"></i>Admin Area
                            </a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <span class="section-tag animate-fade-up">Platform Inventaris Profesional</span>
                    <h1 class="hero-title animate-flip delay-1">Optimalkan Pengelolaan Aset Furniture Secara Presisi</h1>
                    <p class="hero-subtitle animate-fade-up delay-2">Kendali penuh atas kualitas, lokasi, dan distribusi aset dalam satu ekosistem digital yang terintegrasi.</p>
                    <div class="d-flex gap-3 animate-fade-up delay-3">
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary px-5 py-3 shadow-fure">Kelola Sekarang</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary px-5 py-3">Mulai Eksplorasi</a>
                            <a href="#features" class="btn btn-outline-primary px-5 py-3">Pelajari Fitur</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Stats/Vision Section -->
    <section id="vision" class="py-5 bg-white shadow-sm">
        <div class="container py-lg-5">
            <div class="row g-5">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-5 h-100 stat-card-animated animate-flip delay-4">
                        <div class="stat-number mb-2">01.</div>
                        <h5 class="fw-bold mb-3">Transparansi Stok</h5>
                        <p class="text-muted small">Pantau pergerakan aset secara real-time dengan akurasi data yang tidak tertandingi.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-5 h-100 stat-card-animated animate-flip delay-5">
                        <div class="stat-number mb-2">02.</div>
                        <h5 class="fw-bold mb-3">Kendali Kualitas</h5>
                        <p class="text-muted small">Sistem monitoring kondisi yang mendalam untuk memastikan standard aset tetap terjaga.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-5 h-100 stat-card-animated animate-flip delay-6">
                        <div class="stat-number mb-2">03.</div>
                        <h5 class="fw-bold mb-3">Efisiensi Lokasi</h5>
                        <p class="text-muted small">Optimalkan penempatan furniture di berbagai lokasi dengan manajemen dataset yang rapi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container py-lg-5">
            <div class="row mb-5 align-items-end">
                <div class="col-lg-6">
                    <span class="section-tag">Kapabilitas</span>
                    <h2 class="display-5">Solusi Menyeluruh Inventori Anda</h2>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <p class="text-muted mb-0 max-width-400 ms-lg-auto">Meninggalkan metode konvensional. FURE membawa teknologi modern ke dalam setiap sudut gudang dan ruangan Anda.</p>
                </div>
            </div>
            <div class="row g-0">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon text-fure-primary">
                            <i class="bi bi-stack"></i>
                        </div>
                        <h4 class="fw-bold">Manajemen Katalog</h4>
                        <p class="text-muted">Pengelompokan furniture berdasarkan tipe, material, dan dimensi secara sistematis.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon text-fure-primary">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h4 class="fw-bold">Alur Stok Dinamis</h4>
                        <p class="text-muted">Riwayat transaksi masuk dan keluar yang tercatat secara otomatis untuk audit yang mudah.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon text-fure-primary">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4 class="fw-bold">Verifikasi Kondisi</h4>
                        <p class="text-muted">Pelaporan kondisi unit secara berkala untuk perencanaan pemeliharaan aset yang tepat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Section -->
    <section id="gallery" class="py-5 bg-white">
        <div class="container-fluid px-0">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="furniture-preview" style="background-image: url('https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=1200&q=80')">
                        <div class="overlay-text">
                            <span class="small fw-bold text-uppercase ls-wide">Koleksi Admin</span>
                            <h3 class="playfair">Desain Modern Minimalis</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="furniture-preview" style="background-image: url('https://images.unsplash.com/photo-1524758631624-e2822e304c36?auto=format&fit=crop&w=1200&q=80')">
                        <div class="overlay-text">
                            <span class="small fw-bold text-uppercase ls-wide">Manajemen Ruang</span>
                            <h3 class="playfair">Optimalisasi Estetika Ruang</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 border-top">
        <div class="container py-lg-4">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-fure-primary text-white p-2 d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                            <i class="bi bi-chair-fill small"></i>
                        </div>
                        <span class="brand-text text-fure-primary fs-4">FURE</span>
                    </div>
                    <p class="text-muted small">Transformasi digital untuk manajemen aset furniture yang lebih profesional dan elegan.</p>
                    <div class="d-flex gap-3 fs-6">
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-linkedin"></i>
                        <i class="bi bi-globe"></i>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h6 class="tiny fw-bold text-uppercase ls-wide text-muted mb-4">Tautan Cepat</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Beranda</a></li>
                        <li class="mb-2"><a href="#vision" class="text-decoration-none text-muted small">Visi</a></li>
                        <li class="mb-2"><a href="#features" class="text-decoration-none text-muted small">Fitur</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 mb-4">
                    <h6 class="tiny fw-bold text-uppercase ls-wide text-muted mb-4">Kontak Teknis</h6>
                    <p class="text-muted small mb-1"><i class="bi bi-envelope me-2"></i> support@fure.id</p>
                    <p class="text-muted small"><i class="bi bi-telephone me-2"></i> +62 (21) 500-1234</p>
                </div>
                <div class="col-lg-3 col-md-4 text-lg-end">
                    <h6 class="tiny fw-bold text-uppercase ls-wide text-muted mb-4">Status Sistem</h6>
                    <span class="badge border border-success text-success bg-white px-3 py-2 rounded-0 tiny fw-bold">
                        <i class="bi bi-check-circle-fill me-1"></i> OPERATIONAL
                    </span>
                </div>
            </div>
            <div class="border-top mt-5 pt-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
                <p class="text-muted tiny mb-0">&copy; {{ date('Y') }} FURE Furniture Management. All rights reserved.</p>
                <div class="d-flex gap-4 mt-3 mt-md-0">
                    <a href="#" class="text-decoration-none text-muted tiny">Privacy Policy</a>
                    <a href="#" class="text-decoration-none text-muted tiny">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                const loader = document.getElementById('fure-loader');
                loader.classList.add('fade-out');
                document.body.classList.remove('overflow-hidden');
            }, 1200); // Wait 1.2s for the branding to be seen
        });
    </script>
</body>

</html>