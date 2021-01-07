<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Pago;
use App\User;

class DetallePago extends Model
{
    protected $table = "detalle_pagos";
    protected $fillable = ['pago_id', 'estado_pago', 'saldo_inicial', 'cuota_fija', 'fecha_pago'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function pago() {
    	return $this->belongsTo(Pago::class, 'pago_id');
    } 
}
