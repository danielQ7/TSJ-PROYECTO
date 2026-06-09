@extends('layouts.app')
@section('titulo', 'Nuevo Usuario')
@section('contenido')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0">Nuevo Usuario</h4>
</div>

<div class="card shadow-sm" style="max-width: 550px;">
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

        <form method="POST" action="{{ route('usuarios.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label fw-semibold">Nombre de usuario *</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="nombre" class="form-control"
                            value="{{ old('nombre') }}" placeholder="ej: jperez" required>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Rol *</label>
                    <select name="id_rol" class="form-select" required>
                        <option value="">Seleccionar...</option>
                        @foreach($roles as $r)
                            <option value="{{ $r->id_rol }}" {{ old('id_rol') == $r->id_rol ? 'selected' : '' }}>
                                {{ $r->descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Contraseña *</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control"
                            placeholder="Mínimo 6 caracteres" required>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Confirmar Contraseña *</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Repetí la contraseña" required>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-check-lg me-1"></i>Crear Usuario
                </button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary px-4">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
