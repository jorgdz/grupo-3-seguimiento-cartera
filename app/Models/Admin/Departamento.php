<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\DepartamentoEmpresa;

class Departamento extends Model
{
    protected $table = "departamentos";
    protected $fillable = ['nombre_departamento', 'descripcion_departamento', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    
    public function departamentosEmpresa()
    {
        return $this->hasMany(DepartamentoEmpresa::class, 'departamento_id');
    }


    /*
        Scopes
    */
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
