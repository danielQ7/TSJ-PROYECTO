<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Movimiento;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->paginate(10);
        return view('inventario.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('inventario.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:150',
            'codigo'       => 'required|string|unique:productos',
            'categoria_id' => 'required|exists:categorias,id',
            'stock'        => 'required|integer|min:0',
            'precio'       => 'required|numeric|min:0',
            'descripcion'  => 'nullable|string',
        ]);

        Producto::create($request->all());
        return redirect()->route('inventario.index')->with('success', 'Producto creado correctamente.');
    }

    public function show($id)
    {
        $producto = Producto::with(['categoria', 'movimientos'])->findOrFail($id);
        return view('inventario.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto   = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('inventario.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre'       => 'required|string|max:150',
            'codigo'       => 'required|string|unique:productos,codigo,' . $id,
            'categoria_id' => 'required|exists:categorias,id',
            'stock'        => 'required|integer|min:0',
            'precio'       => 'required|numeric|min:0',
            'descripcion'  => 'nullable|string',
        ]);

        $producto->update($request->all());
        return redirect()->route('inventario.index')->with('success', 'Producto actualizado.');
    }

    public function destroy($id)
    {
        Producto::findOrFail($id)->delete();
        return redirect()->route('inventario.index')->with('success', 'Producto eliminado.');
    }

    public function registrarMovimiento(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'tipo'        => 'required|in:entrada,salida',
            'cantidad'    => 'required|integer|min:1',
            'motivo'      => 'nullable|string|max:255',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if ($request->tipo === 'salida' && $producto->stock < $request->cantidad) {
            return back()->withErrors(['cantidad' => 'Stock insuficiente.']);
        }

        $producto->stock += ($request->tipo === 'entrada')
            ? $request->cantidad
            : -$request->cantidad;
        $producto->save();

        Movimiento::create([
            'producto_id' => $producto->id,
            'tipo'        => $request->tipo,
            'cantidad'    => $request->cantidad,
            'motivo'      => $request->motivo,
            'user_id'     => auth()->id(),
        ]);

        return redirect()->route('inventario.index')->with('success', 'Movimiento registrado.');
    }
}
