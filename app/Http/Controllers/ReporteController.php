<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\PermisoAusencia;
use App\Models\Asistencia;
use App\Models\TipoPermiso;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReporteController extends Controller
{
    public function index()
    {
        return view('reportes.index');
    }

    public function permisosPorFuncionario(Request $request)
    {
        $funcionarios = Funcionario::where('estado_activo', true)->orderBy('apellidos')->get();
        $tiposPermisos = TipoPermiso::where('activo', true)->get();

        $permisos = collect();
        $funcionario = null;

        if ($request->id_funcionario) {
            $funcionario = Funcionario::with(['vinculo', 'cargo'])->findOrFail($request->id_funcionario);

            $query = PermisoAusencia::with('tipoPermiso')
                ->where('id_funcionario', $request->id_funcionario);

            if ($request->mes && $request->anio) {
                $query->whereMonth('fecha_ini', $request->mes)
                      ->whereYear('fecha_ini', $request->anio);
            } elseif ($request->anio) {
                $query->whereYear('fecha_ini', $request->anio);
            }

            if ($request->id_permiso) {
                $query->where('id_permiso', $request->id_permiso);
            }

            $permisos = $query->orderBy('fecha_ini', 'desc')->get();
        }

        // Calcular días hábiles del mes
        $diasHabilesDelMes = 0;
        if ($request->mes && $request->anio) {
            $inicio  = Carbon::create($request->anio, $request->mes, 1);
            $fin     = $inicio->copy()->endOfMonth();
            $current = $inicio->copy();
            while ($current->lte($fin)) {
                if ($current->isWeekday()) $diasHabilesDelMes++;
                $current->addDay();
            }
        }

        return view('reportes.permisos_funcionario', compact(
            'funcionarios', 'tiposPermisos', 'permisos',
            'funcionario', 'diasHabilesDelMes'
        ));
    }

    public function asistencias(Request $request)
    {
        $funcionarios = Funcionario::where('estado_activo', true)->orderBy('apellidos')->get();
        $asistencias  = collect();
        $funcionario  = null;

        if ($request->id_funcionario) {
            $funcionario = Funcionario::findOrFail($request->id_funcionario);

            $query = Asistencia::where('id_funcionario', $request->id_funcionario);

            if ($request->desde) {
                $query->whereDate('fecha_asis_ini', '>=', $request->desde);
            }
            if ($request->hasta) {
                $query->whereDate('fecha_asis_ini', '<=', $request->hasta);
            }

            $asistencias = $query->orderBy('fecha_asis_ini', 'desc')->get();
        }

        return view('reportes.asistencias', compact('funcionarios', 'asistencias', 'funcionario'));
    }

    public function faltas(Request $request)
    {
        $funcionarios = Funcionario::where('estado_activo', true)->orderBy('apellidos')->get();
        $faltas       = collect();
        $funcionario  = null;

        if ($request->id_funcionario) {
            $funcionario = Funcionario::with(['vinculo', 'cargo'])->findOrFail($request->id_funcionario);

            $query = PermisoAusencia::with('tipoPermiso')
                ->where('id_funcionario', $request->id_funcionario)
                ->whereHas('tipoPermiso', fn($q) => $q->where('descripcion', 'ilike', '%falta%'));

            if ($request->desde) {
                $query->where('fecha_ini', '>=', $request->desde);
            }
            if ($request->hasta) {
                $query->where('fecha_fin', '<=', $request->hasta);
            }

            $faltas = $query->orderBy('fecha_ini', 'desc')->get();
        }

        return view('reportes.faltas', compact('funcionarios', 'faltas', 'funcionario'));
    }
}
