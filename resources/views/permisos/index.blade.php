@extends('layouts.app')
@section('titulo', 'Permisos')
@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-calendar-check me-2"></i>Permisos y Ausencias</h4>
    <a href="{{ route('permisos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Nuevo Permiso
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
        <form method="GET" action="{{ route('permisos.index') }}" class="row g-3">
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control"
                        placeholder="Buscar funcionario..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="id_permiso" class="form-select">
                    <option value="">Todos los tipos</option>
                    @foreach($tiposPermisos as $t)
                        <option value="{{ $t->id_permiso }}" {{ request('id_permiso') == $t->id_permiso ? 'selected' : '' }}>
                            {{ $t->descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="mes" class="form-select">
                    <option value="">Mes</option>
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ request('mes') == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="anio" class="form-control"
                    placeholder="Año" value="{{ request('anio', date('Y')) }}">
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                <a href="{{ route('permisos.index') }}" class="btn btn-outline-secondary">
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
                    <th>Tipo de Permiso</th>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th>Días Hábiles</th>
                    <th>Registrado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($permisos as $p)
                <tr>
                    <td class="fw-semibold">{{ $p->funcionario->nombres ?? '-' }} {{ $p->funcionario->apellidos ?? '' }}</td>
                    <td><span class="badge bg-info text-dark">{{ $p->tipoPermiso->descripcion ?? '-' }}</span></td>
                    <td>{{ $p->fecha_ini->format('d/m/Y') }}</td>
                    <td>{{ $p->fecha_fin->format('d/m/Y') }}</td>
                    <td class="text-center"><span class="badge bg-secondary">{{ $p->dias_habiles }}</span></td>
                    <td>{{ $p->created_at ? \Carbon\Carbon::parse($p->created_at)->format('d/m/Y') : '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('permisos.show', $p->id_permiso_ausencia) }}"
                           class="btn btn-sm btn-outline-info" title="Ver">
                            <i class="bi bi-eye"></i>
                        </a>
                        <form method="POST" action="{{ route('permisos.destroy', $p->id_permiso_ausencia) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('¿Eliminar este permiso?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                        No se encontraron permisos
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($permisos->hasPages())
    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
        <small class="text-muted">{{ $permisos->firstItem() }} - {{ $permisos->lastItem() }} de {{ $permisos->total() }}</small>
        {{ $permisos->links() }}
    </div>
    @endif
</div>
@endsection
