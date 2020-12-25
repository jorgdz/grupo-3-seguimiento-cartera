<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;

class Seguridad extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv3';
    protected $table ='SEG_Usuario';
    protected $fillable = 
    ['idUsuario','clave', 'nombre','apellido', 'nombreCompleto','expira','fechaExpiracion', 'usrIng','fecIng', 'usrMod','fecMod', 'claveBandaMagnetica',];

}
