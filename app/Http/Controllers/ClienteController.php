<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Cliente;
use App\Models\Admin\DetalleCampania;

class ClienteController extends Controller
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
        $detalleCampanias = DetalleCampania::with('cliente')
            ->with('campania')
            ->with('pagos')
            ->with('pagos.detallePagos')
            ->cedulaCliente($request->get('cedula'))
            ->orderBy('id', 'desc')
            ->paginate(50);

        return view ('clientes.index', ['detalleCampanias' => $detalleCampanias]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function campanias(Request $request)
    {
        return view ('clientes.clientes');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cliente(Request $request)
    {
        $id = $request->get('id');
        return view ('clientes.cliente', array('id' => $id));
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
        $detalleCampania = DetalleCampania::with(['campania', 'cliente', 'pagos', 'pagos.detallePagos'])
            ->findOrfail($id);

        return view('clientes.show', ['detalleCampania' => $detalleCampania]);
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
