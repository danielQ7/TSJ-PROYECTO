<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Cargo;
use App\Models\Dependencia;
use App\Models\Vinculo;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Funcionario::with(['cargo', 'dependencia', 'vinculo']);

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nombres', 'ilike', "%{$request->search}%")
                  ->orWhere('apellidos', 'ilike', "%{$request->search}%")
                  ->orWhere('ci', 'ilike', "%{$request->search}%");
            });
        }

        if ($request->id_vinculo) {
            $query->where('id_vinculo', $request->id_vinculo);
        }

        if ($request->estado) {
            $query->where('estado_activo', $request->estado === 'activo');
        }

        $funcionarios = $query->orderBy('apellidos')->paginate(15)->withQueryString();
        $vinculos = Vinculo::all();

        return view('funcionarios.index', compact('funcionarios', 'vinculos'));
    }

    public function create()
    {
        $cargos      = Cargo::where('activo', true)->get();
        $dependencias = Dependencia::all();
        $vinculos    = Vinculo::all();
        return view('funcionarios.create', compact('cargos', 'dependencias', 'vinculos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres'          => 'required|string|max:100',
            'apellidos'        => 'required|string|max:100',
            'ci'               => 'required|string|max:20|unique:funcionarios',
            'sexo'             => 'required|in:M,F',
            'telefono'         => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'id_vinculo'       => 'required|exists:vinculos,id_vinculo',
            'id_cargo'         => 'required|exists:cargos,id_cargo',
            'id_dependencia'   => 'nullable|exists:dependencias,id_dependencia',
        ]);

        Funcionario::create($request->all());
        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionario registrado correctamente.');
    }

    public function show($id)
    {
        $funcionario = Funcionario::with(['cargo', 'dependencia', 'vinculo'])->findOrFail($id);
        return view('funcionarios.show', compact('funcionario'));
    }

    public function edit($id)
    {
        $funcionario  = Funcionario::findOrFail($id);
        $cargos       = Cargo::where('activo', true)->get();
        $dependencias = Dependencia::all();
        $vinculos     = Vinculo::all();
        return view('funcionarios.edit', compact('funcionario', 'cargos', 'dependencias', 'vinculos'));
    }

    public function update(Request $request, $id)
    {
        $funcionario = Funcionario::findOrFail($id);

        $request->validate([
            'nombres'          => 'required|string|max:100',
            'apellidos'        => 'required|string|max:100',
            'ci'               => 'required|string|max:20|unique:funcionarios,ci,' . $id . ',id_funcionario',
            'sexo'             => 'required|in:M,F',
            'telefono'         => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'id_vinculo'       => 'required|exists:vinculos,id_vinculo',
            'id_cargo'         => 'required|exists:cargos,id_cargo',
            'id_dependencia'   => 'nullable|exists:dependencias,id_dependencia',
        ]);

        $funcionario->update(array_merge($request->all(), [
            'estado_activo' => $request->has('estado_activo'),
        ]));

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionario actualizado correctamente.');
    }

    public function destroy($id)
    {
        Funcionario::findOrFail($id)->delete();
        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionario eliminado.');
    }
}
