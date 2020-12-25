<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Admin\UsuarioRol;
use App\Models\Admin\PermisoUser;
use App\Models\Admin\Genero;
use App\Models\Admin\UserCargo;
use App\Models\Admin\CargoDepartamento;
use App\Models\Admin\Cliente;

use App\Models\Admin\Pago;
use App\Models\Admin\DetallePago;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable, ShinobiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //protected $remember_token = false;
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['cedula','nombre1', 'nombre2', 'apellido_paterno', 'apellido_materno', 'direccion', 'celular', 'genero_id', 'telefono', 'foto', 'estado_civil', 'email', 'discapacidad', 'comentario', 'extension', 'usuario', 'password', 'perfil_actualizado', 'enabled', 'created_at', 'updated_at', 'fecha_nacimiento'];
    
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /*protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/
    

    public function usuarioRoles ()
    {
        return $this->hasMany(UsuarioRol::class, 'user_id');
    }

    public function permisosUsers ()
    {
        return $this->hasMany(PermisoUser::class, 'user_id');
    }

    public function userCargos ()
    {
        return $this->hasMany(UserCargo::class, 'user_id');
    }
    
    public function cargosDepartamento ()
    {
        return $this->hasMany(CargoDepartamento::class, 'user_id');
    }
    
    public function clientes ()
    {
        return $this->hasMany(Cliente::class, 'user_id');
    }




    /*
        Pagos solo porque tengo el servicio rest de campañas clientes
    */
    public function pagos ()
    {
        return $this->hasMany(Pago::class, 'user_id');
    }
    public function detallePagos ()
    {
        return $this->hasMany(DetallePago::class, 'user_id');
    }











    public function genero()
    {
        return $this->belongsTo(Genero::class, 'genero_id');
    } 


    
    /*
        Get age
    */
    public function edad () 
    {
        $edad = Carbon::parse($this->fecha_nacimiento)->age; 
        return $edad;
    }



    /**
        Scopes
    */
    public function scopeSearchWhere($query, $column, $operator = null, $search = null)
    {
        if (trim($search) != "") 
        {
            $query->where($column, $operator, $search);
        }
    } 

    public function scopeSearchOrWhere($query, $column, $operator = null, $search = null)
    {
        if (trim($search) != "") 
        {
            $query->orWhere($column, $operator, $search);
        }
    }
}
