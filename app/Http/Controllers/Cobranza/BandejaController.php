<?php

namespace App\Http\Controllers\Cobranza;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cobranza\Asignacion;
use App\Models\Cobranza\ClientesCobranza;
use App\Models\Cobranza\GestionesCobranza;
use App\Models\Cobranza\Cuotas;
use App\Models\Cobranza\PagosCobranza;
use App\Imports\AsignacionesImport;
use App\Exports\AsignacionRespaldoExport;
use Illuminate\Console\Command;
use Auth;
use Excel;
use DB;
use Carbon\Carbon;


use App\Collection;
class BandejaController extends Controller
{
    

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('Cobranza.Bandeja.index');

                      

        
    }



    public function data(Request $request)
    {
        
        $user = Auth::user();
        $usuario = $user->usuario;
        $date = Carbon::now();
        $fecha = $date->format('d-m-Y');
        $mes = $date->format('m');
        $ano = $date->format('Y');
        $dia = $date->format('d');
        $fecha_periodo="04-09-2019";
   
            /**total clientes  */
            $clientes = DB::connection('sqlsrv')->select("SELECT  count(Identificacion) CLIENTES,SUM(SaldoDeuda) AS  SALDO
                                                        FROM tbCampañaPersona
                                                        WHERE  
                                                                IdAgente='$usuario'"
                                                        );

            /** Cantidad de pagos */  
            $pagos = DB::connection('sqlsrv')->select("SELECT count(distinct(cast(IdCampaña as nvarchar(10))+Identificacion)) as pagos,SUM(Valor) AS valor 
                                                        FROM tbCampañaPersonaPago
                                                        WHERE  
                                                            UsuAnula is NULL
                                                            and FecRegistro >= '$fecha_periodo' 
                                                            and cast(IdCampaña as nvarchar(10))+Identificacion in (
                                                                SELECT  distinct(cast(IdCampaña as nvarchar(10))+Identificacion) 
                                                                FROM tbCampañaPersona
                                                                WHERE    IdAgente='$usuario')"
                                                    );
                                                   

               
    
         /** Valor a recuperar */
        /* $saldo =  ClientesCobranza::select(DB::raw('SUM(SaldoDeuda) as cantidad'))->where('IdAgente',$usuario)->get();
         foreach($saldo as $saldos){
            $saldox = round($saldos->cantidad,2);
         }*/
                            
     
              
         /** Valor recuperado */
         /*$valor = DB::connection('sqlsrv')->table('tbCampañaPersonaPago')
                                            ->select( DB::raw('SUM(Valor) as valor'))
                                            ->whereNull('UsuAnula')
                                            ->where('FecRegistro','>=',$fecha_periodo)
                                            ->whereIn('Identificacion',$clientestt)
                                            ->first();
        $valors = round($valor->valor,2);*/
       

        $compromisos = DB::connection('sqlsrv')->select("SELECT count(distinct(cast(IdCampaña as nvarchar(10))+Identificacion)) as clientes, SUM(PromesaMontoPago) as valor 
            from tbRegistroLlamada
            where UsuRegistro='$usuario'
            and PromesaPago >= CONVERT(date, GETDATE())
            and IdRespuesta='14'
            and cast(IdCampaña as nvarchar(10))+Identificacion not in 
            (	select distinct(cast(IdCampaña as nvarchar(10))+Identificacion) 
              from tbCampañaPersonaPago
              where  
                  UsuAnula is NULL
                  and FecRegistro >= '$fecha_periodo'
                  )");

                 
       

        $incumplidos = DB::connection('sqlsrv')->select("SELECT  count(distinct(cast(IdCampaña as nvarchar(10))+Identificacion)) as clientes, SUM(PromesaMontoPago) as valor  
        from tbRegistroLlamada
        where UsuRegistro='$usuario'
         and PromesaPago >=  '$fecha_periodo'
        and PromesaPago < CONVERT(date, GETDATE())
        and IdRespuesta='14'
        and cast(IdCampaña as nvarchar(10))+Identificacion not in 
            (SELECT distinct(cast(IdCampaña as nvarchar(10))+Identificacion) 
            from tbCampañaPersonaPago
            where  
              UsuAnula is NULL
              and FecRegistro >= '$fecha_periodo' 
              AND UsuConfirmacion IS NULL
              )
              ");

        $LLAMADAS = DB::connection('sqlsrv')->select("SELECT * FROM DAMPLUSgestionescobranzaDia where agente='$usuario'");

  

                    $datos = array(
                                'cantidad'          => $clientes,
                                'incumplidostt'     => $incumplidos,
                                'compromisostt'     => $compromisos,
                                'pagos'             => $pagos,
                                'llamadas'          => $LLAMADAS
                             );


                    return response()->json($datos);

    }

}
