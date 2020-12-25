<?php

namespace App\Http\Controllers\Predictivo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Predictivo\VicidialUsers;
use App\Models\Predictivo\Phones;
use App\Models\Predictivo\VicidialUserGrupo;
use DB;
use App\Models\Cobranza\ClientesCobranza;
use App\Models\Cobranza\Usuarios;
use App\Models\Cobranza\Seguridad;
class PuestoController extends Controller
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

            //$clientes = Seguridad::get();
         //   $clientes = DB::connection('sqlsrv2')->table('SEG_Usuario')->get();
         // dd($clientes);

        $user = $request->get('user');
        $datos = VicidialUsers::orderBy('user_id', 'DESC')
        ->user($user)
        ->paginate(15);
      

        return view('Predictivo.puesto.index',compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agentes = VicidialUsers::where('user',$id)->first();
        //$telefonia = Phones::select('server_ip')->where('login',$id)->first();
        $telefonia = DB::connection('asterisk')->table('phones')->select('server_ip')->where('login',$id)->first();
        
        $visible=0;
        $ventas = '1';
        $cobranza = '7';
      
       if (!is_null($telefonia)) {  /**validar que venga con extension */
          
      
        foreach ($telefonia as  $value) {  /**recorrer la telefonia para asignar el area en la vista  */
         
            $valor = substr($value, -1);
            
            if ($valor == $ventas) {
                $visible=1;
            }else {
                $visible=2;
            }
        }
       
    }


        //dd($visible);
        $phone = Phones::where('active','Y')->orderBy('extension', 'DESC')->get();
        $grupo = VicidialUserGrupo::orderBy('user_group', 'DESC')->get();
        //dd($agentes);
        return view('Predictivo.puesto.edit',compact('agentes','phone','grupo','telefonia','visible'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  //dd($request);

        /**
         * validar que vengan los campos con datos si no conservar el mismo anterior  
         */
        if (is_null($request->user_group2)) {
            $grupo = $request->user_group;
          
        }else {
            $grupo = $request->user_group2;
        }

        if (is_null($request->phone_login2)) {
            $extension = $request->phone_login;
            
        }else {
            $extension=$request->phone_login2;
        }

     



        $user1 = Phones::where('login',$request->user)->update(['login' => 'LIBRE']);// libero la extension actual 
        $user2 = Phones::where('fullname',$request->user)->update(['fullname' => 'LIBRE']);//guardar nombre del agente en el usuario
        $user3 = Phones::where('extension',$extension)->update(['login' => $request->user]);//actualizar el usuario en la extension 
        $user4 = Phones::where('extension',$extension)->update(['fullname' => $request->user]);//guardar el nombre del agente en la extension
        $user5 = Phones::where('extension',$extension)->update(['user_group' => $grupo]);//actualizar el grupo del usuario
        //$user6 = Phones::where('extension',$extension)->update(['server_ip' => $request->server_ip]);//actualizar EL SERVIDOR DE TELEFONIA

        $user6 = VicidialUsers::where('user',$request->user)->update(['user' => $request->user]);//actualizar la extension del usuario
        $user6 = VicidialUsers::where('user',$request->user)->update(['phone_login' => $extension]);//actualizar la extension del usuario
        $user7 = VicidialUsers::where('user',$request->user)->update(['full_name' => $request->user]);//actualizar el nombre del usuario
        $user8 = VicidialUsers::where('user',$request->user)->update(['user_group' => $grupo]);//actualizar el grupo del usuario
       

        return redirect()->route('puestos.edit', $request->user)->with('msg', 'Usuario Actualizado !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
