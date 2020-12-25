<?php

namespace App\Http\Controllers\Cobranza;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cobranza\Asignacion;
use App\Models\Cobranza\Asinacionrespaldo;
use App\Imports\AsignacionesImport;
use App\Exports\AsignacionRespaldoExport;
use Illuminate\Console\Command;
use Excel;
use DB;
class AsignacionController extends Controller
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
    public function index()
    {
        return view('Cobranza.Asignaciones.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function descargarespaldo()
    {

        return (new AsignacionRespaldoExport)->download('respaldocobranza.xlsx');
     
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importData(Request $request)
    {
        $DELETETABLE = DB::connection('sqlsrv')->statement("TRUNCATE TABLE  DAMPLUSAsignacion");

        $request->validate([
            'import_file' => 'required'
        ]);
            //IMPORTAR DATOS EN DAMPLUSAsignacion
        Excel::import(new AsignacionesImport, request()->file('import_file'));

        // validar asesores de la asignacion  existan
        $noexisteUser = DB::connection('sqlsrv')->select("SELECT distinct ASESOR FROM DAMPLUSAsignacion WHERE not ASESOR IN (SELECT DISTINCT IdPersona FROM tbPersona)");
        
        
        if ($noexisteUser) {
            return view('Cobranza.Asignaciones.corregir' , ['noexisteUser' => $noexisteUser]);
            
         }else {
                // validar idc de la asignacion  existan
            $noexisteIdc = DB::connection('sqlsrv')->select("SELECT * FROM ASIGNAR WHERE  not  IDC IN (
                SELECT cast(IdCampaña as nvarchar(10))+Identificacion FROM tbCampañaPersona)");



            if ($noexisteIdc) {
                return view('Cobranza.Asignaciones.corregir' , ['noexisteIdc' => $noexisteIdc]);
                
            }else {
                

                //ELIMINAR TABLA DE RESPALDO
                $DELETERESPALDO = DB::connection('sqlsrv')->statement(" TRUNCATE TABLE  ASIGNAR");
                    //INGRESAR RESPALDO DE ASIGNACION ACTUAL
                $RESPALDO = DB::connection('sqlsrv')->statement("INSERT INTO ASIGNAR 
                                                                SELECT cast(IdCampaña as nvarchar(10))+Identificacion as idc, IdAgente as asesor,Campo9,1
                                                                FROM tbCampañaPersona 
                                                                WHERE cast(IdCampaña as nvarchar(10))+Identificacion IN (SELECT IDC FROM DAMPLUSAsignacion)");
                
                //ASIGNACION 
                $DELETETABLE = DB::connection('sqlsrv')->statement("
                
                UPDATE tbCampañaPersona
                SET tbCampañaPersona.IdAgente = tf.ASESOR
                FROM tbCampañaPersona
                INNER JOIN (
                    SELECT IDC,ASESOR
                    FROM DAMPLUSAsignacion 
                    
                ) AS tf
                ON cast(tbCampañaPersona.IdCampaña as nvarchar(10))+Identificacion = tf.IDC 
                
                ");
                return (new AsignacionRespaldoExport)->download('respaldocobranza.xlsx');
            
                return back()->with('success', 'Importacion con Exito');

            }

         }
     
       
        
        
    }

}
