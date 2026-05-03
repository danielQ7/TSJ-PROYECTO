<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        #sidebar { min-height: 100vh; background-color: #1e2a38; width: 250px; position: fixed; top: 0; left: 0; }
        #sidebar .nav-link { color: #cfd8dc; padding: .6rem 1rem; border-radius: .375rem; margin: 2px 8px; }
        #sidebar .nav-link:hover, #sidebar .nav-link.active { background: #2e3d4f; color: #fff; }
        #content { margin-left: 250px; padding: 2rem; }
        .stat-card { border: none; border-radius: .75rem; transition: transform .2s; }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,.1); }
    </style>
</head>
<body>
    <div id="sidebar" class="d-flex flex-column py-3">
        <div class="px-3 mb-4">
            <h5 class="text-white fw-bold mb-0"><img src="/img/logo.png" style="width:35px;" class="me-2">Procesamiento de Datos</h5>
            <small class="text-white-50">Panel de gestión</small>
        </div>
        <nav class="nav flex-column">
            <a href="/dashboard" class="nav-link active"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            <a href="/empleados" class="nav-link"><i class="bi bi-people me-2"></i>Funcionarios</a>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Dashboard</h4>
            <span class="text-muted">Bienvenido, {{ auth()->user()->name }}</span>
        </div>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="card stat-card bg-primary text-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fs-2 fw-bold">{{ $stats['total_empleados'] }}</div>
                            <div>Funcionarios</div>
                        </div>
                        <i class="bi bi-people fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card bg-success text-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fs-2 fw-bold">{{ $stats['total_productos'] }}</div>
                            <div>Activos</div>
                        </div>
                        <i class="bi bi-box-seam fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card bg-danger text-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fs-2 fw-bold">{{ $stats['stock_bajo'] }}</div>
                            <div>Stock Bajo</div>
                        </div>
                        <i class="bi bi-exclamation-triangle fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card bg-warning text-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fs-2 fw-bold">{{ $stats['movimientos_hoy'] }}</div>
                            <div>Movimientos Hoy</div>
                        </div>
                        <i class="bi bi-arrow-left-right fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
