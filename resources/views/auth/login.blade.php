<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Procesamiento de Datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1e2a38 0%, #2e3d4f 50%, #1a2332 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .particles {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .particle {
            position: absolute;
            width: 4px; height: 4px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            animation: float linear infinite;
        }

        @keyframes float {
            0%   { transform: translateY(100vh); opacity: 0; }
            10%  { opacity: 1; }
            90%  { opacity: 1; }
            100% { transform: translateY(-100px); opacity: 0; }
        }

        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
            padding: 1rem;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        @keyframes slideUp {
            from { transform: translateY(40px); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }

        .login-card {
            background: rgba(255,255,255,0.97);
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.4);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, #1e2a38, #2e3d4f);
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 60%);
            animation: pulse-bg 3s ease-in-out infinite;
        }

        @keyframes pulse-bg {
            0%, 100% { transform: scale(1); }
            50%       { transform: scale(1.1); }
        }

        .logo-container {
            position: relative;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .logo-container img {
            width: 70px;
            position: relative;
            z-index: 1;
            animation: logoBounce 2s ease-in-out infinite;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
        }

        @keyframes logoBounce {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-6px); }
        }

        .logo-ring {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 90px; height: 90px;
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 50%;
            animation: ringPulse 2s ease-in-out infinite;
        }

        @keyframes ringPulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1);   opacity: 0.5; }
            50%       { transform: translate(-50%, -50%) scale(1.2); opacity: 0; }
        }

        .login-header h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1.2rem;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .login-header small {
            color: rgba(255,255,255,0.6);
            position: relative;
            z-index: 1;
        }

        .login-body { padding: 2rem; }

        .field-group { margin-bottom: 1.2rem; }

        .field-group label {
            font-weight: 600;
            color: #495057;
            font-size: .9rem;
            margin-bottom: .4rem;
            display: block;
            transition: color 0.3s;
        }

        .field-group:focus-within label { color: #1e2a38; }

        .input-wrap {
            position: relative;
        }

        .input-wrap i {
            position: absolute;
            left: .85rem;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            font-size: 1rem;
            transition: color 0.3s;
            z-index: 5;
        }

        .field-group:focus-within .input-wrap i { color: #1e2a38; }

        .input-wrap input {
            width: 100%;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: .75rem 1rem .75rem 2.5rem;
            font-size: .95rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
            outline: none;
        }

        .input-wrap input:focus {
            border-color: #1e2a38;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(30,42,56,0.1);
            transform: translateY(-1px);
        }

        .btn-login {
            width: 100%;
            padding: .85rem;
            background: linear-gradient(135deg, #1e2a38, #2e3d4f);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: .5rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30,42,56,0.4);
        }

        .btn-login:active { transform: translateY(0); }

        .btn-shine {
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover .btn-shine { left: 100%; }

        .alert {
            border-radius: 10px;
            border: none;
            animation: shakeAlert 0.4s ease;
            margin-bottom: 1rem;
        }

        @keyframes shakeAlert {
            0%, 100% { transform: translateX(0); }
            25%       { transform: translateX(-8px); }
            75%       { transform: translateX(8px); }
        }

        .form-check-input:checked {
            background-color: #1e2a38;
            border-color: #1e2a38;
        }
    </style>
</head>
<body>
    <div class="particles" id="particles"></div>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-container">
                    <img src="/img/logo.png" alt="Logo">
                    <div class="logo-ring"></div>
                </div>
                <h4>Procesamiento de Datos</h4>
                <small>Ingresá tus credenciales para continuar</small>
            </div>
            <div class="login-body">

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <div class="field-group">
                        <label>Correo electrónico</label>
                        <div class="input-wrap">
                            <i class="bi bi-envelope"></i>
                            <input type="email" name="email"
                                value="{{ old('email') }}"
                                placeholder="usuario@ejemplo.com" required autofocus>
                        </div>
                    </div>

                    <div class="field-group">
                        <label>Contraseña</label>
                        <div class="input-wrap">
                            <i class="bi bi-lock"></i>
                            <input type="password" name="password"
                                placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label text-muted" for="remember">Recordarme</label>
                    </div>

                    <button type="submit" class="btn-login">
                        <div class="btn-shine"></div>
                        <i class="bi bi-box-arrow-in-right me-2"></i>Ingresar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const container = document.getElementById('particles');
        for (let i = 0; i < 25; i++) {
            const p = document.createElement('div');
            p.classList.add('particle');
            p.style.left = Math.random() * 100 + 'vw';
            p.style.width = p.style.height = (Math.random() * 4 + 2) + 'px';
            p.style.animationDuration = (Math.random() * 10 + 8) + 's';
            p.style.animationDelay = (Math.random() * 10) + 's';
            container.appendChild(p);
        }
    </script>
</body>
</html>
