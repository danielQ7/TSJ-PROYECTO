@extends('layouts.app')
@section('titulo', 'Asistencias')
@section('contenido')
<h4 class="fw-bold mb-4"><i class="bi bi-clock me-2"></i>Registro de Asistencia</h4>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        {{ $errors->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-success text-white fw-semibold">
                <i class="bi bi-box-arrow-in-right me-2"></i>Registrar Entrada
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('asistencias.entrada') }}">
                    @csrf
                    <label class="form-label fw-semibold">Número de Cédula</label>
                    <div class="input-group">
                        <input type="text" name="ci" class="form-control form-control-lg"
                            placeholder="Ingrese su cédula..." required>
                        <button type="submit" class="btn btn-success px-4">
                            <i class="bi bi-check-lg"></i>
                        </button>
                    </div>
                    <small class="text-muted">Se registrará la hora actual como entrada</small>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-danger text-white fw-semibold">
                <i class="bi bi-box-arrow-right me-2"></i>Registrar Salida
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('asistencias.salida') }}">
                    @csrf
                    <label class="form-label fw-semibold">Número de Cédula</label>
                    <div class="input-group">
                        <input type="text" name="ci" class="form-control form-control-lg"
                            placeholder="Ingrese su cédula..." required>
                        <button type="submit" class="btn btn-danger px-4">
                            <i class="bi bi-check-lg"></i>
                        </button>
                    </div>
                    <small class="text-muted">Se registrará la hora actual como salida</small>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('asistencias.index') }}" class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" name="ci" class="form-control"
                        placeholder="Buscar por cédula..." value="{{ request('ci') }}">
                </div>
            </div>
            <div class="col-md-3">
                <input type="date" name="fecha" class="form-control" value="{{ request('fecha', date('Y-m-d')) }}">
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                <a href="{{ route('asistencias.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Funcionario</th>
                    <th>Cédula</th>
                    <th>Entrada</th>
                    <th>Salida</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($asistencias as $a)
                <tr>
                    <td class="fw-semibold">{{ $a->funcionario->nombres ?? '-' }} {{ $a->funcionario->apellidos ?? '' }}</td>
                    <td>{{ $a->funcionario->ci ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($a->fecha_asis_ini)->format('d/m/Y H:i') }}</td>
                    <td>{{ $a->fecha_asis_fin ? \Carbon\Carbon::parse($a->fecha_asis_fin)->format('d/m/Y H:i') : '-' }}</td>
                    <td>
                        @if($a->fecha_asis_fin)
                            <span class="badge bg-success">Completo</span>
                        @else
                            <span class="badge bg-warning text-dark">En oficina</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                        No hay registros de asistencia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($asistencias->hasPages())
    <div class="card-footer bg-white">
        {{ $asistencias->links() }}
    </div>
    @endif
</div>
@endsection
