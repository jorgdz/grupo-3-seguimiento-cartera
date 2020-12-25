<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Cliente;
use App\Models\Admin\Campania;
use App\Models\Admin\Pago;

class DetalleCampania extends Model
{
    //protected $table = "detalle_campanias";
    protected $fillable = ['cliente_id', 'campania_id', 'valor_saldo', 'valor_deuda', 'fecha'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function cliente()
    {
    	return $this->belongsTo(Cliente::class, 'cliente_id');
    } 

    public function campania()
    {
    	return $this->belongsTo(Campania::class, 'campania_id');
    } 

   /* public function pagos ()
    {
        return $this->hasMany(Pago::class, 'detalle_campania_id');
    }*/

    public function scopeCedulaCliente($query, $cedula)
    {
        if (trim($cedula) != "") 
        {
            $query->whereHas('cliente', function($q) use ($cedula){
                $q->where('cedula', '=', $cedula);
            });
        }
    }

}
