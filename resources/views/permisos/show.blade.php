<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Permiso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        #sidebar { min-height: 100vh; background-color: #1e2a38; width: 250px; position: fixed; top: 0; left: 0; }
        #sidebar .nav-link { color: #cfd8dc; padding: .6rem 1rem; border-radius: .375rem; margin: 2px 8px; }
        #sidebar .nav-link:hover, #sidebar .nav-link.active { background: #2e3d4f; color: #fff; }
        #content { margin-left: 250px; padding: 2rem; }
        .info-label { font-size: .8rem; color: #6c757d; text-transform: uppercase; }
        .info-value { font-size: 1rem; font-weight: 500; }
        @media print {
            #sidebar, .no-print { display: none !important; }
            #content { margin-left: 0; }
        }
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
            <a href="/funcionarios" class="nav-link"><i class="bi bi-people me-2"></i>Funcionarios</a>
            <a href="/permisos" class="nav-link active"><i class="bi bi-calendar-check me-2"></i>Permisos</a>
            <a href="/asistencias" class="nav-link"><i class="bi bi-clock me-2"></i>Asistencias</a>
            <a href="/inventario" class="nav-link"><i class="bi bi-box-seam me-2"></i>Inventario</a>
            <a href="/usuarios" class="nav-link"><i class="bi bi-person-gear me-2"></i>Usuarios</a>
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
        <div class="d-flex align-items-center gap-3 mb-4 no-print">
            <a href="{{ route('permisos.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h4 class="fw-bold mb-0">Detalle del Permiso</h4>
            <button onclick="window.print()" class="btn btn-outline-dark btn-sm ms-auto">
                <i class="bi bi-printer me-1"></i>Imprimir
            </button>
        </div>

        <div class="card border-0 shadow-sm" style="max-width: 750px;">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-bold">{{ $permiso->funcionario->nombres }} {{ $permiso->funcionario->apellidos }}</h5>
                        <small class="text-muted">CI: {{ $permiso->funcionario->ci }}</small>
                    </div>
                    <span class="badge bg-info text-dark fs-6">{{ $permiso->tipoPermiso->descripcion }}</span>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="info-label">Fecha Desde</div>
                        <div class="info-value">{{ $permiso->fecha_ini->format('d/m/Y') }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label">Fecha Hasta</div>
                        <div class="info-value">{{ $permiso->fecha_fin->format('d/m/Y') }}</div>
                    </div>
                    @if($permiso->hora_ini)
                    <div class="col-md-6">
                        <div class="info-label">Hora Entrada</div>
                        <div class="info-value">{{ $permiso->hora_ini }}</div>
                    </div>
                    @endif
                    @if($permiso->hora_fin)
                    <div class="col-md-6">
                        <div class="info-label">Hora Salida</div>
                        <div class="info-value">{{ $permiso->hora_fin }}</div>
                    </div>
                    @endif
                    <div class="col-md-6">
                        <div class="info-label">Días Hábiles</div>
                        <div class="info-value">{{ $permiso->dias_habiles }} días</div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label">Fecha de Registro</div>
                        <div class="info-value">{{ $permiso->created_at ? \Carbon\Carbon::parse($permiso->created_at)->format('d/m/Y H:i') : '-' }}</div>
                    </div>
                    <div class="col-12">
                        <div class="info-label">Justificación</div>
                        <div class="info-value">{{ $permiso->justificacion }}</div>
                    </div>
                    @if($permiso->observaciones)
                    <div class="col-12">
                        <div class="info-label">Observaciones</div>
                        <div class="info-value">{{ $permiso->observaciones }}</div>
                    </div>
                    @endif
                </div>

                <div class="mt-4 pt-3 border-top no-print">
                    <a href="{{ route('permisos.index') }}" class="btn btn-outline-secondary">
                        Volver al listado
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
