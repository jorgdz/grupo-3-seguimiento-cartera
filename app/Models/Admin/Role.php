<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\UsuarioRol;
use App\Models\Admin\PermisoRol;
use Caffeinated\Shinobi\Traits\ShinobiTrait;

class Role extends Model
{

	use ShinobiTrait;
	
    protected $table = "roles";
    protected $fillable = ['name', 'slug', 'description', 'created_at', 'updated_at', 'special'];
    protected $primaryKey = 'id';

    public function permisoRoles ()
    {
        return $this->hasMany(PermisoRol::class, 'role_id');
    }

    public function usuarioRoles ()
    {
        return $this->hasMany(UsuarioRol::class, 'role_id');
    }

}