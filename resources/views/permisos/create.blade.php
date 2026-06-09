@extends('layouts.app')
@section('titulo', 'Nuevo Permiso')
@section('contenido')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('permisos.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0">Nuevo Permiso / Ausencia</h4>
</div>

<div class="card shadow-sm" style="max-width: 800px;">
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
                            <option value="{{ $f->id_funcionario }}" {{ old('id_funcionario') == $f->id_funcionario ? 'selected' : '' }}>
                                {{ $f->apellidos }}, {{ $f->nombres }} — {{ $f->ci }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tipo de Permiso *</label>
                    <select name="id_permiso" class="form-select" required>
                        <option value="">Seleccionar...</option>
                        @foreach($tiposPermisos as $t)
                            <option value="{{ $t->id_permiso }}" {{ old('id_permiso') == $t->id_permiso ? 'selected' : '' }}>
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
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Hora Entrada</label>
                    <input type="time" name="hora_ini" class="form-control" value="{{ old('hora_ini') }}">
                </div>
                <div class="col-md-3">
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
                <a href="{{ route('permisos.index') }}" class="btn btn-outline-secondary px-4">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
