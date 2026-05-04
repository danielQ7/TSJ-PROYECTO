<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermisoAusencia extends Model
{
    protected $table = 'permisos_ausencias';
    protected $primaryKey = 'id_permiso_ausencia';
    public $timestamps = false;

    protected $fillable = [
        'id_funcionario', 'id_permiso', 'fecha_ini', 'fecha_fin',
        'hora_ini', 'hora_fin', 'dias_habiles', 'justificacion',
        'observaciones', 'estado', 'registrado_por', 'created_at',
    ];

    protected $casts = [
        'fecha_ini'  => 'date',
        'fecha_fin'  => 'date',
        'created_at' => 'datetime',
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'id_funcionario', 'id_funcionario');
    }

    public function tipoPermiso()
    {
        return $this->belongsTo(TipoPermiso::class, 'id_permiso', 'id_permiso');
    }

    public function registradoPor()
    {
        return $this->belongsTo(User::class, 'registrado_por');
    }
}
