<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Movimiento;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {
        return view('reportes.index');
    }

    public function empleados(Request $request)
    {
        $empleados = Empleado::when($request->cargo, fn($q) => $q->where('cargo', $request->cargo))
            ->orderBy('apellido')
            ->get();

        $cargos = Empleado::distinct()->pluck('cargo');
        return view('reportes.empleados', compact('empleados', 'cargos'));
    }

    public function inventario(Request $request)
    {
        $productos = Producto::with('categoria')
            ->when($request->stock_bajo, fn($q) => $q->where('stock', '<=', 5))
            ->orderBy('nombre')
            ->get();

        return view('reportes.inventario', compact('productos'));
    }

    public function movimientos(Request $request)
    {
        $movimientos = Movimiento::with('producto')
            ->when($request->tipo,  fn($q) => $q->where('tipo', $request->tipo))
            ->when($request->desde, fn($q) => $q->whereDate('created_at', '>=', $request->desde))
            ->when($request->hasta, fn($q) => $q->whereDate('created_at', '<=', $request->hasta))
            ->latest()
            ->paginate(20);

        return view('reportes.movimientos', compact('movimientos'));
    }
}
