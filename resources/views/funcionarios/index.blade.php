@extends('layouts.app')

@section('titulo', 'Funcionarios')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-people me-2"></i>Funcionarios</h4>
    <a href="{{ route('funcionarios.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Nuevo Funcionario
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
        <form method="GET" action="{{ route('funcionarios.index') }}" class="row g-3">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control"
                        placeholder="Buscar por nombre, apellido o cédula..."
                        value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="id_vinculo" class="form-select">
                    <option value="">Todos los vínculos</option>
                    @foreach($vinculos as $v)
                        <option value="{{ $v->id_vinculo }}" {{ request('id_vinculo') == $v->id_vinculo ? 'selected' : '' }}>
                            {{ $v->descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="estado" class="form-select">
                    <option value="">Todos</option>
                    <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activos</option>
                    <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivos</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                <a href="{{ route('funcionarios.index') }}" class="btn btn-outline-secondary">
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
                    <th>Nombre</th>
                    <th>Cédula</th>
                    <th>Cargo</th>
                    <th>Vínculo</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($funcionarios as $f)
                <tr>
                    <td class="fw-semibold">{{ $f->nombre_completo }}</td>
                    <td>{{ $f->ci }}</td>
                    <td>{{ $f->cargo->descripcion ?? '-' }}</td>
                    <td>
                        <span class="badge bg-{{ $f->id_vinculo == 1 ? 'primary' : 'success' }}">
                            {{ $f->vinculo->descripcion ?? '-' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $f->estado_activo ? 'success' : 'secondary' }}">
                            {{ $f->estado_activo ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('funcionarios.show', $f->id_funcionario) }}"
                           class="btn btn-sm btn-outline-info" title="Ver">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('funcionarios.edit', $f->id_funcionario) }}"
                           class="btn btn-sm btn-outline-warning" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('funcionarios.destroy', $f->id_funcionario) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('¿Eliminar a {{ $f->nombre_completo }}?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                        No se encontraron funcionarios
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($funcionarios->hasPages())
    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
        <small class="text-muted">
            Mostrando {{ $funcionarios->firstItem() }} - {{ $funcionarios->lastItem() }}
            de {{ $funcionarios->total() }} funcionarios
        </small>
        {{ $funcionarios->links() }}
    </div>
    @endif
</div>
@endsection
