<?php

namespace App\Models\Cobranza;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cobranza\CampanaCobranza;
class ClientesCobranza extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table ='tbCampañaPersona';
    protected $fillable = ['Idagente','Identificacion', 'Campo9','IdCampaña'];


    public function Campana()
    {
        return $this->belongsTo(CampanaCobranza::class,'IdCampaña');
    }



     //query scope

     public function scopeCedula($query, $cedula)
     {
         if($cedula)
         return $query->where('Identificacion', 'LIKE', "%$cedula%"); 
     }
     
     
     public function scopeAgente($query, $agente)
     {
         if($agente)
         return $query->where('Idagente', 'LIKE', "%$agente%"); 
     }
 
 
     public function scopeNombres($query, $nombres)
     {
         if($nombres)
         return $query->where('Nombres', 'LIKE', "%$nombres%"); 
     }
}
