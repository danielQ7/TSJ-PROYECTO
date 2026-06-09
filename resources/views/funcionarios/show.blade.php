@extends('layouts.app')
@section('titulo', 'Detalle Funcionario')
@section('contenido')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('funcionarios.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0">Detalle del Funcionario</h4>
</div>

<div class="card shadow-sm" style="max-width: 750px;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <div>
            <h5 class="mb-0 fw-bold">{{ $funcionario->nombre_completo }}</h5>
            <small class="text-muted">{{ $funcionario->cargo->descripcion ?? '-' }}</small>
        </div>
        <div class="d-flex gap-2">
            <span class="badge bg-primary">{{ $funcionario->vinculo->descripcion ?? '-' }}</span>
            <span class="badge bg-{{ $funcionario->estado_activo ? 'success' : 'secondary' }}">
                {{ $funcionario->estado_activo ? 'Activo' : 'Inactivo' }}
            </span>
        </div>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="text-muted small text-uppercase">Cédula</div>
                <div class="fw-semibold">{{ $funcionario->ci }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small text-uppercase">Sexo</div>
                <div class="fw-semibold">{{ $funcionario->sexo == 'M' ? 'Masculino' : 'Femenino' }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small text-uppercase">Fecha de Nacimiento</div>
                <div class="fw-semibold">{{ $funcionario->fecha_nacimiento?->format('d/m/Y') ?? '-' }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small text-uppercase">Teléfono</div>
                <div class="fw-semibold">{{ $funcionario->telefono ?? '-' }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small text-uppercase">Vínculo</div>
                <div class="fw-semibold">{{ $funcionario->vinculo->descripcion ?? '-' }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small text-uppercase">Cargo</div>
                <div class="fw-semibold">{{ $funcionario->cargo->descripcion ?? '-' }}</div>
            </div>
        </div>
        <div class="d-flex gap-2 mt-4 pt-3 border-top">
            <a href="{{ route('funcionarios.edit', $funcionario->id_funcionario) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-1"></i>Editar
            </a>
            <a href="{{ route('funcionarios.index') }}" class="btn btn-outline-secondary">Volver al listado</a>
        </div>
    </div>
</div>
@endsection
