<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin\DetalleCampania;
use App\Models\Admin\Pago;
use App\Models\Admin\DetallePago;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detalles($id)
    {
        $pago = Pago::with(['detallePagos' => function ($q) { $q->orderBy('id', 'asc'); }])->findOrFail($id);
        return view('pagos.amortizacion', ['pago' => $pago]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detallePagos($id)
    {
        $pago = Pago::with(['detallePagos' => function ($q) { $q->orderBy('id', 'asc'); }])->findOrFail($id);
        return view('pagos.detallePago', ['pago' => $pago]);
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
    public function update(Request $request, DetalleCampania $detalleCampania)
    {
        try{
        
            $pago = new Pago();

            $validate = \Validator::make($request->all(), [          
                'periodo' => 'required|numeric',       
                'interes' => 'required|numeric|between:0.00,999.99',       
                'abono' => 'required|numeric|between:0.00,9999.99',       
                'fecha_pago' => 'required',       
            ]);
     
            if ($validate->fails())
            {
                return redirect()->back()->withInput()->withErrors($validate->errors());
            }

            $monto_cobrar = $detalleCampania->valor_saldo - $request->abono;
            $interesDecimal = ($request->interes / 100);
            $denominador = pow((1 / (1 + $interesDecimal)), $request->periodo);
            
            $cuota = ($interesDecimal * $monto_cobrar) / (1 - $denominador);
            

            /*
                Actualizando el saldo de la deuda de la campaña
            */
            $dCampania = DetalleCampania::findOrFail($detalleCampania->id);

            if ($dCampania->valor_saldo < 0.1) 
            {
                return redirect()->route('clientes.index')->with('msg', 'El cliente no tiene deuda para crear un plan de pago');
            }
            else
            {
                $dCampania->valor_saldo = ($dCampania->valor_saldo - $request->abono);
                $dCampania->update();

                
                /*
                    Creando el pago
                */       
                $pago->detalle_campania_id = $dCampania->id;
                $pago->periodo = $request->periodo;
                $pago->interes = $request->interes;
                $pago->cuota = $cuota;
                $pago->abono = $request->abono;
                $pago->fecha_pago = $request->fecha_pago;
                $pago->save();


                /*
                    Primer periodo de amortización
                */
                $detalle_pago = new DetallePago(); 
                $detalle_pago->pago_id = $pago->id;
                $detalle_pago->saldo_inicial = $monto_cobrar;
                $detalle_pago->cuota_fija = 0;
                $detalle_pago->fecha_pago = date("Y-m-d", strtotime($request->fecha_pago."+ 1 month"));
                $detalle_pago->save();

                return redirect()->route('clientes.index')->with('msg', 'Estimado usuario, el cliente '.$dCampania->cliente->nombres.' '.$dCampania->cliente->apellidos.' tiene una deuda de '.$dCampania->valor_deuda.' en la campaña de '.$dCampania->campania->nombre_campania.', con un saldo de $'.$detalleCampania->valor_saldo.' menos el abono $'.$dCampania->valor_saldo.', los pagos los efectuará al cabo de '.$request->periodo.' mes(es), con una cuota de $'.round($pago->cuota, 3).', su primer pago lo debe realizar a partir del '.date('d/M/Y', strtotime($pago->fecha_pago."+ 1 month")));
            }

        }
        catch(Exception $e)
        {
           return redirect()->route('clientes.index')->with('error', 'Lo sentimos se ha presentado un problema interno en el servidor');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->delete();
        return back()->with('msg', 'Pago eliminado !!');
    }
}
