<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Models\Admin\Cargo;

class UserCargo extends Model
{
    protected $table = 'cargo_departamentos';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'cargo_id', 'deptempresa_id'];
    public $timestamps = false;

    public function user ()
 	{
 		return $this->belongsTo(User::class, 'user_id');
 	}

 	public function cargo ()
 	{
 		return $this->belongsTo(Cargo::class, 'cargo_id');
 	}   

}
