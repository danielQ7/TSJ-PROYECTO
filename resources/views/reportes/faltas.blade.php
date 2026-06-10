@extends('layouts.app')
@section('titulo', 'Reporte Faltas')
@section('estilos')
<style>
    @media print {
        #sidebar, #toggleBtn, .no-print { display: none !important; }
        #content { margin-left: 0 !important; }
        .card { box-shadow: none !important; border: 1px solid #dee2e6 !important; }
    }
</style>
@endsection
@section('contenido')
<div class="d-flex align-items-center gap-3 mb-4 no-print">
    <a href="{{ route('reportes.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0">Reporte de Faltas Detallado</h4>
    @if($funcionario)
        <button onclick="window.print()" class="btn btn-outline-dark btn-sm ms-auto">
            <i class="bi bi-printer me-1"></i>Imprimir
        </button>
    @endif
</div>

<div class="card shadow-sm mb-4 no-print">
    <div class="card-body">
        <form method="GET" action="{{ route('reportes.faltas') }}" class="row g-3">
            <div class="col-md-4">
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
            <div class="col-md-3">
                <label class="form-label fw-semibold">Desde</label>
                <input type="date" name="desde" class="form-control" value="{{ request('desde') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Hasta</label>
                <input type="date" name="hasta" class="form-control" value="{{ request('hasta') }}">
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
<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col-md-8">
                <h5 class="fw-bold mb-1">{{ $funcionario->nombre_completo }}</h5>
                <small class="text-muted">
                    CI: {{ $funcionario->ci }} —
                    {{ $funcionario->cargo->descripcion ?? '-' }} —
                    {{ $funcionario->vinculo->descripcion ?? '-' }}
                </small>
            </div>
            <div class="col-md-4 text-end">
                <span class="badge bg-danger fs-6">Total faltas: {{ $faltas->sum('dias_habiles') }} días</span>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th class="text-center">Días Hábiles</th>
                    <th>Justificación</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($faltas as $i => $f)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $f->fecha_ini->format('d/m/Y') }} — {{ $f->fecha_fin->format('d/m/Y') }}</td>
                    <td><span class="badge bg-danger">{{ $f->tipoPermiso->descripcion ?? '-' }}</span></td>
                    <td class="text-center fw-bold">{{ $f->dias_habiles }}</td>
                    <td>{{ $f->justificacion }}</td>
                    <td>{{ $f->observaciones ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">No hay faltas registradas</td>
                </tr>
                @endforelse
            </tbody>
            @if($faltas->count() > 0)
            <tfoot class="table-light">
                <tr>
                    <th colspan="3" class="text-end">Total días hábiles:</th>
                    <th class="text-center">{{ $faltas->sum('dias_habiles') }}</th>
                    <th colspan="2"></th>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>
@endif
@endsection
