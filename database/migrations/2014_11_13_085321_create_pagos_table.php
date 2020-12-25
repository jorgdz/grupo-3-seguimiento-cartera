<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');

            /*$table->integer('detalle_campania_id')->unsigned();
            $table->foreign('detalle_campania_id')->references('id')->on('detalle_campanias')->onDelete('cascade');*/
            $table->string('campania_idc', 100);
            $table->integer('periodo');

            $table->double('interes');
            $table->double('cuota');
            $table->double('abono');
            $table->date('fecha_pago');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
