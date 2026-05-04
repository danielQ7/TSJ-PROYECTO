<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Permiso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        #sidebar { min-height: 100vh; background-color: #1e2a38; width: 250px; position: fixed; top: 0; left: 0; }
        #sidebar .nav-link { color: #cfd8dc; padding: .6rem 1rem; border-radius: .375rem; margin: 2px 8px; }
        #sidebar .nav-link:hover, #sidebar .nav-link.active { background: #2e3d4f; color: #fff; }
        #content { margin-left: 250px; padding: 2rem; }
        #info-permiso { display: none; }
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
            <a href="{{ route('permisos.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h4 class="fw-bold mb-0">Nuevo Permiso / Ausencia</h4>
        </div>

        <div class="card border-0 shadow-sm" style="max-width: 800px;">
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

                <form method="POST" action="{{ route('permisos.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Funcionario *</label>
                            <select name="id_funcionario" class="form-select" required>
                                <option value="">Seleccionar...</option>
                                @foreach($funcionarios as $f)
                                    <option value="{{ $f->id_funcionario }}"
                                        data-vinculo="{{ $f->id_vinculo }}"
                                        {{ old('id_funcionario') == $f->id_funcionario ? 'selected' : '' }}>
                                        {{ $f->apellidos }}, {{ $f->nombres }} — {{ $f->ci }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tipo de Permiso *</label>
                            <select name="id_permiso" class="form-select" required id="tipoPermiso">
                                <option value="">Seleccionar...</option>
                                @foreach($tiposPermisos as $t)
                                    <option value="{{ $t->id_permiso }}"
                                        {{ old('id_permiso') == $t->id_permiso ? 'selected' : '' }}>
                                        {{ $t->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Fecha Desde *</label>
                            <input type="date" name="fecha_ini" class="form-control"
                                value="{{ old('fecha_ini', date('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Fecha Hasta *</label>
                            <input type="date" name="fecha_fin" class="form-control"
                                value="{{ old('fecha_fin', date('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-3" id="campoHoraIni">
                            <label class="form-label fw-semibold">Hora Entrada</label>
                            <input type="time" name="hora_ini" class="form-control" value="{{ old('hora_ini') }}">
                        </div>
                        <div class="col-md-3" id="campoHoraFin">
                            <label class="form-label fw-semibold">Hora Salida</label>
                            <input type="time" name="hora_fin" class="form-control" value="{{ old('hora_fin') }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Justificación *</label>
                            <textarea name="justificacion" class="form-control" rows="3"
                                placeholder="Motivo del permiso o ausencia..." required>{{ old('justificacion') }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Observaciones</label>
                            <textarea name="observaciones" class="form-control" rows="2"
                                placeholder="Observaciones adicionales...">{{ old('observaciones') }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i>Registrar Permiso
                        </button>
                        <a href="{{ route('permisos.index') }}" class="btn btn-outline-secondary px-4">
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
