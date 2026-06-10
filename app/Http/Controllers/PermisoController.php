<?php

namespace App\Http\Controllers;

use App\Models\PermisoAusencia;
use App\Models\TipoPermiso;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PermisoController extends Controller
{
    public function index(Request $request)
    {
        $query = PermisoAusencia::with(['funcionario', 'tipoPermiso']);

        if ($request->search) {
            $query->whereHas('funcionario', function($q) use ($request) {
                $q->where('nombres', 'ilike', "%{$request->search}%")
                  ->orWhere('apellidos', 'ilike', "%{$request->search}%")
                  ->orWhere('ci', 'ilike', "%{$request->search}%");
            });
        }

        if ($request->id_permiso) {
            $query->where('id_permiso', $request->id_permiso);
        }

        if ($request->mes && $request->anio) {
            $query->whereMonth('fecha_ini', $request->mes)
                  ->whereYear('fecha_ini', $request->anio);
        }

        $permisos      = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        $tiposPermisos = TipoPermiso::where('activo', true)->get();

        return view('permisos.index', compact('permisos', 'tiposPermisos'));
    }

    public function create()
    {
        $funcionarios  = Funcionario::where('estado_activo', true)->orderBy('apellidos')->get();
        $tiposPermisos = TipoPermiso::where('activo', true)->get();
        return view('permisos.create', compact('funcionarios', 'tiposPermisos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_funcionario' => 'required|exists:funcionarios,id_funcionario',
            'id_permiso'     => 'required|exists:tipos_permisos,id_permiso',
            'fecha_ini'      => 'required|date',
            'fecha_fin'      => 'required|date|after_or_equal:fecha_ini',
            'hora_ini'       => 'nullable|date_format:H:i',
            'hora_fin'       => 'nullable|date_format:H:i',
            'justificacion'  => 'required|string',
            'observaciones'  => 'nullable|string',
        ]);

        $funcionario = Funcionario::findOrFail($request->id_funcionario);
        $tipoPermiso = TipoPermiso::findOrFail($request->id_permiso);

        // Calcular días hábiles
        $inicio      = Carbon::parse($request->fecha_ini);
        $fin         = Carbon::parse($request->fecha_fin);
        $diasHabiles = 0;
        $current     = $inicio->copy();
        while ($current->lte($fin)) {
            if ($current->isWeekday()) $diasHabiles++;
            $current->addDay();
        }

        // Descontar días según tipo de permiso
        $descripcion = strtolower($tipoPermiso->descripcion);

        if (str_contains($descripcion, 'particular')) {
            // Verificar límite mensual de 3 días
            $usadosMes = PermisoAusencia::where('id_funcionario', $funcionario->id_funcionario)
                ->whereMonth('fecha_ini', $inicio->month)
                ->whereYear('fecha_ini', $inicio->year)
                ->whereHas('tipoPermiso', fn($q) => $q->where('descripcion', 'ilike', '%particular%'))
                ->sum('dias_habiles');

            if (($usadosMes + $diasHabiles) > 3) {
                return back()->withErrors(['fecha_ini' => 'No puede usar más de 3 días particulares por mes.'])->withInput();
            }

            if ($funcionario->dias_particular_restantes < $diasHabiles) {
                return back()->withErrors(['fecha_ini' => "No tiene suficientes días particulares. Disponibles: {$funcionario->dias_particular_restantes}"])->withInput();
            }

            $funcionario->decrement('dias_particular_restantes', $diasHabiles);

        } elseif (str_contains($descripcion, 'salud') || str_contains($descripcion, 'licencia')) {
            $campo = $funcionario->id_vinculo == 1 ? 'dias_licencia_restantes' : 'dias_salud_restantes';

            if ($funcionario->$campo < $diasHabiles) {
                return back()->withErrors(['fecha_ini' => "No tiene suficientes días disponibles. Disponibles: {$funcionario->$campo}"])->withInput();
            }

            $funcionario->decrement($campo, $diasHabiles);
        }

        PermisoAusencia::create([
            'id_funcionario' => $request->id_funcionario,
            'id_permiso'     => $request->id_permiso,
            'fecha_ini'      => $request->fecha_ini,
            'fecha_fin'      => $request->fecha_fin,
            'hora_ini'       => $request->hora_ini,
            'hora_fin'       => $request->hora_fin,
            'dias_habiles'   => $diasHabiles,
            'justificacion'  => $request->justificacion,
            'observaciones'  => $request->observaciones,
            'estado'         => 'aprobado',
            'registrado_por' => auth()->id(),
            'created_at'     => now(),
        ]);

        return redirect()->route('permisos.index')
            ->with('success', "Permiso registrado. Días hábiles descontados: {$diasHabiles}");
    }

    public function show($id)
    {
        $permiso = PermisoAusencia::with(['funcionario', 'tipoPermiso'])->findOrFail($id);
        return view('permisos.show', compact('permiso'));
    }

    public function destroy($id)
    {
        $permiso     = PermisoAusencia::with('tipoPermiso')->findOrFail($id);
        $funcionario = Funcionario::findOrFail($permiso->id_funcionario);
        $descripcion = strtolower($permiso->tipoPermiso->descripcion ?? '');

        // Restaurar días al eliminar
        if (str_contains($descripcion, 'particular')) {
            $funcionario->increment('dias_particular_restantes', $permiso->dias_habiles ?? 0);
        } elseif (str_contains($descripcion, 'salud') || str_contains($descripcion, 'licencia')) {
            $campo = $funcionario->id_vinculo == 1 ? 'dias_licencia_restantes' : 'dias_salud_restantes';
            $funcionario->increment($campo, $permiso->dias_habiles ?? 0);
        }

        $permiso->delete();

        return redirect()->route('permisos.index')
            ->with('success', 'Permiso eliminado y días restaurados.');
    }
}
