@extends('layouts.app')
@section('titulo', 'Reportes')
@section('contenido')
<h4 class="fw-bold mb-4"><i class="bi bi-bar-chart me-2"></i>Reportes</h4>

<div class="row g-4">
    <div class="col-md-4">
        <a href="{{ route('reportes.permisos') }}" class="text-decoration-none">
            <div class="card shadow-sm h-100 border-0" style="border-left: 4px solid #0d6efd !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-calendar-check fs-2 text-primary"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Permisos por Funcionario</h5>
                            <p class="text-muted mb-0 small">Tipos de permiso, días hábiles utilizados y saldo restante</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('reportes.asistencias') }}" class="text-decoration-none">
            <div class="card shadow-sm h-100 border-0" style="border-left: 4px solid #198754 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-clock-history fs-2 text-success"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Registro de Asistencias</h5>
                            <p class="text-muted mb-0 small">Entradas y salidas por funcionario y fecha</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('reportes.faltas') }}" class="text-decoration-none">
            <div class="card shadow-sm h-100 border-0" style="border-left: 4px solid #dc3545 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-danger bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-x-circle fs-2 text-danger"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Faltas Detalladas</h5>
                            <p class="text-muted mb-0 small">Registro detallado de faltas para imprimir</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
