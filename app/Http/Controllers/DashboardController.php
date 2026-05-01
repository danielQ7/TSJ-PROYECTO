<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Movimiento;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_empleados'  => Empleado::count(),
            'total_productos'  => Producto::count(),
            'stock_bajo'       => Producto::where('stock', '<=', 5)->count(),
            'movimientos_hoy'  => Movimiento::whereDate('created_at', today())->count(),
        ];

        $movimientos_recientes = Movimiento::with('producto')
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard.index', compact('stats', 'movimientos_recientes'));
    }
}
