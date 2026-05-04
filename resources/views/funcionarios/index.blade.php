<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionarios</title>
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
            <a href="/funcionarios" class="nav-link active"><i class="bi bi-people me-2"></i>Funcionarios</a>
            <a href="/permisos" class="nav-link"><i class="bi bi-calendar-check me-2"></i>Permisos</a>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0"><i class="bi bi-people me-2"></i>Funcionarios</h4>
            <a href="{{ route('funcionarios.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>Nuevo Funcionario
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
                <form method="GET" action="{{ route('funcionarios.index') }}" class="row g-3">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control"
                                placeholder="Buscar por nombre, apellido o cédula..."
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="id_vinculo" class="form-select">
                            <option value="">Todos los vínculos</option>
                            @foreach($vinculos as $v)
                                <option value="{{ $v->id_vinculo }}" {{ request('id_vinculo') == $v->id_vinculo ? 'selected' : '' }}>
                                    {{ $v->descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="estado" class="form-select">
                            <option value="">Todos</option>
                            <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activos</option>
                            <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivos</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                        <a href="{{ route('funcionarios.index') }}" class="btn btn-outline-secondary">
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
                            <th>Nombre</th>
                            <th>Cédula</th>
                            <th>Cargo</th>
                            <th>Vínculo</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($funcionarios as $f)
                        <tr>
                            <td class="fw-semibold">{{ $f->nombre_completo }}</td>
                            <td>{{ $f->ci }}</td>
                            <td>{{ $f->cargo->descripcion ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $f->id_vinculo == 1 ? 'primary' : 'success' }}">
                                    {{ $f->vinculo->descripcion ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $f->estado_activo ? 'success' : 'secondary' }}">
                                    {{ $f->estado_activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('funcionarios.show', $f->id_funcionario) }}"
                                   class="btn btn-sm btn-outline-info" title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('funcionarios.edit', $f->id_funcionario) }}"
                                   class="btn btn-sm btn-outline-warning" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('funcionarios.destroy', $f->id_funcionario) }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Eliminar a {{ $f->nombre_completo }}?')"
                                        title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                No se encontraron funcionarios
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($funcionarios->hasPages())
            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Mostrando {{ $funcionarios->firstItem() }} - {{ $funcionarios->lastItem() }}
                    de {{ $funcionarios->total() }} funcionarios
                </small>
                {{ $funcionarios->links() }}
            </div>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
