<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0"><i class="bi bi-person-gear me-2"></i>Usuarios del Sistema</h4>
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>Nuevo Usuario
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('usuarios.index') }}" class="row g-3">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control"
                                placeholder="Buscar por nombre de usuario..."
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="id_rol" class="form-select">
                            <option value="">Todos los roles</option>
                            @foreach($roles as $r)
                                <option value="{{ $r->id_rol }}" {{ request('id_rol') == $r->id_rol ? 'selected' : '' }}>
                                    {{ $r->descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuarios as $u)
                        <tr>
                            <td class="fw-semibold"><i class="bi bi-person-circle me-2 text-muted"></i>{{ $u->nombre }}</td>
                            <td>
                                <span class="badge bg-{{ $u->id_rol == 1 ? 'danger' : ($u->id_rol == 2 ? 'warning text-dark' : 'info text-dark') }}">
                                    {{ $u->rol->descripcion ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $u->activo ? 'success' : 'secondary' }}">
                                    {{ $u->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('usuarios.edit', $u->id_usuario) }}"
                                   class="btn btn-sm btn-outline-warning" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('usuarios.destroy', $u->id_usuario) }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Eliminar usuario {{ $u->nombre }}?')"
                                        title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                No se encontraron usuarios
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($usuarios->hasPages())
            <div class="card-footer bg-white">
                {{ $usuarios->links() }}
            </div>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
