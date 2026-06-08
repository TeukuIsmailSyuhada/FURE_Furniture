<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - FURE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            font-family: 'Outfit', sans-serif;
            overflow: hidden;
        }
        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
            position: relative;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            padding: 40px;
            transition: all 0.3s ease;
        }
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.08);
        }
        .brand-logo {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--fure-primary);
            letter-spacing: -1px;
            margin-bottom: 5px;
        }
        .form-control {
            border-radius: 12px;
            padding: 12px 18px;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
            transition: all 0.2s;
        }
        .form-control:focus {
            background-color: #fff;
            border-color: var(--fure-primary);
            box-shadow: 0 0 0 4px rgba(139, 94, 60, 0.1);
        }
        .btn-login {
            background: var(--fure-primary);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background: #6F4B30;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(139, 94, 60, 0.2);
        }
        .decorative-circle {
            position: absolute;
            z-index: -1;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--fure-primary), var(--fure-secondary));
            opacity: 0.1;
        }
        .circle-1 {
            width: 300px;
            height: 300px;
            top: -150px;
            right: -150px;
        }
        .circle-2 {
            width: 200px;
            height: 200px;
            bottom: -100px;
            left: -100px;
        }
    </style>
</head>
<body>
    <div class="decorative-circle circle-1"></div>
    <div class="decorative-circle circle-2"></div>

    <div class="login-container">
        <div class="login-card">
            <div class="text-center mb-5">
                <div class="brand-logo">FURE</div>
                <p class="text-muted">Furniture & Inventory Management</p>
            </div>
            
            @if(session('error'))
                <div class="alert alert-danger border-0 small py-2 mb-4 d-flex align-items-center">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label small fw-bold text-dark">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 pe-0 text-muted">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" name="email" class="form-control border-start-0 ps-2" placeholder="admin@fure.com" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold text-dark">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 pe-0 text-muted">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" name="password" class="form-control border-start-0 ps-2" placeholder="••••••••" required>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                    </div>
                    <a href="#" class="small text-decoration-none text-primary">Lupa Password?</a>
                </div>
                <button type="submit" class="btn btn-login">
                    Masuk Sekarang <i class="bi bi-arrow-right ms-2"></i>
                </button>
            </form>
            
            <div class="text-center mt-5">
                <a href="/" class="text-decoration-none text-muted small d-flex align-items-center justify-content-center">
                    <i class="bi bi-chevron-left me-1"></i> Kembali ke Halaman Utama
                </a>
            </div>
        </div>
    </div>
</body>
</html>
