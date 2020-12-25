<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Permiso;

class PermisoController extends Controller
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
        $permisos = Permiso::searchWhere('name', 'LIKE', '%'.$request->get('search').'%')
            ->searchOrWhere('description', 'LIKE', '%'.$request->get('search').'%')
            ->searchOrWhere('slug', 'LIKE', '%'.$request->get('search').'%')
            ->orderBy('id', 'desc')->paginate(8);

        return view('admin.permiso.index', ['permisos' => $permisos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permiso.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permiso = new Permiso();

        $validate = \Validator::make($request->all(), [          
            'name' => 'required|unique:permissions',
            'slug' => 'required|unique:permissions'        
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        $permiso->create($request->all());

        return redirect()->route('permissions.index', $permiso->id)->with('msg', 'Se ha creado un nuevo permiso !!');
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
        $permiso = Permiso::findOrFail($id);
        return view('admin.permiso.edit', ['permiso' => $permiso]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permiso $permission)
    {
        $validate = \Validator::make($request->all(), [          
            'name' => ['required', 'unique:permissions,name,'.$permission->id],
            'slug' => ['required', 'unique:permissions,slug,'.$permission->id],
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        $permission->name = $request->name;
        $permission->slug = $request->slug;
        $permission->description = $request->description;
   
        $permission->update();

        return redirect()->route('permissions.index')->with('msg', 'Permiso actualizado !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permiso = Permiso::findOrFail($id);
        $permiso->delete();
        return back()->with('msg', 'Permiso borrado !!');
    }
}
