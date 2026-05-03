<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Funcionario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        #sidebar { min-height: 100vh; background-color: #1e2a38; width: 250px; position: fixed; top: 0; left: 0; }
        #sidebar .nav-link { color: #cfd8dc; padding: .6rem 1rem; border-radius: .375rem; margin: 2px 8px; }
        #sidebar .nav-link:hover, #sidebar .nav-link.active { background: #2e3d4f; color: #fff; }
        #content { margin-left: 250px; padding: 2rem; }
        .info-label { font-size: .8rem; color: #6c757d; text-transform: uppercase; letter-spacing: .05em; }
        .info-value { font-size: 1rem; font-weight: 500; }
    </style>
</head>
<body>
    <div id="sidebar" class="d-flex flex-column py-3">
        <div class="px-3 mb-4">
            <img src="/img/logo.png" style="width:35px;" class="me-2">
            <span class="text-white fw-bold">Procesamiento de Datos</span>
        </div>
        <nav class="nav flex-column">
            <a href="/dashboard" class="nav-link"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            <a href="/funcionarios" class="nav-link active"><i class="bi bi-people me-2"></i>Funcionarios</a>
            <a href="/inventario" class="nav-link"><i class="bi bi-box-seam me-2"></i>Inventario</a>
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
            <a href="{{ route('funcionarios.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h4 class="fw-bold mb-0">Detalle del Funcionario</h4>
        </div>

        <div class="card border-0 shadow-sm" style="max-width: 750px;">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <div>
                    <h5 class="mb-0 fw-bold">{{ $funcionario->nombre_completo }}</h5>
                    <small class="text-muted">{{ $funcionario->cargo->descripcion ?? '-' }}</small>
                </div>
                <div class="d-flex gap-2">
                    <span class="badge bg-primary">{{ $funcionario->vinculo->descripcion ?? '-' }}</span>
                    <span class="badge bg-{{ $funcionario->estado_activo ? 'success' : 'secondary' }}">
                        {{ $funcionario->estado_activo ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="info-label">Cédula</div>
                        <div class="info-value">{{ $funcionario->ci }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label">Sexo</div>
                        <div class="info-value">{{ $funcionario->sexo == 'M' ? 'Masculino' : 'Femenino' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label">Fecha de Nacimiento</div>
                        <div class="info-value">{{ $funcionario->fecha_nacimiento?->format('d/m/Y') ?? '-' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label">Teléfono</div>
                        <div class="info-value">{{ $funcionario->telefono ?? '-' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label">Dependencia</div>
                        <div class="info-value">{{ $funcionario->dependencia->descripcion ?? '-' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label">Vínculo</div>
                        <div class="info-value">{{ $funcionario->vinculo->descripcion ?? '-' }}</div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4 pt-3 border-top">
                    <a href="{{ route('funcionarios.edit', $funcionario->id_funcionario) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i>Editar
                    </a>
                    <a href="{{ route('funcionarios.index') }}" class="btn btn-outline-secondary">
                        Volver al listado
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
