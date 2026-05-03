<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Vinculo extends Model
{
    protected $table = 'vinculos';
    protected $primaryKey = 'id_vinculo';
    public $timestamps = false;
    protected $fillable = ['descripcion'];
}
