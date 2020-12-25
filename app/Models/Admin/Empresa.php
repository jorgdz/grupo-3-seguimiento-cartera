<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\DepartamentoEmpresa;

class Empresa extends Model
{
    protected $table = "empresas";
    protected $fillable = ['nombre_empresa', 'descripcion_empresa', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    
    public function departamentosEmpresa()
    {
        return $this->hasMany(DepartamentoEmpresa::class, 'empresa_id');
    }


    /**
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
