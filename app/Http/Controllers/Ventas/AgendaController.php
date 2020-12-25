<?php

namespace App\Http\Controllers\Ventas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ventas\ClientesVentas;
use App\Models\Ventas\Damplusagenda;
use App\User;
use App\Models\Admin\Genero;
use Auth;
use Carbon\Carbon;
use App\flash;
class AgendaController extends Controller
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
    public function xxx(Request $request)
    {
     
        $clientes = ClientesVentas::where("IdCampañaPersona",'like',$request->texto."%")->take(10)->get();

        return view('Ventas.Bandeja.buscador.paginas', compact('clientes'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $generos = Genero::orderBy('id', 'asc')->get();
        //return view('Ventas.Bandeja.agenda', ['generos' => $generos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      
       
        $user = Auth::user();
        $usuario = $user->usuario;
        $date = Carbon::now();
        $fechaactualizar = $date->format('Y-m-d');
      
        $existe = Damplusagenda::select("id")->where('idc',$request->IdCampaña.$request->IdCampañaPersona)
        ->where('fecha','>=',$fechaactualizar)->first();
        
   //  dd($existe);

     if(!is_null($existe) ){
      
        return redirect()->back()->with('info', 'Cliente Ya cuenta con una Agenda Vigente..!');
     }

        $v = \Validator::make($request->all(), [
            
            'telefonoContacto' => 'required|digits_between:9,10|numeric',
            'contacto' => 'required|string',
            'telefonoNuevo' => 'digits_between:9,10|numeric',
            'fecha' => 'required',
            'turno' => 'required',
        ]);

 


        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
       

        $agenda = new Damplusagenda;
        $agenda->idc                =   $request->IdCampaña.$request->IdCampañaPersona; 
        $agenda->estado             =   'A'; 
        $agenda->users              =   $usuario; 
        $agenda->cedula             =   $request->IdCampañaPersona; 
        $agenda->campana            =   $request->IdCampaña; 
        $agenda->telefonoContacto   =   $request->telefonoContacto; 
        $agenda->contacto           =   $request->contacto; 
        $agenda->telefonoNuevo      =   $request->telefonoNuevo; 
        $agenda->contactarcel       =   $request->contactarcel; 
        $agenda->codigoArea         =   $request->codigoArea; 
        $agenda->convencional       =   $request->convencional; 
        $agenda->contactarconv      =   $request->contactarconv; 
        $agenda->turno              =   $request->turno; 
        $agenda->comentario         =   $request->comentario; 
        $agenda->fecha              =   $request->fecha;
        $agenda->hora               =   $request->hora;
        $agenda->created_at         =   $request->date;
        $agenda->updated_at         =   $request->fechaactualizar;
        $agenda->save();

        return redirect()->route('agenda.index')
        ->with('info', 'Cliente Agendado Correctamente..!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
