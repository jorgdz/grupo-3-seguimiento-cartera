<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\DetalleCampania;

class Cliente extends Model
{
    protected $table = "clientes";
    protected $fillable = ['Identificacion', 'Nombres', 'Apellidos', 'direccion', 'telefono'];
    protected $primaryKey = 'id';
    public $timestamps = false;

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
