<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Redirige "/" al login
Route::get('/', fn() => redirect()->route('login'));

// ── Autenticación ──────────────────────────────────────────────
Route::get('/login',    [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login',   [LoginController::class, 'login'])->name('login.post');
Route::post('/logout',  [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register',[RegisterController::class, 'register'])->name('register.post');

// ── Rutas protegidas ───────────────────────────────────────────
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Empleados (CRUD completo)
    Route::prefix('empleados')->name('empleados.')->group(function () {
        Route::get('/',            [EmpleadoController::class, 'index'])->name('index');
        Route::get('/crear',       [EmpleadoController::class, 'create'])->name('create');
        Route::post('/',           [EmpleadoController::class, 'store'])->name('store');
        Route::get('/{id}',        [EmpleadoController::class, 'show'])->name('show');
        Route::get('/{id}/editar', [EmpleadoController::class, 'edit'])->name('edit');
        Route::put('/{id}',        [EmpleadoController::class, 'update'])->name('update');
        Route::delete('/{id}',     [EmpleadoController::class, 'destroy'])->name('destroy');
    });

    // Inventario (CRUD + movimientos)
    Route::prefix('inventario')->name('inventario.')->group(function () {
        Route::get('/',            [InventarioController::class, 'index'])->name('index');
        Route::get('/crear',       [InventarioController::class, 'create'])->name('create');
        Route::post('/',           [InventarioController::class, 'store'])->name('store');
        Route::get('/{id}',        [InventarioController::class, 'show'])->name('show');
        Route::get('/{id}/editar', [InventarioController::class, 'edit'])->name('edit');
        Route::put('/{id}',        [InventarioController::class, 'update'])->name('update');
        Route::delete('/{id}',     [InventarioController::class, 'destroy'])->name('destroy');
        Route::post('/movimiento', [InventarioController::class, 'registrarMovimiento'])->name('movimiento');
    });

    // Reportes
    Route::prefix('reportes')->name('reportes.')->group(function () {
        Route::get('/',            [ReporteController::class, 'index'])->name('index');
        Route::get('/empleados',   [ReporteController::class, 'empleados'])->name('empleados');
        Route::get('/inventario',  [ReporteController::class, 'inventario'])->name('inventario');
        Route::get('/movimientos', [ReporteController::class, 'movimientos'])->name('movimientos');
    });
});

// Funcionarios
Route::middleware(['auth'])->group(function () {
    Route::prefix('funcionarios')->name('funcionarios.')->group(function () {
        Route::get('/',            [App\Http\Controllers\FuncionarioController::class, 'index'])->name('index');
        Route::get('/crear',       [App\Http\Controllers\FuncionarioController::class, 'create'])->name('create');
        Route::post('/',           [App\Http\Controllers\FuncionarioController::class, 'store'])->name('store');
        Route::get('/{id}',        [App\Http\Controllers\FuncionarioController::class, 'show'])->name('show');
        Route::get('/{id}/editar', [App\Http\Controllers\FuncionarioController::class, 'edit'])->name('edit');
        Route::put('/{id}',        [App\Http\Controllers\FuncionarioController::class, 'update'])->name('update');
        Route::delete('/{id}',     [App\Http\Controllers\FuncionarioController::class, 'destroy'])->name('destroy');
    });
});
