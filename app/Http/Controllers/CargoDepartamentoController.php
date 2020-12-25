<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin\CargoDepartamento;

class CargoDepartamentoController extends Controller
{

    public function __construct()
	{
		$this->middleware('auth');
	} 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cargoDep = CargoDepartamento::findOrFail($id);
        $cargoDep->delete();
        return back()->with('msg', 'Se ha eliminado el cargo a este usuario !!');
    }
}
