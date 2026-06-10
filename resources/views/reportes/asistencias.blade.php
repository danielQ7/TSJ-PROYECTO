@extends('layouts.app')
@section('titulo', 'Reporte Asistencias')
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
    <h4 class="fw-bold mb-0">Reporte de Asistencias</h4>
    @if($funcionario)
        <button onclick="window.print()" class="btn btn-outline-dark btn-sm ms-auto">
            <i class="bi bi-printer me-1"></i>Imprimir
        </button>
    @endif
</div>

<div class="card shadow-sm mb-4 no-print">
    <div class="card-body">
        <form method="GET" action="{{ route('reportes.asistencias') }}" class="row g-3">
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
        <h5 class="fw-bold mb-0">{{ $funcionario->nombre_completo }}</h5>
        <small class="text-muted">Total registros: {{ $asistencias->count() }}</small>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Fecha</th>
                    <th>Entrada</th>
                    <th>Salida</th>
                    <th>Horas trabajadas</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($asistencias as $a)
                @php
                    $entrada = \Carbon\Carbon::parse($a->fecha_asis_ini);
                    $salida  = $a->fecha_asis_fin ? \Carbon\Carbon::parse($a->fecha_asis_fin) : null;
                    $horas   = $salida ? $entrada->diffInHours($salida) . 'h ' . ($entrada->diffInMinutes($salida) % 60) . 'm' : '-';
                @endphp
                <tr>
                    <td>{{ $entrada->format('d/m/Y') }}</td>
                    <td>{{ $entrada->format('H:i') }}</td>
                    <td>{{ $salida ? $salida->format('H:i') : '-' }}</td>
                    <td>{{ $horas }}</td>
                    <td>
                        @if($salida)
                            <span class="badge bg-success">Completo</span>
                        @else
                            <span class="badge bg-warning text-dark">Sin salida</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">No hay registros de asistencia</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
