<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\Role;
use App\Models\Admin\Permiso;

class PermisoRol extends Model
{
    protected $table = 'permission_role';
    protected $fillable = ['role_id', 'permission_id', 'created_at', 'updated_at'];

    protected $primaryKey = 'id';

    public function rol ()
 	{
 		return $this->belongsTo(Role::class, 'role_id');
 	}   

 	public function permiso ()
 	{
 		return $this->belongsTo(Permiso::class, 'permission_id');
 	}   

}
