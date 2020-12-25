<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin\Cargo;

class CargoController extends Controller
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
        $cargos = Cargo::searchWhere('nombre_cargo', 'LIKE', '%'.$request->get('search').'%')
                    ->orderBy('id', 'desc')->paginate(8);
                    
        return view('cargos.index', array('cargos' => $cargos));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cargos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cargo = new Cargo();

        $validate = \Validator::make($request->all(), [          
            'nombre_cargo' => 'required|unique:cargos'       
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        $cargo->create($request->all());

        return redirect()->route('cargos.index', $cargo->id)->with('msg', 'Se ha creado un nuevo cargo !!');
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
        $cargo = Cargo::findOrFail($id);
        return view('cargos.edit', ['cargo' => $cargo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cargo $cargo)
    {
        $validate = \Validator::make($request->all(), [          
            'nombre_cargo' => ['required', 'unique:cargos,nombre_cargo,'.$cargo->id]
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }
   
        $cargo->update($request->all());

        return redirect()->route('cargos.index')->with('msg', 'Cargo actualizado !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cargo = Cargo::findOrFail($id);
        $cargo->delete();
        return back()->with('msg', 'Cargo eliminado !!');
    }
}
