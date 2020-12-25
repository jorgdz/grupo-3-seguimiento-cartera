<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;

class GestionesVentas extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv4';
    protected $table ='tbRegistroLlamada';
    
   
    public function scopeCedula($query, $cedula)
    {
        if($cedula)
        return $query->where('IdCampañaPersona', 'LIKE', "%$cedula%"); 
    }
}
