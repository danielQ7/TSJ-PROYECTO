@extends('layouts.app')
@section('titulo', 'Editar Usuario')
@section('contenido')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0">Editar Usuario</h4>
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

        <form method="POST" action="{{ route('usuarios.update', $usuario->id_usuario) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label fw-semibold">Nombre de usuario *</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="nombre" class="form-control"
                            value="{{ old('nombre', $usuario->nombre) }}" required>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Rol *</label>
                    <select name="id_rol" class="form-select" required>
                        <option value="">Seleccionar...</option>
                        @foreach($roles as $r)
                            <option value="{{ $r->id_rol }}" {{ old('id_rol', $usuario->id_rol) == $r->id_rol ? 'selected' : '' }}>
                                {{ $r->descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Nueva Contraseña <small class="text-muted">(dejá vacío para no cambiar)</small></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Mínimo 6 caracteres">
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Confirmar Nueva Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Repetí la contraseña">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="activo"
                            {{ $usuario->activo ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold">Usuario activo</label>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning px-4">
                    <i class="bi bi-check-lg me-1"></i>Actualizar
                </button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary px-4">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
