<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Genero extends Model
{
    protected $table = "generos";
    protected $fillable = ['nombre_genero', 'abreviatura'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function users()
    {
        return $this->hasMany(User::class, 'genero_id');
    }

}
