@extends('layouts.app')
@section('titulo', 'Usuarios')
@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-person-gear me-2"></i>Usuarios del Sistema</h4>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Nuevo Usuario
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('usuarios.index') }}" class="row g-3">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control"
                        placeholder="Buscar por nombre de usuario..."
                        value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="id_rol" class="form-select">
                    <option value="">Todos los roles</option>
                    @foreach($roles as $r)
                        <option value="{{ $r->id_rol }}" {{ request('id_rol') == $r->id_rol ? 'selected' : '' }}>
                            {{ $r->descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
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
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $u)
                <tr>
                    <td class="fw-semibold"><i class="bi bi-person-circle me-2 text-muted"></i>{{ $u->nombre }}</td>
                    <td>
                        <span class="badge bg-{{ $u->id_rol == 1 ? 'danger' : ($u->id_rol == 2 ? 'warning text-dark' : 'info text-dark') }}">
                            {{ $u->rol->descripcion ?? '-' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $u->activo ? 'success' : 'secondary' }}">
                            {{ $u->activo ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('usuarios.edit', $u->id_usuario) }}"
                           class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('usuarios.destroy', $u->id_usuario) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('¿Eliminar usuario {{ $u->nombre }}?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                        No se encontraron usuarios
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
