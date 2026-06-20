<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin - FURE</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&family=Lora:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--fure-bg);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }

        .login-container {
            display: flex;
            width: 1000px;
            max-width: 95vw;
            height: 600px;
            background: white;
            border: 1px solid var(--fure-border);
            overflow: hidden;
        }

        .login-visual {
            flex: 1;
            background: linear-gradient(rgba(78, 52, 46, 0.4), rgba(78, 52, 46, 0.4)), url('{{ asset('images/login-bg.jpg') }}');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 50px;
            color: white;
        }

        .login-form-side {
            width: 450px;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-control {
            border-radius: 0;
            border: 1px solid #eee;
            padding: 12px 15px;
            background-color: #fcfcfc;
            font-size: 0.9rem;
        }

        .form-control:focus {
            border-color: var(--fure-primary);
            box-shadow: none;
            background-color: white;
        }

        .login-visual h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 3rem;
            color: white;
            margin-bottom: 20px;
            letter-spacing: -0.04em;
        }

        .login-visual p {
            font-weight: 300;
            letter-spacing: 1px;
            opacity: 0.9;
        }

        @media (max-width: 900px) {
            .login-visual {
                display: none;
            }
            .login-container {
                width: 450px;
                height: auto;
            }
            .login-form-side {
                width: 100%;
                padding: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-visual">
            <div class="d-flex align-items-center mb-4">
                <div class="bg-white text-fure-primary p-2 d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                    <i class="bi bi-chair-fill fs-5"></i>
                </div>
                <span class="brand-text text-white fs-3">FURE</span>
            </div>
            <h2>Manajer <br><i class="playfair">Interior Professional.</i></h2>
            <p>Akses konsol administrasi untuk mengelola aset dan inventaris furniture terbaik Anda.</p>
        </div>
        <div class="login-form-side">
            <div class="mb-5">
                <h3 class="fw-bold mb-2" style="font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: -0.02em;">Selamat Datang</h3>
                <p class="text-muted small">Silakan masuk menggunakan akun administratif Anda.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger border-0 small mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger border-0 small mb-4">
                    <i class="bi bi-exclamation-circle me-2"></i> {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label small text-uppercase fw-bold ls-wide" style="font-size: 0.7rem;">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="admin@fure.com" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label small text-uppercase fw-bold ls-wide" style="font-size: 0.7rem;">Password Security</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label small text-muted" for="remember">Ingat saya</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-3 mb-4 shadow-fure">Masuk ke Konsol</button>
                
                <div class="text-center">
                    <a href="/" class="text-decoration-none text-muted small"><i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
