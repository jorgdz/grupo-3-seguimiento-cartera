<?php

namespace App\Models\Cobranza;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table ='ASIGNAR;';
   // protected $fillable = ['extension','login', 'fullname','user_group', 'server_ip',];

}
