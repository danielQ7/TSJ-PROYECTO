<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre', 'codigo', 'descripcion',
        'categoria_id', 'stock', 'precio',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'stock'  => 'integer',
    ];

    // Relaciones
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    // Scope: stock bajo
    public function scopeStockBajo($query, int $umbral = 5)
    {
        return $query->where('stock', '<=', $umbral);
    }
}
