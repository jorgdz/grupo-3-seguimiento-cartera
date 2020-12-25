<?php

namespace App\Models\Predictivo;

use Illuminate\Database\Eloquent\Model;

class Phones extends Model
{
    public $timestamps = false;
    protected $connection = 'asterisk';
    protected $table ='phones';
    protected $fillable = ['extension','login', 'fullname','user_group', 'server_ip',];

  
}
