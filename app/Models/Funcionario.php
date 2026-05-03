<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionarios';
    protected $primaryKey = 'id_funcionario';
    public $timestamps = false;

    protected $fillable = [
        'nombres', 'apellidos', 'sexo', 'telefono',
        'fecha_nacimiento', 'ci', 'id_vinculo',
        'id_cargo', 'id_dependencia', 'estado_activo',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'estado_activo'    => 'boolean',
    ];

    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombres} {$this->apellidos}";
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'id_cargo', 'id_cargo');
    }

    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class, 'id_dependencia', 'id_dependencia');
    }

    public function vinculo()
    {
        return $this->belongsTo(Vinculo::class, 'id_vinculo', 'id_vinculo');
    }
}
