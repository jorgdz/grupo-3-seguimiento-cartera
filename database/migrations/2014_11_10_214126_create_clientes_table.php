<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Identificacion', 10);
            $table->string('Nombres');
            $table->string('Apellidos');
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
        });

        DB::table('clientes')->insert(array(
            'Identificacion'=> '1208910002',
            'Nombres'=> 'ROXANNA MARIA',
            'Apellidos'=> 'TROYA MONTOYA',
            'telefono'=> '0901256231',
            'direccion' => '',
        )); 

        DB::table('clientes')->insert(array(
            'Identificacion'=> '0923174440',
            'Nombres'=> 'JUAN ALFREDO',
            'Apellidos'=> 'CAVILCA MERA',
            'telefono'=> '',
            'direccion' => '',
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
