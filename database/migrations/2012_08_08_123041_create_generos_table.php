<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_genero',100);
            $table->string('abreviatura', 50);
        });

        DB::table('generos')->insert(array('nombre_genero' => 'Masculino', 'abreviatura' => 'M'));   
        DB::table('generos')->insert(array('nombre_genero' => 'Femenino', 'abreviatura' => 'F'));   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('generos');
    }
}
