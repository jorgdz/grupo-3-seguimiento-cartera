<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;

class PerfilController extends Controller
{

    public function __construct()
	{
		$this->middleware('auth');
	} 
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $perfil = \Auth::user();
        return view('users.profile', ['user' => $perfil]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //DD($request);
        $validate = \Validator::make($request->all(), [          
            'cedula' => ['required','ecuador:ci','unique:users,cedula,'.\Auth::user()->id],
           'nombre1' => 'required',
            'nombre2' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'direccion' => 'required',
            'celular' => ['required','unique:users,celular,'.$user->id],
            'estado_civil' => 'required',
            'email' => 'required',
            'extension' => 'required',
            'discapacidad' => 'required',
            'fecha_nacimiento' => 'required|date_format:"Y-m-d"'
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        $user->cedula = $request->cedula;
        $user->nombre1 = $request->nombre1;
        $user->nombre2 = $request->nombre2;
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;
        $user->direccion = $request->direccion;
        $user->celular = $request->celular;
        $user->telefono = $request->telefono;        
        $user->estado_civil = $request->estado_civil;
        $user->email = $request->email;
        
        if (!empty($request->password)) 
        {
            $user->password = bcrypt($request->password);
        }

        $user->discapacidad = $request->discapacidad;
        $user->comentario = $request->comentario;
        $user->extension = $request->extension;
        $user->fecha_nacimiento = $request->fecha_nacimiento;

        if (Input::hasFile('foto')) {
            $file = Input::file('foto');
            $file->move(public_path().'/fotos/',$file->getClientOriginalName());
            $user->foto = $file->getClientOriginalName();
        }
        
        $user->perfil_actualizado = true;

        $user->update();

        return redirect()->route('perfil.edit', $user->id)->with('msg', 'Tus datos han sido actualizado !!');
    }

}
