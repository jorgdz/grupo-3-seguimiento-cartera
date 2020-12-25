<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin\Departamento;
use App\Models\Admin\DepartamentoEmpresa;

class DepartamentoController extends Controller
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
        $departamentos = Departamento::searchWhere('nombre_departamento', 'LIKE', '%'.$request->get('search').'%')
                    ->searchOrWhere('descripcion_departamento', 'LIKE', '%'.$request->get('search').'%')
                    ->orderBy('id', 'desc')->paginate(8);
                    
        return view('departamentos.index', array('departamentos' => $departamentos));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('departamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departamento = new Departamento();

        $validate = \Validator::make($request->all(), [          
            'nombre_departamento' => 'required|unique:departamentos'       
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        $departamento->create($request->all());

        return redirect()->route('departamentos.index', $departamento->id)->with('msg', 'Se ha creado un nuevo departamento !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dept = DepartamentoEmpresa::searchWhere('empresa_id', '=', $id)->with('departamento')->orderBy('id', 'desc')->get();
        return response()->json($dept, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departamento = Departamento::findOrFail($id);
        return view('departamentos.edit', ['departamento' => $departamento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamento $departamento)
    {
        $validate = \Validator::make($request->all(), [          
            'nombre_departamento' => ['required', 'unique:departamentos,nombre_departamento,'.$departamento->id]
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }
   
        $departamento->update($request->all());

        return redirect()->route('departamentos.index')->with('msg', 'Departamento actualizado !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departamento = Departamento::findOrFail($id);
        $departamento->delete();
        return back()->with('msg', 'Departamento eliminado !!');
    }
}
