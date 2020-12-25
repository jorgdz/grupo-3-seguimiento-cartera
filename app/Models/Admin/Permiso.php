<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\PermisoRol;
use App\Models\Admin\PermisoUser;

class Permiso extends Model
{
    
    protected $table = "permissions";
    protected $primaryKey = "id";

    protected $fillable = ['id', 'name', 'slug', 'description', 'created_at', 'updated_at'];

    public function permisoRoles ()
    {
        return $this->hasMany(PermisoRol::class, 'permission_id');
    } 

    public function permisoUsers ()
    {
        return $this->hasMany(PermisoUser::class, 'permission_id');
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
