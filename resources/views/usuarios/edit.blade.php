<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        #sidebar { min-height: 100vh; background-color: #1e2a38; width: 250px; position: fixed; top: 0; left: 0; }
        #sidebar .nav-link { color: #cfd8dc; padding: .6rem 1rem; border-radius: .375rem; margin: 2px 8px; }
        #sidebar .nav-link:hover, #sidebar .nav-link.active { background: #2e3d4f; color: #fff; }
        #content { margin-left: 250px; padding: 2rem; }
    </style>
</head>
<body>
    <div id="sidebar" class="d-flex flex-column py-3">
        <div class="px-3 mb-4 d-flex align-items-center">
            <img src="/img/logo.png" style="width:40px;" class="me-2">
            <span class="text-white fw-bold">Procesamiento de Datos</span>
        </div>
        <nav class="nav flex-column">
            <a href="/dashboard" class="nav-link"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            <a href="/funcionarios" class="nav-link"><i class="bi bi-people me-2"></i>Funcionarios</a>
            <a href="/permisos" class="nav-link"><i class="bi bi-calendar-check me-2"></i>Permisos</a>
            <a href="/asistencias" class="nav-link"><i class="bi bi-clock me-2"></i>Asistencias</a>
            <a href="/inventario" class="nav-link"><i class="bi bi-box-seam me-2"></i>Inventario</a>
            <a href="/usuarios" class="nav-link active"><i class="bi bi-person-gear me-2"></i>Usuarios</a>
            <a href="/reportes" class="nav-link"><i class="bi bi-bar-chart me-2"></i>Reportes</a>
        </nav>
        <div class="mt-auto px-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm w-100">
                    <i class="bi bi-box-arrow-left me-1"></i>Cerrar sesión
                </button>
            </form>
        </div>
    </div>

    <div id="content">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h4 class="fw-bold mb-0">Editar Usuario</h4>
        </div>

        <div class="card border-0 shadow-sm" style="max-width: 550px;">
            <div class="card-body p-4">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('usuarios.update', $usuario->id_usuario) }}">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Nombre de usuario *</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" name="nombre" class="form-control"
                                    value="{{ old('nombre', $usuario->nombre) }}" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Rol *</label>
                            <select name="id_rol" class="form-select" required>
                                <option value="">Seleccionar...</option>
                                @foreach($roles as $r)
                                    <option value="{{ $r->id_rol }}" {{ old('id_rol', $usuario->id_rol) == $r->id_rol ? 'selected' : '' }}>
                                        {{ $r->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Nueva Contraseña <small class="text-muted">(dejá vacío para no cambiar)</small></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Mínimo 6 caracteres">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Confirmar Nueva Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Repetí la contraseña">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="activo"
                                    {{ $usuario->activo ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold">Usuario activo</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="bi bi-check-lg me-1"></i>Actualizar
                        </button>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary px-4">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
