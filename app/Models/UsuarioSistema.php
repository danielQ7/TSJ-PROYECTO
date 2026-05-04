<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UsuarioSistema extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = ['nombre', 'pass', 'id_rol', 'activo'];

    protected $hidden = ['pass'];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }
}
