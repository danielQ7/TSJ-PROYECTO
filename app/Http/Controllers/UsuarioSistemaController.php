<?php

namespace App\Http\Controllers;

use App\Models\UsuarioSistema;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioSistemaController extends Controller
{
    public function index(Request $request)
    {
        $query = UsuarioSistema::with('rol');

        if ($request->search) {
            $query->where('nombre', 'ilike', "%{$request->search}%");
        }

        if ($request->id_rol) {
            $query->where('id_rol', $request->id_rol);
        }

        $usuarios = $query->paginate(15)->withQueryString();
        $roles    = Rol::where('activo', true)->get();

        return view('usuarios.index', compact('usuarios', 'roles'));
    }

    public function create()
    {
        $roles = Rol::where('activo', true)->get();
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:50|unique:usuarios',
            'password' => 'required|min:6|confirmed',
            'id_rol'   => 'required|exists:roles,id_rol',
        ]);

        UsuarioSistema::create([
            'nombre' => $request->nombre,
            'pass'   => Hash::make($request->password),
            'id_rol' => $request->id_rol,
            'activo' => true,
        ]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function edit($id)
    {
        $usuario = UsuarioSistema::findOrFail($id);
        $roles   = Rol::where('activo', true)->get();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $usuario = UsuarioSistema::findOrFail($id);

        $request->validate([
            'nombre'   => 'required|string|max:50|unique:usuarios,nombre,' . $id . ',id_usuario',
            'id_rol'   => 'required|exists:roles,id_rol',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'nombre' => $request->nombre,
            'id_rol' => $request->id_rol,
            'activo' => $request->has('activo'),
        ];

        if ($request->filled('password')) {
            $data['pass'] = Hash::make($request->password);
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        UsuarioSistema::findOrFail($id)->delete();
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado.');
    }
}
