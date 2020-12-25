<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
//use App\Models\Admin\DetalleCampania;
use App\Models\Admin\DetallePago;
use App\User;

class Pago extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'pagos';
   // protected $fillable = ['detalle_campania_id', 'periodo', 'interes', 'cuota', 'abono', 'fecha_pago'];
    protected $fillable = ['campania_idc', 'periodo', 'interes', 'cuota', 'abono', 'fecha_pago', 'user_id'];
    public $timestamps = false;


   /* public function detalleCampania()
    {
    	return $this->belongsTo(DetalleCampania::class, 'detalle_campania_id');
    } */


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 

   	public function detallePagos ()
    {
        return $this->hasMany(DetallePago::class, 'pago_id');
    }



    public function scopeCampania($query, $id)
    {
        if (trim($id) != "") 
        {
            $query->where('campania_idc', '=', $id);
        }
    }
}
