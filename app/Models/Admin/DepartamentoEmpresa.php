<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\Empresa;
use App\Models\Admin\Departamento;
use App\Models\Admin\CargoDepartamento;

class DepartamentoEmpresa extends Model
{

    protected $table = 'departamento_empresas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['empresa_id', 'departamento_id'];

    public function empresa()
    {
    	return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function departamento()
    {
    	return $this->belongsTo(Departamento::class, 'departamento_id');
    } 

    public function cargosDepartamento ()
    {
        return $this->hasMany(CargoDepartamento::class, 'deptempresa_id');
    }

    
    public function scopeSearchWhere($query, $column, $operator = null, $search = null)
    {
        if (trim($search) != "") 
        {
            $query->where($column, $operator, $search);
        }
    }
    
}
