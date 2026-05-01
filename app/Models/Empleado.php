<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre', 'apellido', 'email', 'telefono',
        'cargo', 'sueldo', 'fecha_ingreso', 'activo',
    ];

    protected $casts = [
        'fecha_ingreso' => 'date',
        'sueldo'        => 'decimal:2',
        'activo'        => 'boolean',
    ];

    // Accessor: nombre completo
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombre} {$this->apellido}";
    }
}
