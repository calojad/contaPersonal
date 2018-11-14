<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cuentas', function (Blueprint $table) {
            $table->foreign('usuario_id')->references('id')->on('users');
        });
        Schema::table('transaccion', function (Blueprint $table) {
            $table->foreign('cuenta_id')->references('id')->on('cuentas');
            $table->foreign('tipo_transac_id')->references('id')->on('tipo_transac');
            $table->foreign('categoria_transac_id')->references('id')->on('categoria_transac');
        });
        Schema::table('categoria_transac', function (Blueprint $table) {
            $table->foreign('tipo_transac_id')->references('id')->on('tipo_transac');
            $table->foreign('usuario_id')->references('id')->on('users');
        });
        Schema::table('tipo_transac', function (Blueprint $table) {
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cuentas', function (Blueprint $table) {
            $table->dropForeign('cuentas_usuario_id_foreign');
        });
        Schema::table('transaccion', function (Blueprint $table) {
            $table->dropForeign('transaccion_cuenta_id_foreign');
            $table->dropForeign('transaccion_tipo_transac_id_foreign');
            $table->dropForeign('transaccion_categoria_transac_id_foreign');
        });
        Schema::table('categoria_transac', function (Blueprint $table) {
            $table->dropForeign('categoria_transac_tipo_transac_id_foreign');
        });
        Schema::table('tipo_transac', function (Blueprint $table) {
            $table->dropForeign('tipo_transac_usuario_id_foreign');
        });
    }
}
