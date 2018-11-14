<?php

use Illuminate\Database\Seeder;

class categoriaTransacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria_transac')->insert([
            'nombre' => 'Sueldo',
            'tipo_transac_id' => 1,
            'usuario_id' => 1
        ]);
        DB::table('categoria_transac')->insert([
            'nombre' => 'Prestamo',
            'tipo_transac_id' => 1,
            'usuario_id' => 1
        ]);
        DB::table('categoria_transac')->insert([
            'nombre' => 'Ahorro',
            'tipo_transac_id' => 1,
            'usuario_id' => 1
        ]);
        DB::table('categoria_transac')->insert([
            'nombre' => 'Transporte',
            'tipo_transac_id' => 2,
            'usuario_id' => 1
        ]);
        DB::table('categoria_transac')->insert([
            'nombre' => 'Alimentos',
            'tipo_transac_id' => 2,
            'usuario_id' => 1
        ]);
        DB::table('categoria_transac')->insert([
            'nombre' => 'Entretenimiento',
            'tipo_transac_id' => 2,
            'usuario_id' => 1
        ]);
        DB::table('categoria_transac')->insert([
            'nombre' => 'Luz',
            'tipo_transac_id' => 2,
            'usuario_id' => 1
        ]);
        DB::table('categoria_transac')->insert([
            'nombre' => 'Agua',
            'tipo_transac_id' => 2,
            'usuario_id' => 1
        ]);
        DB::table('categoria_transac')->insert([
            'nombre' => 'Arriendo',
            'tipo_transac_id' => 2,
            'usuario_id' => 1
        ]);
        DB::table('categoria_transac')->insert([
            'nombre' => 'Internet',
            'tipo_transac_id' => 2,
            'usuario_id' => 1
        ]);
        DB::table('categoria_transac')->insert([
            'nombre' => 'Teléfono',
            'tipo_transac_id' => 2,
            'usuario_id' => 1
        ]);
        DB::table('categoria_transac')->insert([
            'nombre' => 'Celular',
            'tipo_transac_id' => 2,
            'usuario_id' => 1
        ]);
        DB::table('categoria_transac')->insert([
            'nombre' => 'Tv',
            'tipo_transac_id' => 2,
            'usuario_id' => 1
        ]);
        DB::table('categoria_transac')->insert([
            'nombre' => 'Educación',
            'tipo_transac_id' => 2,
            'usuario_id' => 1
        ]);
        DB::table('categoria_transac')->insert([
            'nombre' => 'Salud',
            'tipo_transac_id' => 2,
            'usuario_id' => 1
        ]);
        DB::table('categoria_transac')->insert([
            'nombre' => 'Vestimenta',
            'tipo_transac_id' => 2,
            'usuario_id' => 1
        ]);
        DB::table('categoria_transac')->insert([
            'nombre' => 'Medicina',
            'tipo_transac_id' => 2,
            'usuario_id' => 1
        ]);
    }
}
