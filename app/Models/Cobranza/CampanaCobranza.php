<?php

namespace App\Models\Cobranza;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cobranza\ClientesCobranza;

class CampanaCobranza extends Model
{
    
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table ='tbCampaña';
 
    public function clientes()
    {
        return $this->hasMany(ClientesCobranza::class,'IdCampaña','Identificacion');
    } 	
}
