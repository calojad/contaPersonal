<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePresupuestoAddForeingnKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presupuesto', function (Blueprint $table) {
            $table->foreign('usuario_id')->references('id')->on('users');
        });
        Schema::table('presupuesto_detalle', function (Blueprint $table) {
            $table->foreign('presupuesto_id')->references('id')->on('presupuesto');
            $table->foreign('categoria_transac_id')->references('id')->on('categoria_transac');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presupuesto', function (Blueprint $table) {
            $table->dropForeign('presupuesto_usuario_id_foreign');
        });
        Schema::table('presupuesto_detalle', function (Blueprint $table) {
            $table->dropForeign('presupuesto_detalle_presupuesto_id_foreign');
            $table->dropForeign('presupuesto_detalle_categoria_transac_id_foreign');
        });
    }
}
