<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;

class Damplusagenda extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv4';
    protected $table ='DAMPLUSagenda';
    protected $fillable = ['idc', 
    'estado', 'cedula', 'campana', 
    'telefonoContacto', 'contacto',
    'telefonoNuevo', 'contactarcel',
    'codigoArea', 'convencional',
    'contactarconv', 'turno',
    'comentario', 'fecha', 'hora',
    'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    
   
   
}
