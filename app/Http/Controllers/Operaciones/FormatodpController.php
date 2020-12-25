<?php

namespace App\Http\Controllers\Operaciones;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operaciones\Formatodp;
use App\Imports\FormatodpImport;
use App\Exports\FormatodpExport;
use Illuminate\Console\Command;
use Excel;
use DB;
class FormatodpController extends Controller
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
        return view('Operaciones.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadData($type)
    {

        return (new FormatodpExport)->download('invoices.xlsx');
     
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importData(Request $request)
    {
        $DELETETABLE = DB::connection('sqlsrv4')->statement("TRUNCATE TABLE  DAMPLUSFormatodp");

        $request->validate([
            'import_file' => 'required'
        ]);
        Excel::import(new FormatodpImport, request()->file('import_file'));
            
       
        return (new FormatodpExport)->download('dp.xlsx');
       
        return back()->with('success', 'Importacion con Exito');
    }

}
