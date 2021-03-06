	<?php

	/*
	|--------------------------------------------------------------------------
	| Web Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register web routes for your application. These
	| routes are loaded by the RouteServiceProvider within a group which
	| contains the "web" middleware group. Now create something great!
	|
	*/

	Route::get('/','LandingController@index');

	Route::group(['middleware' => ['guest']], function () {
		//User guest
		Route::get('/login','Auth\LoginController@formLogin');
		Route::post('/login','Auth\LoginController@login')->name('login');
	});


	Route::group(['middleware' => ['auth']], function () {
	// User auth
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

	Route::get('/inicio', 'HomeController@index')->name('inicio');

	Route::get('/perfil/edit', 'PerfilController@edit')->name('perfil.edit');
	Route::post('/perfil/{user}', 'PerfilController@update')->name('perfil.update');


	/*Route::get('/api/roles/{id}', function ($id){
	$rol = App\Models\Admin\Role::with('usuarioRoles')->with('usuarioRoles.user')->findOrFail($id);
	return response()->json($rol);	
	});*/


	/*
	*	
	*
	Permission routes
	*/

	/**
	* Usuario
	*/
	Route::group(['middleware' => ['perfil']], function () {

	Route::group(['middleware' => ['permission:users.store']], function () {
		Route::post('/users/store', 'UserController@store')->name('users.store');
	});

	Route::group(['middleware' => ['permission:users.index']], function () {
		Route::get('/users/index', 'UserController@index')->name('users.index');
	});

	Route::group(['middleware' => ['permission:users.create']], function () {
		Route::get('/users/create', 'UserController@create')->name('users.create');
	});

	Route::group(['middleware' => ['permission:users.update']], function () {
		Route::put('/users/{user}', 'UserController@update')->name('users.update');
	});		

	Route::group(['middleware' => ['permission:users.destroy']], function () {
		Route::delete('/users/{id}', 'UserController@destroy')->name('users.destroy');
	});			

	Route::group(['middleware' => ['permission:users.show']], function () {
		Route::get('/users/{id}', 'UserController@show')->name('users.show');
	});	

	Route::group(['middleware' => ['permission:users.edit']], function () {
		Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit');
	});

	Route::group(['middleware' => ['permission:users.position']], function () {
		Route::get('/users/{id}/position', 'UserController@position')->name('users.position');
	});

	Route::group(['middleware' => ['permission:users.assign']], function () {
		Route::put('/users/assign/{user}', 'UserController@assign')->name('users.assign');
	});



	Route::group(['middleware' => ['permission:home.showPlanPagos']], function () {
		Route::get('/dashboard', 'HomeController@showPlanPagos')->name('home.showPlanPagos');
	});



	/**
	* Rol
	*/
	Route::group(['middleware' => ['permission:roles.store']], function () {
		Route::post('/roles/store', 'RolController@store')->name('roles.store');
	});

	Route::group(['middleware' => ['permission:roles.index']], function () {
		Route::get('/roles/index', 'RolController@index')->name('roles.index');
	});

	Route::group(['middleware' => ['permission:roles.create']], function () {
		Route::get('/roles/create', 'RolController@create')->name('roles.create');
	});

	Route::group(['middleware' => ['permission:roles.update']], function () {
		Route::put('/roles/{role}', 'RolController@update')->name('roles.update');
	});		

	Route::group(['middleware' => ['permission:roles.destroy']], function () {
		Route::delete('/roles/{id}', 'RolController@destroy')->name('roles.destroy');
	});			

	Route::group(['middleware' => ['permission:roles.show']], function () {
		Route::get('/roles/{id}', 'RolController@show')->name('roles.show');
	});	

	Route::group(['middleware' => ['permission:roles.edit']], function () {
		Route::get('/roles/{id}/edit', 'RolController@edit')->name('roles.edit');
	});



	/**
	*  Permisos
	*/
	Route::group(['middleware' => ['permission:permissions.store']], function () {
		Route::post('/permissions/store', 'PermisoController@store')->name('permissions.store');
	});

	Route::group(['middleware' => ['permission:permissions.index']], function () {
		Route::get('/permissions/index', 'PermisoController@index')->name('permissions.index');
	});

	Route::group(['middleware' => ['permission:permissions.create']], function () {
		Route::get('/permissions/create', 'PermisoController@create')->name('permissions.create');
	});

	Route::group(['middleware' => ['permission:permissions.update']], function () {
		Route::put('/permissions/{permission}', 'PermisoController@update')->name('permissions.update');
	});		

	Route::group(['middleware' => ['permission:permissions.destroy']], function () {
		Route::delete('/permissions/{id}', 'PermisoController@destroy')->name('permissions.destroy');
	});			

	Route::group(['middleware' => ['permission:permissions.show']], function () {
		Route::get('/permissions/{id}', 'PermisoController@show')->name('permissions.show');
	});	

	Route::group(['middleware' => ['permission:permissions.edit']], function () {
		Route::get('/permissions/{id}/edit', 'PermisoController@edit')->name('permissions.edit');
	});

	/**
	*  Departamentos
	*/	
	Route::group(['middleware' => ['permission:departamentos.index']], function () {
		Route::get('/departamentos/index', 'DepartamentoController@index')->name('departamentos.index');
	});

	Route::group(['middleware' => ['permission:departamentos.create']], function () {
		Route::get('/departamentos/create', 'DepartamentoController@create')->name('departamentos.create');
	});

	Route::group(['middleware' => ['permission:departamentos.store']], function () {
		Route::post('/departamentos/store', 'DepartamentoController@store')->name('departamentos.store');
	});

	Route::group(['middleware' => ['permission:departamentos.update']], function () {
		Route::put('/departamentos/{departamento}', 'DepartamentoController@update')->name('departamentos.update');
	});		

	Route::group(['middleware' => ['permission:departamentos.destroy']], function () {
		Route::delete('/departamentos/{id}', 'DepartamentoController@destroy')->name('departamentos.destroy');
	});		

	Route::group(['middleware' => ['permission:departamentos.edit']], function () {
		Route::get('/departamentos/{id}/edit', 'DepartamentoController@edit')->name('departamentos.edit');
	});
	
	Route::group(['middleware' => ['permission:pagos.report-general']], function () {
		Route::get('/pagos/report-general/{estado}', 'PagoController@generalReportClients')->name('pagos.report-general');
	});


	Route::get('/api/departamentos/{id}', 'DepartamentoController@show')->name('departamentos.show');

	Route::get('/api/clientes', function (Illuminate\Http\Request $request) {		
		$isAdmin = auth()->user()->hasRole('admin');

		$clientes = null;

		if($isAdmin) {
			$clientes = App\Models\Admin\DetalleCampania::cedulaCliente($request->cedula)
				->with('cliente')
				->with('campania')
				->paginate(7);
		} else {
			$clientes = App\Models\Admin\DetalleCampania::nombreCampania(\Auth::user()->campania)
				->cedulaCliente($request->cedula)
				->with('cliente')
				->with('campania')
				->paginate(7);
		}

		return response()->json($clientes, 200);
	});

	Route::get('/api/campaigns', function () {
		$campaigns = App\Models\Admin\Campania::orderBy('nombre_campania', 'asc')
			->get();

		return $campaigns;
	});
	
	Route::get('/api/campaigns/{id}/clients', function ($id) {
		$campaignClient = App\Models\Admin\DetalleCampania::with('cliente')
			->with('campania')
			->findOrFail($id);

		return response()->json($campaignClient, 200);
	});

	Route::get('/api/pagos', 'ApiPagoController@getPlanPagos');

	/**
	** Cargos
	*/	
	Route::group(['middleware' => ['permission:cargos.index']], function () {
		Route::get('/cargos/index', 'CargoController@index')->name('cargos.index');
	});

	Route::group(['middleware' => ['permission:cargos.create']], function () {
		Route::get('/cargos/create', 'CargoController@create')->name('cargos.create');
	});

	Route::group(['middleware' => ['permission:cargos.store']], function () {
		Route::post('/cargos/store', 'CargoController@store')->name('cargos.store');
	});

	Route::group(['middleware' => ['permission:cargos.update']], function () {
		Route::put('/cargos/{cargo}', 'CargoController@update')->name('cargos.update');
	});		

	Route::group(['middleware' => ['permission:cargos.destroy']], function () {
		Route::delete('/cargos/{id}', 'CargoController@destroy')->name('cargos.destroy');
	});		

	Route::group(['middleware' => ['permission:cargos.show']], function () {
		Route::get('/cargos/{id}', 'CargoController@show')->name('cargos.show');
	});	

	Route::group(['middleware' => ['permission:cargos.edit']], function () {
		Route::get('/cargos/{id}/edit', 'CargoController@edit')->name('cargos.edit');
	});



	/**
	*  Cargos departamentales
	*/
	Route::group(['middleware' => ['permission:cargosdepartamento.destroy']], function () {
		Route::delete('/cargosdepartamento/{id}', 'CargoDepartamentoController@destroy')->name('cargosdepartamento.destroy');
	});


	/*
	*  Campañas de Clientes
	*/
	Route::group(['middleware' => ['permission:clientes.index']], function () {
		Route::get('/clientes/index', 'ClienteController@index')->name('clientes.index');
	});

	// Route::group(['middleware' => ['permission:clientes.show']], function () {
	// 	Route::get('/clientes/{id}/show', 'ClienteController@show')->name('clientes.show');
	// });





	/************************************************************
		Clientes obtenidos de la Api
	************************************************************/
	Route::group(['middleware' => ['permission:clientes.campanias']], function () {
		Route::get('/clientes/campanias', 'ClienteController@campanias')->name('clientes.campanias');
		Route::get('/clientes/cliente', 'ClienteController@cliente')->name('clientes.cliente');
	});

	Route::group(['middleware' => ['permission:apipago.index']], function () {
		Route::get('/apipago/index', 'ApiPagoController@index')->name('apipago.index');
	});

	Route::group(['middleware' => ['permission:apipago.store']], function () {
		Route::post('/apipago/store', 'ApiPagoController@store')->name('apipago.store');
	});

	Route::group(['middleware' => ['permission:apipago.destroy']], function () {
		Route::delete('/apipago/{id}', 'ApiPagoController@destroy')->name('apipago.destroy');
	});
	/************************************************************/



	/*
	Plan de pagos
	*/
	// Route::group(['middleware' => ['permission:pagos.update']], function () {
	// 	Route::put('/pagos/{detalleCampania}', 'PagoController@update')->name('pagos.update');
	// });

	Route::group(['middleware' => ['permission:pagos.detalles']], function () {
		Route::get('/pagos/detalles/{id}', 'PagoController@detalles')->name('pagos.detalles');
	});
	
	Route::group(['middleware' => ['permission:pagos.imprimir']], function () {
		Route::get('/pagos/imprimir/{id}', 'AmortizacionController@generatePDF')->name('pagos.imprimir');
	});



	/************************************************************
		Detalles de Pagos obtenidos de la Api
	************************************************************/
	// Route::group(['middleware' => ['permission:pagos.detallespago']], function () {
	// 	Route::get('/pagos/detalles/pago/{id}', 'PagoController@detallePagos')->name('pagos.detallespago');
	// });
	/************************************************************/




	// Route::group(['middleware' => ['permission:pagos.destroy']], function () {
	// 	Route::delete('/pagos/{id}', 'PagoController@destroy')->name('pagos.destroy');
	// });



	/*
	Amortización o Detalle de pagos
	*/
	Route::group(['middleware' => ['permission:amortizacion.store']], function () {
		Route::post('/amortizacion/store', 'AmortizacionController@store')->name('amortizacion.store');
	});
	
	Route::group(['middleware' => ['permission:amortizacion.simulador']], function () {
		Route::get('/amortizacion/simulador', 'AmortizacionController@simulador')->name('amortizacion.simulador');
	});

	});

	});



	Route::get('/cifrar/{pass}', function ($pass) {
		$opciones = [
			'cost' => 12,
		];

		echo password_hash($pass, PASSWORD_BCRYPT, $opciones)."\n";
	});


	/*Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {*/

	/**PERMISOS */
	/* Route::get('permiso','PermisoController@index')->name('permiso');
	Route::get('permiso/create','PermisoController@create')->name('permiso_crear');*/

	/**MENU */
	/* Route::get('menu','MenuController@index')->name('menu');
	Route::get('menu/create','MenuController@create')->name('menu_crear');
	Route::post('menu/store','MenuController@store')->name('menu_gurdar');*/

	//});





	

