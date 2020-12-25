<?php

namespace App\Http\Controllers\Cobranza;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cobranza\Asignacion;
use App\Models\Cobranza\ClientesCobranza;
use App\Models\Cobranza\GestionesCobranza;
use App\Models\Cobranza\Cuotas;
use App\Models\Cobranza\DetalleCuotas;
use App\Imports\AsignacionesImport;
use App\Exports\AsignacionRespaldoExport;
use Illuminate\Console\Command;
use Excel;
use DB;
use App\Collection;
class ClientesController extends Controller
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
        $cedula = $request->get('cedula');
        $agente = $request->get('agente');
        $nombres = $request->get('nombres');
        $clientes = ClientesCobranza::select(
                                            'tbCampañaPersona.IdCampaña',
                                            'tbCampañaPersona.Identificacion',
                                            'tbCampañaPersona.IdAgente',
                                            'tbCampañaPersona.Campo9',
                                            'tbCampañaPersona.Nombres',
                                            'tbCampañaPersona.ValorDeuda',
                                            'tbCampañaPersona.SaldoDeuda',
                                            'tbCampaña.Descripcion'
                                            )
                                    ->join('tbCampaña', 'tbCampaña.IdCampaña', '=', 'tbCampañaPersona.IdCampaña')
                                    ->cedula($cedula)
                                    ->agente($agente)
                                    ->nombres($nombres)
                                    ->orderBy('tbCampañaPersona.Campo9', 'DESC')
                                    ->paginate(8);

        $cartera =  DB::connection('sqlsrv')->select(" SELECT  COUNT(Identificacion) as clientes, Campo9 as area
                                                        FROM tbCampañaPersona 
                                                        group by Campo9");                        



        return view('Cobranza.Clientes.index',compact('clientes','cartera'));
    }

    public function edit($idc,$ced)
    {
        
        $datos = ClientesCobranza::where('Identificacion',$ced)->where('IdCampaña',$idc)->first();
        //$datos = DB::connection('sqlsrv')->select("SELECT * FROM tbCampañaPersona WHERE cast(IdCampaña as nvarchar(10))+Identificacion ='$id'")->first();
        $areas = DB::connection('sqlsrv')->select("SELECT DISTINCT Campo9 FROM tbCampañaPersona");
        $agentes = DB::connection('sqlsrv')->select("SELECT DISTINCT IdPersona FROM tbPersona");

        $pagos = DB::connection('sqlsrv')->select("SELECT * FROM tbCampañaPersonaPago WHERE Identificacion='$ced' AND IdCampaña='$idc' and UsuAnula is null order by FecRegistro desc");
       // dd($datos);
        
        return view('Cobranza.Clientes.edit',compact('datos','areas','agentes','pagos'));

    }


    public function update(Request $request, $idc,$ced)
    {  
        
        

        /**
         * validar que vengan los campos con datos si no conservar el mismo anterior  
         */
        if (is_null($request->Campo92)) {
            $area = $request->Campo9;
          
        }else {
            $area = $request->Campo92;
        }
        
        if (is_null($request->IdPersona2)) {
            $agente = $request->IdAgente;
            
        }else {
            $agente=$request->IdPersona2;
        }
       // dd($agente.' '.$area);

        $agente = ClientesCobranza::where('Identificacion',$ced)->where('IdCampaña',$idc)->update(['IdAgente' => $agente]);// actualizar agente
        $area = ClientesCobranza::where('Identificacion',$ced)->where('IdCampaña',$idc)->update(['Campo9' => $area]);// actualizar area


        return redirect()->route('clientes.edit', [$idc,$ced])->with('msg', 'Cliente Actualizado !!');
    }

    public function show($idc,$ced)
    {
        
        $datos = ClientesCobranza::where('Identificacion',$ced)->where('IdCampaña',$idc)->first();
        $areas = DB::connection('sqlsrv')->select("SELECT DISTINCT Campo9 FROM tbCampañaPersona");
        $agentes = DB::connection('sqlsrv')->select("SELECT DISTINCT IdPersona FROM tbPersona");
        $pagos = DB::connection('sqlsrv')->select("SELECT * FROM tbCampañaPersonaPago WHERE Identificacion='$ced' AND IdCampaña='$idc' and UsuAnula is null order by FecRegistro desc");
        $cuotas = Cuotas::where('Identificacion',$ced)->where('IdCampaña',$idc)->first();
       // dd($cuotas);
        
        if (!is_null($cuotas)) {
            $cuotanum = $cuotas->IdCampañaPersonaCuota;
            $detallecuotas = DetalleCuotas::where('IdCampañaPersonaCuota',$cuotanum )->get();
           // DD($cuotanum);
        }else {
            $detallecuotas=0;
        }
        
     
        $direciones = DB::connection('sqlsrv')->select(" SELECT Identificacion,Direccion,Referencia,UsuRegistro,FecRegistro FROM tbCampañaPersonaDireccion WHERE  Identificacion='$ced' AND IdCampaña='$idc' order by FecRegistro desc ");
        $telefonos = DB::connection('sqlsrv')->select(" SELECT distinct TelefonoPersona,NombreReferencia from tbCampañaPersonaTelefono WHERE Identificacion='$ced' AND IdCampaña='$idc' ");
        
        $gestiones = GestionesCobranza::select(
            'tbRegistroLlamada.Identificacion',
            'tbRegistroLlamada.FecRegistro',
            'tbRegistroLlamada.UsuRegistro',
            'tbRegistroLlamada.Comentario',
            'tbRegistroLlamada.PromesaMontoPago',
            'tbRegistroLlamada.PromesaPago',
            'tbValorDetalle.Descripcion',
            'tbRegistroLlamada.TelefonoPersona'
            )
        ->join('tbValorDetalle', 'tbValorDetalle.IdValorDetalle', '=', 'tbRegistroLlamada.IdRespuesta')
        ->where('IdCampaña',$idc)
        ->where('Identificacion',$ced)
        ->orderBy('FecRegistro', 'DESC')
        ->paginate(10);
        
        return view('Cobranza.Clientes.show',compact('datos','areas','agentes','pagos','gestiones','direciones','telefonos','cuotas','detallecuotas'));

    }


    
    public function cartera($cartera)
    {
        $datos = ClientesCobranza::where('Campo9',$cartera)->first();
        //dd(  $datos );
        return view('Cobranza.Clientes.cartera',compact('datos','areas','agentes','pagos'));

    }
}
