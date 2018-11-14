<?php

use Illuminate\Database\Seeder;

class tipoTransacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_transac')->insert([
            'nombre' => 'Ingreso',
            'usuario_id' => 1
        ]);
        DB::table('tipo_transac')->insert([
            'nombre' => 'Gasto',
            'usuario_id' => 1
        ]);
    }
}
