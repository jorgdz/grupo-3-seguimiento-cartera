<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Models\Admin\Cargo;
use App\Models\Admin\DepartamentoEmpresa;

class CargoDepartamento extends Model
{
    protected $table = 'cargo_departamentos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['user_id', 'cargo_id', 'deptempresa_id'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function cargo()
    {
    	return $this->belongsTo(Cargo::class, 'cargo_id');
    }

    public function departamentoEmpresa()
    {
    	return $this->belongsTo(DepartamentoEmpresa::class, 'deptempresa_id');
    }


    public function scopeSearchWhere($query, $column, $operator = null, $search = null)
    {
        if (trim($search) != "") 
        {
            $query->where($column, $operator, $search);
        }
    }
}
