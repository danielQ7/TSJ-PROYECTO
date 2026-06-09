<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AsistenciaController extends Controller
{
    public function index(Request $request): View
    {
        $query = Asistencia::with('funcionario');

        if ($request->ci) {
            $query->whereHas('funcionario', fn($q) => $q->where('ci', $request->ci));
        }

        if ($request->fecha) {
            $query->whereDate('fecha_asis_ini', $request->fecha);
        }

        $asistencias = $query->orderBy('fecha_asis_ini', 'desc')->paginate(20)->withQueryString();
        return view('asistencias.index', compact('asistencias'));
    }

    public function registrarEntrada(Request $request): RedirectResponse
    {
        $request->validate([
            'ci' => 'required|string',
        ]);

        /** @var Funcionario|null $funcionario */
        $funcionario = Funcionario::where('ci', $request->ci)->first();

        if (!$funcionario) {
            return back()->withErrors(['ci' => 'No se encontró ningún funcionario con esa cédula.']);
        }

        /** @var Asistencia|null $yaRegistro */
        $yaRegistro = Asistencia::where('id_funcionario', $funcionario->id_funcionario)
            ->whereDate('fecha_asis_ini', today())
            ->whereNull('fecha_asis_fin')
            ->first();

        if ($yaRegistro) {
            return back()->withErrors(['ci' => 'Este funcionario ya registró su entrada hoy.']);
        }

        Asistencia::create([
            'id_funcionario' => $funcionario->id_funcionario,
            'fecha_asis_ini' => now(),
        ]);

        return back()->with('success', "Entrada registrada para {$funcionario->nombres} {$funcionario->apellidos}");
    }

    public function registrarSalida(Request $request): RedirectResponse
    {
        $request->validate([
            'ci' => 'required|string',
        ]);

        /** @var Funcionario|null $funcionario */
        $funcionario = Funcionario::where('ci', $request->ci)->first();

        if (!$funcionario) {
            return back()->withErrors(['ci' => 'No se encontró ningún funcionario con esa cédula.']);
        }

        /** @var Asistencia|null $asistencia */
        $asistencia = Asistencia::where('id_funcionario', $funcionario->id_funcionario)
            ->whereDate('fecha_asis_ini', today())
            ->whereNull('fecha_asis_fin')
            ->first();

        if (!$asistencia) {
            return back()->withErrors(['ci' => 'Este funcionario no tiene entrada registrada hoy.']);
        }

        $asistencia->update(['fecha_asis_fin' => now()]);

        return back()->with('success', "Salida registrada para {$funcionario->nombres} {$funcionario->apellidos}");
    }
}
