<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula', 10);
            $table->string('nombre1');
            $table->string('nombre2');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->text('direccion')->nullable();
            $table->string('celular', 10)->nullable();
            $table->string('telefono', 12)->nullable();    
            $table->string('estado_civil')->nullable();
            $table->text('foto')->nullable();
            $table->date('fecha_nacimiento');
            $table->string('email')->nullable();
            $table->string('campania')->nullable();
            $table->boolean('enabled');
            $table->boolean('perfil_actualizado');

            $table->string('usuario')->unique();
            $table->string('password')->unique();

            $table->integer('genero_id')->unsigned();
            $table->foreign('genero_id')->references('id')->on('generos')->onDelete('cascade');

            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(array(
                'cedula' => '1207118470', 
                'nombre1' => 'Jorge',
                'nombre2' => 'Isrrael',
                'apellido_paterno' => 'Diaz',
                'apellido_materno' => 'Montoya',
                'foto' => '53377582.jfif',
                'fecha_nacimiento' => '1994-10-31',
                'enabled' => '1',
                'perfil_actualizado' => '1',
                'usuario' => 'admin',
                'password' => '$2y$12$ZhM5n8UreTdt2C3qbuaxweTSlKP89aTb714dYf8sQXAA5stHyTxaC',
                'genero_id' => '1',
            ));
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}