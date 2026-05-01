<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::paginate(10);
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email'    => 'required|email|unique:empleados',
            'cargo'    => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'sueldo'   => 'required|numeric|min:0',
        ]);

        Empleado::create($request->all());
        return redirect()->route('empleados.index')->with('success', 'Empleado creado correctamente.');
    }

    public function show($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleados.show', compact('empleado'));
    }

    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);

        $request->validate([
            'nombre'   => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email'    => 'required|email|unique:empleados,email,' . $id,
            'cargo'    => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'sueldo'   => 'required|numeric|min:0',
        ]);

        $empleado->update($request->all());
        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente.');
    }

    public function destroy($id)
    {
        Empleado::findOrFail($id)->delete();
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado.');
    }
}
