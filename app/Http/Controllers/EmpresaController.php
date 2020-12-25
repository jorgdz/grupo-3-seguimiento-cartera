<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin\Empresa;
use App\Models\Admin\Departamento;
use App\Models\Admin\DepartamentoEmpresa;

class EmpresaController extends Controller
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
        $empresas = Empresa::with(['departamentosEmpresa'])->searchWhere('nombre_empresa', 'LIKE', '%'.$request->get('search').'%')
                    ->searchOrWhere('descripcion_empresa', 'LIKE', '%'.$request->get('search').'%')
                    ->orderBy('id', 'desc')->paginate(8);
                    
        return view('empresas.index', array('empresas' => $empresas));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empresa = new Empresa();

        $validate = \Validator::make($request->all(), [          
            'nombre_empresa' => 'required|unique:empresas'       
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        $empresa->create($request->all());

        return redirect()->route('empresas.index', $empresa->id)->with('msg', 'Se ha creado una nueva empresa !!');
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
        $empresa = Empresa::with('departamentosEmpresa')->findOrFail($id);
        $departamentos = Departamento::with('departamentosEmpresa')->orderBy('id', 'asc')->get();
        $departamentosId = $this->getIdDepartamentosArray($empresa);

        return view('empresas.edit', ['empresa' => $empresa, 'departamentos' => $departamentos, 'departamentos_id' => $departamentosId]);
    }


    /**
    *   
    *
    *  Devolver un array de ID de departamentos de la empresa
    */
    public function getIdDepartamentosArray($objectCompany)
    {
        $departamentosId = array();

        foreach ($objectCompany->departamentosEmpresa->sort() as $dep) 
        {
            array_push($departamentosId, intval($dep->departamento->id));
        }
        
        return $departamentosId;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        $validate = \Validator::make($request->all(), [          
            'nombre_empresa' => ['required', 'unique:empresas,nombre_empresa,'.$empresa->id]
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }
   
        $empresa->update($request->all());


        /****************************************
                ASIGNANDO DEPARTAMENTOS
        ****************************************/

        $departamentos = array();
        $departamentosId = $this->getIdDepartamentosArray($empresa);

        /**
         *   Departamentos enviados desde la vista
         */
        $departamentos = $request->get('departamentos');

        if (!empty($departamentos)) 
        {
            foreach ($departamentos as $key => $departamento) 
            {                    
                if (!in_array($departamento, $departamentosId)) 
                {   
                    $depEmp = new DepartamentoEmpresa();
                    $depEmp->empresa_id = $empresa->id;
                    $depEmp->departamento_id = $departamento;
                    $depEmp->save();
                }                           
            }
        }

        if (!empty($empresa->departamentosEmpresa)) 
        {
            if (empty($departamentos))
            {
                foreach ($empresa->departamentosEmpresa as $dept) 
                { 
                    $findDepart = DepartamentoEmpresa::findOrFail($dept->id);
                    $findDepart->delete();
                }
            }
            else
            {
                foreach ($empresa->departamentosEmpresa as $dept) 
                {            
                    if (!in_array($dept->departamento->id, $departamentos))
                    {
                        $findDepart = DepartamentoEmpresa::findOrFail($dept->id);
                        $findDepart->delete();
                    }
                }
            }
        }
      
        return redirect()->route('empresas.index')->with('msg', 'Datos de la empresa actualizada !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();
        return back()->with('msg', 'Empresa eliminada !!');
    }
}
