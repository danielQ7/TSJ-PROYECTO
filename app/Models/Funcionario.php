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
        'dias_licencia_restantes', 'dias_particular_restantes',
        'dias_salud_restantes', 'es_antiguo',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'estado_activo'    => 'boolean',
        'es_antiguo'       => 'boolean',
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

    public function permisos()
    {
        return $this->hasMany(PermisoAusencia::class, 'id_funcionario', 'id_funcionario');
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'id_funcionario', 'id_funcionario');
    }

    // Días totales según tipo y vínculo
    public function diasLicenciaTotal(): int
    {
        return $this->id_vinculo == 1 ? 12 : 90;
    }

    public function diasParticularTotal(): int
    {
        return $this->es_antiguo ? 30 : 20;
    }
}
