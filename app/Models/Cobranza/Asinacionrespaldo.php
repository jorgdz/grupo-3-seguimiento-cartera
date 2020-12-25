<?php

namespace App\Models\Cobranza;

use Illuminate\Database\Eloquent\Model;

class Asinacionrespaldo extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table ='ASIGNAR';
    protected $fillable = ['IDC','ASESOR', 'Campo9',];
}
