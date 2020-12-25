<?php

namespace App\Models\Cobranza;

use Illuminate\Database\Eloquent\Model;

class DetalleCuotas extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table ='tbCampañaPersonaCuotaDetalle';
}
