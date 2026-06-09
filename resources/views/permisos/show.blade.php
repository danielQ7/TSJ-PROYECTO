@extends('layouts.app')
@section('titulo', 'Detalle Permiso')
@section('contenido')
<div class="d-flex align-items-center gap-3 mb-4 no-print">
    <a href="{{ route('permisos.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0">Detalle del Permiso</h4>
    <button onclick="window.print()" class="btn btn-outline-dark btn-sm ms-auto">
        <i class="bi bi-printer me-1"></i>Imprimir
    </button>
</div>

<div class="card shadow-sm" style="max-width: 750px;">
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
                <div class="text-muted small text-uppercase">Fecha Desde</div>
                <div class="fw-semibold">{{ $permiso->fecha_ini->format('d/m/Y') }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small text-uppercase">Fecha Hasta</div>
                <div class="fw-semibold">{{ $permiso->fecha_fin->format('d/m/Y') }}</div>
            </div>
            @if($permiso->hora_ini)
            <div class="col-md-6">
                <div class="text-muted small text-uppercase">Hora Entrada</div>
                <div class="fw-semibold">{{ $permiso->hora_ini }}</div>
            </div>
            @endif
            @if($permiso->hora_fin)
            <div class="col-md-6">
                <div class="text-muted small text-uppercase">Hora Salida</div>
                <div class="fw-semibold">{{ $permiso->hora_fin }}</div>
            </div>
            @endif
            <div class="col-md-6">
                <div class="text-muted small text-uppercase">Días Hábiles</div>
                <div class="fw-semibold">{{ $permiso->dias_habiles }} días</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small text-uppercase">Fecha de Registro</div>
                <div class="fw-semibold">{{ $permiso->created_at ? \Carbon\Carbon::parse($permiso->created_at)->format('d/m/Y H:i') : '-' }}</div>
            </div>
            <div class="col-12">
                <div class="text-muted small text-uppercase">Justificación</div>
                <div class="fw-semibold">{{ $permiso->justificacion }}</div>
            </div>
            @if($permiso->observaciones)
            <div class="col-12">
                <div class="text-muted small text-uppercase">Observaciones</div>
                <div class="fw-semibold">{{ $permiso->observaciones }}</div>
            </div>
            @endif
        </div>
        <div class="mt-4 pt-3 border-top no-print">
            <a href="{{ route('permisos.index') }}" class="btn btn-outline-secondary">Volver al listado</a>
        </div>
    </div>
</div>
@endsection
