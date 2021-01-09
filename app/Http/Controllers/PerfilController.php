<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Services\FirebaseService;

class PerfilController extends Controller
{
    private $storage;

    public function __construct()
	{
        $this->middleware('auth');
        $this->storage = new FirebaseService();
	} 
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit() {
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

        $user->fecha_nacimiento = $request->fecha_nacimiento;

        if (Input::hasFile('foto')) {
            
            $file = Input::file('foto');
            $file->move(public_path().'/fotos/',$file->getClientOriginalName());
            
            $fecha = new \DateTime();
            $namePhoto = $fecha->getTimestamp().'-'.$file->getClientOriginalName();

            $response = $this->storage->firebase->upload(
                fopen(public_path().'/fotos'.'/'.$file->getClientOriginalName(), 'r'),
                [
                    'predefinedAcl' => 'publicRead',
                    'name' => 'cartera/'.$namePhoto
                ]
            );
            
            if($response) {
                unlink(public_path().'/fotos'.'/'.$file->getClientOriginalName());

                if ($user->foto != 'https://storage.googleapis.com/istb-storage.appspot.com/cartera/user.png') {
                    $arrayPicture = explode('/', $user->foto);
                    
                    $object = $this->storage->firebase->object('cartera/'.$arrayPicture[(count($arrayPicture) - 1)]);
                    $object->delete();
                }
            }
   
            $user->foto = 'https://storage.googleapis.com/'.config('services.firebase.bucket').'/cartera'.'/'.$namePhoto;
        }
        
        $user->perfil_actualizado = true;

        $user->update();

        return redirect()->route('perfil.edit', $user->id)->with('msg', 'Tus datos han sido actualizado !!');
    }
}
