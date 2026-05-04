<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'registro_asistencia';
    protected $primaryKey = 'id_asistencia';
    public $timestamps = false;

    protected $fillable = [
        'id_funcionario', 'fecha_asis_ini', 'fecha_asis_fin', 'observaciones',
    ];

    protected $casts = [
        'fecha_asis_ini' => 'datetime',
        'fecha_asis_fin' => 'datetime',
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'id_funcionario', 'id_funcionario');
    }
}
