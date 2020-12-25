<?php

namespace App\Models\Cobranza;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table ='DAMPLUSAsignacion';
    protected $fillable = ['IDC','ASESOR', 'Campo9'];
}
