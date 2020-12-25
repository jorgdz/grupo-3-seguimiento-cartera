<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class HomeController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	} 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	$user = User::with(['usuarioRoles', 'cargosDepartamento'])->findOrFail(\Auth::user()->id);

        return view('home', ['user' => $user]);
    }
}
