<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;

class ClientesVentas extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv4';
    protected $table ='tbCampañaPersona';
    
   
    public function scopeCedula($query, $cedula)
    {
        if($cedula)
        return $query->where('IdCampañaPersona', 'LIKE', "%$cedula%"); 
    }
}
