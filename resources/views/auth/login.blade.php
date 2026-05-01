<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .login-card {
            max-width: 420px;
            margin: 100px auto;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .login-header {
            background-color: #1e2a38;
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 2rem;
            text-align: center;
        }
        .login-body { padding: 2rem; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card login-card">
            <div class="login-header">
                <i class="bi bi-shield-lock fs-1"></i>
                <h4 class="mt-2 mb-0">Sistema de Gestión</h4>
                <small class="text-white-50">Ingresá tus credenciales para continuar</small>
            </div>
            <div class="login-body">

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Correo electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email') }}" placeholder="usuario@ejemplo.com" required autofocus>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" id="password"
                                name="password" placeholder="••••••••" required>
                        </div>
                    </div>
                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Recordarme</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Ingresar
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
