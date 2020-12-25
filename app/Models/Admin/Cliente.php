<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Models\Admin\DetalleCampania;

class Cliente extends Model
{
    protected $table = "clientes";
    protected $fillable = ['cedula', 'nombres', 'apellidos', 'direccion', 'celular', 'telefono', 'estado_civil', 'user_id'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    } 

    public function detalleCampania ()
    {
        return $this->hasMany(DetalleCampania::class, 'cliente_id');
    }

    public function scopeCedulaCliente($query, $cedula)
    {
        if (trim($cedula) != "") 
        {
            $query->where($this->cedula, 'LIKE', '%'.$cedula.'%');
        }
    }

}
