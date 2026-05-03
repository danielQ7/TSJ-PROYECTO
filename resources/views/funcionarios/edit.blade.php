<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionario</title>
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
            <h4 class="fw-bold mb-0">Editar Funcionario</h4>
        </div>

        <div class="card border-0 shadow-sm" style="max-width: 750px;">
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

                <form method="POST" action="{{ route('funcionarios.update', $funcionario->id_funcionario) }}">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nombres *</label>
                            <input type="text" name="nombres" class="form-control" value="{{ old('nombres', $funcionario->nombres) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Apellidos *</label>
                            <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos', $funcionario->apellidos) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Cédula *</label>
                            <input type="text" name="ci" class="form-control" value="{{ old('ci', $funcionario->ci) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Sexo *</label>
                            <select name="sexo" class="form-select" required>
                                <option value="">Seleccionar...</option>
                                <option value="M" {{ old('sexo', $funcionario->sexo) == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ old('sexo', $funcionario->sexo) == 'F' ? 'selected' : '' }}>Femenino</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $funcionario->telefono) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Fecha de Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" class="form-control"
                                value="{{ old('fecha_nacimiento', $funcionario->fecha_nacimiento?->format('Y-m-d')) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Vínculo *</label>
                            <select name="id_vinculo" class="form-select" required>
                                <option value="">Seleccionar...</option>
                                @foreach($vinculos as $v)
                                    <option value="{{ $v->id_vinculo }}" {{ old('id_vinculo', $funcionario->id_vinculo) == $v->id_vinculo ? 'selected' : '' }}>
                                        {{ $v->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Cargo *</label>
                            <select name="id_cargo" class="form-select" required>
                                <option value="">Seleccionar...</option>
                                @foreach($cargos as $c)
                                    <option value="{{ $c->id_cargo }}" {{ old('id_cargo', $funcionario->id_cargo) == $c->id_cargo ? 'selected' : '' }}>
                                        {{ $c->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="estado_activo"
                                    {{ $funcionario->estado_activo ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold">Funcionario activo</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="bi bi-check-lg me-1"></i>Actualizar
                        </button>
                        <a href="{{ route('funcionarios.index') }}" class="btn btn-outline-secondary px-4">
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
