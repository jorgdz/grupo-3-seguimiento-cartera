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
            $table->string('cedula', 10);
            $table->string('nombres');
            $table->string('apellidos');
            $table->text('direccion')->nullable();
            $table->string('celular', 12)->nullable();
            $table->string('telefono', 12)->nullable();    
            $table->string('estado_civil', 90)->nullable();
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });

        DB::table('clientes')->insert(array(
            'cedula' => '1203124551', 
            'nombres' => 'Joaquin Olmedo',
            'apellidos' => 'Troya Jácome',
            'direccion' => 'Los ceibos',
            'celular' => '0952364112',
            'telefono' => '',
            'estado_civil' => 'Casado(a)',
            'user_id' => 1
        )); 

        DB::table('clientes')->insert(array(
            'cedula' => '0923111442', 
            'nombres' => 'Roxanna Maria',
            'apellidos' => 'Troya Montoya',
            'direccion' => 'Los rios y Ayacucho',
            'celular' => '0932014122',
            'telefono' => '',
            'estado_civil' => 'Soltero(a)',
            'user_id' => 1
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
