<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Admin\Permiso;

class PermisoUser extends Model
{
    protected $table = 'permission_user';
    protected $primaryKey = 'id';
    protected $fillable =  ['permission_id', 'user_id', 'created_at', 'updated_at'];

    public function user ()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function permiso ()
    {
    	return $this->belongsTo(Permiso::class, 'permission_id');
    }
}
