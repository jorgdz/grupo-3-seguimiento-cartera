<?php

namespace App\Models\Cobranza;

use Illuminate\Database\Eloquent\Model;

class Seguridad extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table ='SEG_Usuario';
    protected $fillable = 
    ['idUsuario','clave', 'nombre','apellido', 'nombreCompleto','expira','fechaExpiracion', 'usrIng','fecIng', 'usrMod','fecMod', 'claveBandaMagnetica',];

}
