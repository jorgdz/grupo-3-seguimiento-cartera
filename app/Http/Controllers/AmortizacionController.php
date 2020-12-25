<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin\DetallePago;
use App\Models\Admin\Pago;
use App\Models\Admin\DetalleCampania;

class AmortizacionController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	} 
    public function store(Request $request)
    {
    	$validate = \Validator::make($request->all(), [          
            'cuota_fija' => 'required|numeric|between:0.000,9999.999',         
            'pago_id' => 'required' 
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        $pago = Pago::with(['detallePagos' => function ($q) { $q->orderBy('id', 'asc'); }, 'detalleCampania'])->findOrFail($request->pago_id);
        
    	$detallePago = $pago->detallePagos->last();
    	$dp = DetallePago::findOrFail($detallePago->id);

    	if(round($request->cuota_fija, 4) > round($pago->cuota, 4))
    	{

    		return redirect()->route('pagos.detalles', $pago->id)->with('error', 'El valor que ha proporcionado en cuota es mayor a lo que debe pagar mensualmente');

    	} 

    	if (((round($dp->cuota_fija, 4) + round($request->cuota_fija, 4)) > round($pago->cuota, 4))) 
    	{

    		return redirect()->route('pagos.detalles', $pago->id)->with('error', 'El valor de la cuota es mayor a lo que debe pagar mensualmente');
    	
    	}

    	if (round($request->cuota_fija, 4) <= 0) 
    	{

    		return redirect()->route('pagos.detalles', $pago->id)->with('error', 'El valor de la cuota no puede ser menor o igual que cero');

    	}	
       
		$dp->cuota_fija = $dp->cuota_fija + $request->cuota_fija;
    	$dp->update();

    	if (round($dp->cuota_fija, 4) == round($pago->cuota, 4)) 
    	{	
        	$interes = $dp->saldo_inicial * ($pago->interes / 100);
            $capital = $dp->cuota_fija - $interes;
            $saldoInicial = ($dp->saldo_inicial - $capital);
        	
        	/*
				Actualizando el saldo de la deuda de la campaña del cliente
        	*/
        	$detalleCampania = DetalleCampania::findOrFail($pago->detalle_campania_id);
        	$detalleCampania->valor_saldo = $saldoInicial;
        	$detalleCampania->update();
            
            if ($saldoInicial <= 0.1) 
            {
            	return redirect()->route('pagos.detalles', $pago->id)->with('msg', 'Ya has terminado de pagar tus deudas, actualmente posee un saldo de cero');
            }
            else
            {        	
	    		$newDetallePago = new DetallePago();
	        	$newDetallePago->pago_id = $pago->id;

	        	$newDetallePago->saldo_inicial = $saldoInicial;

	        	$newDetallePago->cuota_fija = 0;
	        	$newDetallePago->fecha_pago = date("Y-m-d", strtotime($dp->fecha_pago."+ 1 month"));
	        	$newDetallePago->save();
            }
    	}

		return redirect()->route('pagos.detalles', $pago->id)->with('msg', 'Gracias, por favor se cumplido en tus pagos !!');     
    }

    public function simulador()
    {
    	return view ('pagos.simularAmortizacion');
    }

}
