<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Admin\Role;
use App\Models\Admin\Cargo;
use App\Models\Admin\Genero;
use App\Models\Admin\Campania;
use App\Models\Admin\Empresa;
use App\Models\Admin\Departamento;
use App\Models\Admin\CargoDepartamento;
use App\Models\Admin\DepartamentoEmpresa;
use App\Imports\ImportUsers;
use App\Imports;
use Excel;
use DateTime;
use DB;
use Illuminate\Support\Facades\Input;
class UserController extends Controller
{

    public function __construct()
	{
		$this->middleware('auth');
	} 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $users = User::with('genero')->searchWhere('cedula', 'LIKE', '%'.$request->get('search').'%')
            ->searchOrWhere('nombre1', 'LIKE', '%'.$request->get('search').'%')
            ->searchOrWhere('nombre2', 'LIKE', '%'.$request->get('search').'%')
            ->searchOrWhere('apellido_paterno', 'LIKE', '%'.$request->get('search').'%')
            ->searchOrWhere('apellido_materno', 'LIKE', '%'.$request->get('search').'%')
            ->searchOrWhere('usuario', 'LIKE', '%'.$request->get('search').'%')
    
            ->orderBy('id', 'desc')->paginate(7);

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $generos = Genero::orderBy('id', 'asc')->get();
        $campanias = Campania::orderBy('nombre_campania', 'asc')->get();
        return view('users.create', array('generos' => $generos, 'campanias' => $campanias));
    }




    public function sanear_string($string)
    {
 
            $string = trim($string);
        
            $string = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
                array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
                $string
            );
        
            $string = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
                array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
                $string
            );
        
            $string = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
                array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
                $string
            );
        
            $string = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
                array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
                $string
            );
        
            $string = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
                array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
                $string
            );
        
            $string = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'),
                array('n', 'N', 'c', 'C',),
                $string
            );
 
    
 
 
        return $string;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();

        $validate = \Validator::make($request->all(), [          
            'cedula' => 'required|unique:users|ecuador:ci',
            'nombre1' => 'required',
            'nombre2' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'genero_id' => 'required',
            'fecha_nacimiento' => 'required|date_format:"Y-m-d"'
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        $user->cedula = $request->cedula;
        $user->nombre1 = $request->nombre1;
        $user->nombre2 = $request->nombre2;
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;
        $user->direccion = $request->direccion;
        $user->celular = $request->celular;
        $user->telefono = $request->telefono;
        $user->estado_civil = $request->estado_civil;
        $user->email = $request->email;
        $user->genero_id = $request->genero_id;
        $user->foto = 'user.png';
        $user->campania = $request->campania;
        $usuariogenerado = $this->getNickname(strtolower($request->nombre1), strtolower($request->nombre2), strtolower($request->apellido_paterno), strtolower($request->apellido_materno));
        
        $user->usuario = $this->sanear_string($usuariogenerado);

        $user->password = bcrypt($request->cedula);
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->enabled = $request->enabled;
        
        if (empty($request->direccion) || empty($request->celular) || empty($request->telefono) || empty($request->estado_civil) || empty($request->email) || empty($request->genero_id) || empty($request->fecha_nacimiento))  
        {
            $user->perfil_actualizado = false;
        }
        else
        {
            $user->perfil_actualizado = true;
        }

        /**guardar el usuario con mayusculas */
        $user->usuario = strtoupper($user->usuario);
        $user->apellido_paterno = strtoupper($user->apellido_paterno);
        $user->apellido_materno = strtoupper($user->apellido_materno);
        $user->nombre1 = strtoupper($user->nombre1);
        $user->nombre2 = strtoupper($user->nombre2);
        $user->save();

        return redirect()->route('users.edit', $user->id)->with('msg', 'Usuario registrado !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('usuarioRoles')
                    ->with('cargosDepartamento')
                    ->findOrFail($id);
                    
        return view('users.show', ['user' => $user]);
    }


    public function getNickname($nombre1, $nombre2, $apellido_paterno, $apellido_materno)
    {
        $nick = $nombre1[0].''.$apellido_paterno;
        
        $findUserNick1 = User::searchWhere('usuario', '=', $nick)->first();

        if (!empty($findUserNick1)) 
        {
            $nick .= $apellido_materno[0];

            $findUserNick2 = User::searchWhere('usuario', '=', $nick)->first();

            if (!empty($findUserNick2)) 
            {
                $nick .= $nombre2[0];
            }
        }

        return $nick;
    }

    /**
     * Assign position for user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function position ($id)
    {
        $user = User::findOrFail($id);
        $cargos = Cargo::orderBy('nombre_cargo', 'asc')->get();
        $departamento = Departamento::orderBy('nombre_departamento', 'asc')->get();
        return view('users.position', ['user' => $user, 'cargos' => $cargos, 'departamento' => $departamento]);
    }

    /**
     * Save assign position for user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assign (Request $request, User $user)
    {
        $validate = \Validator::make($request->all(), [          
            'departamento' => 'required',
            'cargo' => 'required'
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        $exist = CargoDepartamento::searchWhere('user_id', '=', $user->id)
                    ->searchWhere('cargo_id', '=', $request->cargo)
                    ->searchWhere('departamento_id', '=', $request->departamento)->first();

        if (!empty($exist))
        {
            return redirect()->back()->with('error', 'Lo sentimos, el usuario que seleccionó ya tiene ese cargo asignado !!');
        }
        else
        {
            $cdept = new CargoDepartamento();
            $cdept->user_id = $user->id;
            $cdept->cargo_id = $request->cargo;
            $cdept->departamento_id = $request->departamento;
            $cdept->save();

            return redirect()->route('users.index')->with('msg', 'Se ha asignado al usuario '.$user->nombre1.' '.$user->apellido_paterno.' en el cargo de '.$cdept->cargo->nombre_cargo.' en el departamento de '.$cdept->departamento->nombre_departamento);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $generos = Genero::orderBy('id', 'asc')->get();
        $roles = Role::orderBy('id', 'desc')->get();
        $user = User::with(['usuarioRoles', 'genero'])->findOrFail($id);

        $campanias = Campania::orderBy('nombre_campania', 'asc')->get();
        return view('users.edit', ['user' => $user, 'roles' => $roles, 'generos' => $generos, 'campanias' => $campanias]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //DD($request);
        $validate = \Validator::make($request->all(), [          
            'cedula' => ['required','ecuador:ci','unique:users,cedula,'.$user->id],
            'nombre1' => 'required',
            'nombre2' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'genero_id' => 'required',
            'fecha_nacimiento' => 'required|date_format:"Y-m-d"'
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        $user->cedula = $request->cedula;
        $user->nombre1 = $request->nombre1;
        $user->nombre2 = $request->nombre2;
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;
        $user->direccion = $request->direccion;
        $user->celular = $request->celular;
        $user->telefono = $request->telefono;        
        $user->estado_civil = $request->estado_civil;
        $user->email = $request->email;
        $user->genero_id = $request->genero_id;
        $user->campania = $request->campania;

       // $user->usuario = $this->getNickname(strtolower($request->nombre1), strtolower($request->nombre2), strtolower($request->apellido_paterno), strtolower($request->apellido_materno));
        
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->enabled = $request->enabled;
        $user->update();

        $user->roles()->sync($request->get('roles'));

        return redirect()->route('users.edit', $user->id)->with('msg', 'Usuario actualizado !!');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('msg', 'Usuario borrado !!');
    }  

}
