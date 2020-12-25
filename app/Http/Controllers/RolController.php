<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Role;
use App\Models\Admin\Permiso;

class RolController extends Controller
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
        $roles = Role::orderBy('id', 'desc')->paginate(8);
        return view('admin.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permisos = Permiso::orderBy('id', 'asc')->get();
        return view('admin.roles.create', ['permisos' => $permisos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role();

        $validate = \Validator::make($request->all(), [          
            'name' => 'required|unique:roles',
            'slug' => 'required|unique:roles',         
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->description = $request->description;
        $role->special = $request->special;
        $role->save();
        
        $role->permissions()->sync($request->get('permissions'));

        return redirect()->route('roles.edit', $role->id)->with('msg', 'Rol registrado !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = Role::findOrFail($id);
        $permisos = Permiso::orderBy('id', 'asc')->get();

        return view('admin.roles.show', ['rol' => $rol, 'permisos' => $permisos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol = Role::with('permisoRoles')->findOrFail($id);
        $permisos = Permiso::orderBy('id', 'asc')->get();
        return view('admin.roles.edit', ['rol' => $rol, 'permisos' => $permisos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validate = \Validator::make($request->all(), [                
            'name' => ['required', 'unique:roles,name,'.$role->id],
            'slug' => ['required', 'unique:roles,slug,'.$role->id]
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->description = $request->description;
        $role->special = $request->special;
        $role->update();

        $role->permissions()->sync($request->get('permissions'));

        return redirect()->route('roles.edit', $role->id)->with('msg', 'Rol actualizado !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = Role::findOrFail($id);
        $rol->delete();
        return back()->with('msg', 'Rol eliminado !!');
    }
}
