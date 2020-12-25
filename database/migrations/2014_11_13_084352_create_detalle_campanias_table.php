<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleCampaniasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_campanias', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');

            $table->integer('campania_id')->unsigned();
            $table->foreign('campania_id')->references('id')->on('campanias')->onDelete('cascade');

           $table->double('valor_deuda');
           $table->double('valor_saldo');
           $table->date('fecha');
        });

        DB::table('detalle_campanias')->insert(array(
            'cliente_id' => 1, 
            'campania_id' => 2,
            'valor_deuda' => 480,
            'valor_saldo' => 480,
            'fecha' => '2019-08-10',
        ));

        DB::table('detalle_campanias')->insert(array(
            'cliente_id' => 2, 
            'campania_id' => 2,
            'valor_deuda' => 300,
            'valor_saldo' => 300,
            'fecha' => '2019-08-11',
        ));   

        DB::table('detalle_campanias')->insert(array(
            'cliente_id' => 1, 
            'campania_id' => 3,
            'valor_deuda' => 250,
            'valor_saldo' => 250,
            'fecha' => '2019-08-11',
        ));   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_campanias');
    }
}
