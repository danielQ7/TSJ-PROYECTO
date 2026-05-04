<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencia</title>
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
        <div class="px-3 mb-4">
            <img src="/img/logo.png" style="width:35px;" class="me-2">
            <span class="text-white fw-bold">Procesamiento de Datos</span>
        </div>
        <nav class="nav flex-column">
            <a href="/dashboard" class="nav-link"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            <a href="/funcionarios" class="nav-link"><i class="bi bi-people me-2"></i>Funcionarios</a>
            <a href="/permisos" class="nav-link"><i class="bi bi-calendar-check me-2"></i>Permisos</a>
            <a href="/asistencias" class="nav-link active"><i class="bi bi-clock me-2"></i>Asistencias</a>
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
        <h4 class="fw-bold mb-4"><i class="bi bi-clock me-2"></i>Registro de Asistencia</h4>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Registro entrada/salida -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-success text-white fw-semibold">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Registrar Entrada
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('asistencias.entrada') }}">
                            @csrf
                            <label class="form-label fw-semibold">Número de Cédula</label>
                            <div class="input-group">
                                <input type="text" name="ci" class="form-control form-control-lg"
                                    placeholder="Ingrese su cédula..." required>
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </div>
                            <small class="text-muted">Se registrará la hora actual como entrada</small>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-danger text-white fw-semibold">
                        <i class="bi bi-box-arrow-right me-2"></i>Registrar Salida
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('asistencias.salida') }}">
                            @csrf
                            <label class="form-label fw-semibold">Número de Cédula</label>
                            <div class="input-group">
                                <input type="text" name="ci" class="form-control form-control-lg"
                                    placeholder="Ingrese su cédula..." required>
                                <button type="submit" class="btn btn-danger px-4">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </div>
                            <small class="text-muted">Se registrará la hora actual como salida</small>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtros -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('asistencias.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" name="ci" class="form-control"
                                placeholder="Buscar por cédula..." value="{{ request('ci') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="fecha" class="form-control" value="{{ request('fecha', date('Y-m-d')) }}">
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                        <a href="{{ route('asistencias.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Funcionario</th>
                            <th>Cédula</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($asistencias as $a)
                        <tr>
                            <td class="fw-semibold">{{ $a->funcionario->nombres ?? '-' }} {{ $a->funcionario->apellidos ?? '' }}</td>
                            <td>{{ $a->funcionario->ci ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($a->fecha_asis_ini)->format('d/m/Y H:i') }}</td>
                            <td>{{ $a->fecha_asis_fin ? \Carbon\Carbon::parse($a->fecha_asis_fin)->format('d/m/Y H:i') : '-' }}</td>
                            <td>
                                @if($a->fecha_asis_fin)
                                    <span class="badge bg-success">Completo</span>
                                @else
                                    <span class="badge bg-warning text-dark">En oficina</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                No hay registros de asistencia
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($asistencias->hasPages())
            <div class="card-footer bg-white">
                {{ $asistencias->links() }}
            </div>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
