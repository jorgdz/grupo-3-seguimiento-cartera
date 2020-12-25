<?php

namespace App\Http\Controllers;

use App\Models\Predictivo\VicidialUsers;
use Illuminate\Http\Request;

class VicidialUsersController extends Controller
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
        //
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
     * @param  \App\Models\Predictivo\VicidialUsers  $vicidialUsers
     * @return \Illuminate\Http\Response
     */
    public function show(VicidialUsers $vicidialUsers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Predictivo\VicidialUsers  $vicidialUsers
     * @return \Illuminate\Http\Response
     */
    public function edit(VicidialUsers $vicidialUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Predictivo\VicidialUsers  $vicidialUsers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VicidialUsers $vicidialUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Predictivo\VicidialUsers  $vicidialUsers
     * @return \Illuminate\Http\Response
     */
    public function destroy(VicidialUsers $vicidialUsers)
    {
        //
    }
}
