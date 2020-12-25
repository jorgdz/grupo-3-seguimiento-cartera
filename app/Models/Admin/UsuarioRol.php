<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\Role;
use App\User;

class UsuarioRol extends Model
{
    protected $table = 'role_user';
    protected $primaryKey = 'id';
    protected $fillable = ['role_id', 'user_id', 'created_at', 'updated_at'];

    public function rol ()
 	{
 		return $this->belongsTo(Role::class, 'role_id');
 	}   

	public function user ()
 	{
 		return $this->belongsTo(User::class, 'user_id');
 	} 	
}
