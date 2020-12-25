<?php

namespace App\Models\Predictivo;

use Illuminate\Database\Eloquent\Model;

class VicidialUserGrupo extends Model
{
    public $timestamps = false;
    protected $connection = 'asterisk';
    protected $table ='vicidial_user_groups';
    protected $fillable = ['group_name', 'user_group',];

  
}
