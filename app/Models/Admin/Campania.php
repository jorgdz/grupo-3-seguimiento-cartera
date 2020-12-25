<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\DetalleCampania;

class Campania extends Model
{
   // protected $table = "campanias";
    protected $fillable = ['nombre_campania', 'descripcion'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function detalleCampania ()
    {
        return $this->hasMany(DetalleCampania::class, 'campania_id');
    }
}	
