<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePresupuesto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuesto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->string('nombre')();
            $table->decimal('valor','8','2');
            $table->string('estado')->comment('1=Activo;0=Inactivo');
            $table->timestamps();
        });
        Schema::create('presupuesto_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('presupuesto_id')->unsigned();
            $table->integer('categoria_transac_id')->unsigned();
            $table->decimal('valor','8','2');
            $table->string('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presupuesto');
        Schema::dropIfExists('presupuesto_detalle');
    }
}
