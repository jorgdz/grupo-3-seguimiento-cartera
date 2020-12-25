<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\UserCargo;
use App\Models\Admin\CargoDepartamento;

class Cargo extends Model
{
    protected $table = "cargos";
    protected $fillable = ['nombre_cargo', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';

    public function cargoUsers ()
    {
        return $this->hasMany(UserCargo::class, 'cargo_id');
    }

    public function cargosDepartamento ()
    {
        return $this->hasMany(CargoDepartamento::class, 'cargo_id');
    }



    public function scopeSearchWhere($query, $column, $operator = null, $search = null)
    {
        if (trim($search) != "") 
        {
            $query->where($column, $operator, $search);
        }
    }

    public function scopeSearchOrWhere($query, $column, $operator = null, $search = null)
    {
        if (trim($search) != "") 
        {
            $query->orWhere($column, $operator, $search);
        }
    }
}
