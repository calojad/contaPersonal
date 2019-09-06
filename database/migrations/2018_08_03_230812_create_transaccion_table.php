<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaccion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cuenta_id')->unsigned();
            $table->integer('tipo_transac_id')->unsigned();
            $table->integer('categoria_transac_id')->unsigned();
            $table->string('descripcion')->nullable();
            $table->decimal('valor','8','2');
            $table->date('fecha')->nullable()->default(null);
            $table->char('tipo')->nullable()->default(null)->coments('S:Salida;I:Ingreso,T:Transferencia');
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
        Schema::dropIfExists('transaccion');
    }
}
