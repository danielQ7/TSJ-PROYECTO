@extends('layouts.app')
@section('titulo', 'Reporte Permisos')
@section('estilos')
<style>
    @media print {
        #sidebar, #toggleBtn, .no-print { display: none !important; }
        #content { margin-left: 0 !important; }
    }
</style>
@endsection
@section('contenido')
<div class="d-flex align-items-center gap-3 mb-4 no-print">
    <a href="{{ route('reportes.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0">Reporte de Permisos por Funcionario</h4>
    @if($funcionario)
        <button onclick="window.print()" class="btn btn-outline-dark btn-sm ms-auto">
            <i class="bi bi-printer me-1"></i>Imprimir
        </button>
    @endif
</div>

<div class="card shadow-sm mb-4 no-print">
    <div class="card-body">
        <form method="GET" action="{{ route('reportes.permisos') }}" class="row g-3">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Funcionario *</label>
                <select name="id_funcionario" class="form-select" required>
                    <option value="">Seleccionar...</option>
                    @foreach($funcionarios as $f)
                        <option value="{{ $f->id_funcionario }}" {{ request('id_funcionario') == $f->id_funcionario ? 'selected' : '' }}>
                            {{ $f->apellidos }}, {{ $f->nombres }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold">Tipo de Permiso</label>
                <select name="id_permiso" class="form-select">
                    <option value="">Todos</option>
                    @foreach($tiposPermisos as $t)
                        <option value="{{ $t->id_permiso }}" {{ request('id_permiso') == $t->id_permiso ? 'selected' : '' }}>
                            {{ $t->descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold">Mes</label>
                <select name="mes" class="form-select">
                    <option value="">Todos</option>
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ request('mes') == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold">Año</label>
                <input type="number" name="anio" class="form-control"
                    value="{{ request('anio', date('Y')) }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i>Generar
                </button>
            </div>
        </form>
    </div>
</div>

@if($funcionario)
<div class="card shadow-sm mb-4">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col-md-6">
                <h5 class="fw-bold mb-1">{{ $funcionario->nombre_completo }}</h5>
                <small class="text-muted">{{ $funcionario->cargo->descripcion ?? '-' }} — {{ $funcionario->vinculo->descripcion ?? '-' }}</small>
            </div>
            <div class="col-md-6 text-end">
                <span class="badge bg-primary me-1">Licencia restante: {{ $funcionario->dias_licencia_restantes }} días</span>
                <span class="badge bg-success me-1">Particular restante: {{ $funcionario->dias_particular_restantes }} días</span>
                @if($funcionario->id_vinculo != 1)
                    <span class="badge bg-info">Salud restante: {{ $funcionario->dias_salud_restantes }} días</span>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tipo de Permiso</th>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th class="text-center">Días Hábiles</th>
                    <th>Justificación</th>
                    <th>Fecha Registro</th>
                </tr>
            </thead>
            <tbody>
                @forelse($permisos as $p)
                <tr>
                    <td><span class="badge bg-info text-dark">{{ $p->tipoPermiso->descripcion ?? '-' }}</span></td>
                    <td>{{ $p->fecha_ini->format('d/m/Y') }}</td>
                    <td>{{ $p->fecha_fin->format('d/m/Y') }}</td>
                    <td class="text-center fw-bold">{{ $p->dias_habiles }}</td>
                    <td>{{ $p->justificacion }}</td>
                    <td>{{ $p->created_at ? \Carbon\Carbon::parse($p->created_at)->format('d/m/Y') : '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">No hay permisos registrados</td>
                </tr>
                @endforelse
            </tbody>
            @if($permisos->count() > 0)
            <tfoot class="table-light">
                <tr>
                    <th colspan="3" class="text-end">Total días hábiles utilizados:</th>
                    <th class="text-center">{{ $permisos->sum('dias_habiles') }}</th>
                    <th colspan="2">
                        @if($diasHabilesDelMes > 0)
                            <small class="text-muted">Días hábiles del mes: {{ $diasHabilesDelMes }}</small>
                        @endif
                    </th>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>
@endif
@endsection
