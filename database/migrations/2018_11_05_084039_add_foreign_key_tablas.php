<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyTablas extends Migration
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
        });
    }
}
