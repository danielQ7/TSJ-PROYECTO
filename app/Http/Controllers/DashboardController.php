<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_empleados'  => DB::table('funcionarios')->count(),
            'total_productos'  => Producto::count(),
            'stock_bajo'       => Producto::where('stock', '<=', 5)->count(),
            'movimientos_hoy'  => 0,
        ];

        $movimientos_recientes = collect();

        return view('dashboard.index', compact('stats', 'movimientos_recientes'));
    }
}
