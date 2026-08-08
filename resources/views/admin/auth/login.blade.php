<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | {{ $setting->desa_name ?? 'Desa Katikuwai' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        .btn-green {
            background: #198754;
            color: #fff;
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            border: none;
            transition: all 0.3s;
        }
        .btn-green:hover {
            background: #157347;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="login-card text-center">
    <h4 class="fw-bold text-dark mb-1"><i class="bi bi-shield-lock text-success me-2"></i>Login Admin</h4>
    <p class="text-muted small">Sistem Informasi {{ $setting->desa_name ?? 'Desa Katikuwai' }}</p>

    <hr class="my-4 text-muted">

    @if ($errors->any())
        <div class="alert alert-danger text-start small rounded-3 mb-3">
            <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">
        @csrf
        <div class="mb-3 text-start">
            <label class="form-label text-muted fw-bold small">Email</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-0"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control border-0 bg-light py-2" placeholder="admin@example.com" value="{{ old('email') }}" required autofocus>
            </div>
        </div>
        <div class="mb-4 text-start">
            <label class="form-label text-muted fw-bold small">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-0"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" class="form-control border-0 bg-light py-2" placeholder="Password" required>
            </div>
        </div>
        <div class="mb-4 text-start form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label text-muted small" for="remember">Ingat Saya</label>
        </div>
        <button type="submit" class="btn btn-green w-100 shadow-sm">MASUK DASHBOARD</button>
    </form>

    <div class="mt-4">
        <a href="{{ route('home') }}" class="text-decoration-none text-muted small">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
        </a>
    </div>
</div>

</body>
</html>
