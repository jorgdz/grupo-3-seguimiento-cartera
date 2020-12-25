<?php

namespace App\Models\Predictivo;

use Illuminate\Database\Eloquent\Model;

class VicidialUsers extends Model
{
    public $timestamps = false;
    protected $connection = 'asterisk';
    protected $table ='vicidial_users';
    protected $fillable = ['user_id','user', 'full_name','user_group','phone_login', ];


    public function scopeUser($query, $user)
{
    if($user)
    return $query->where('user', 'LIKE', "%$user%"); 
}
}
