<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaniasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_campania', 150)->unique();
            $table->text('descripcion')->nullable();
        });

        DB::table('campanias')->insert(array(
            'nombre_campania' => 'RM Campaña', 
            'descripcion' => ''
        )); 

        DB::table('campanias')->insert(array(
            'nombre_campania' => 'DP Campaña', 
            'descripcion' => ''
        )); 

        DB::table('campanias')->insert(array(
            'nombre_campania' => 'ETH Campaña', 
            'descripcion' => ''
        )); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campanias');
    }
}
