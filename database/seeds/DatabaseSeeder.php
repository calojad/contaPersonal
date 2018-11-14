<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'tipo_transac',
            'categoria_transac',
            'users'
        ]);

        $this->call(UserSeeder::class);
        $this->call(tipoTransacSeeder::class);
        $this->call(categoriaTransacSeeder::class);
    }
    protected function truncateTables(array $tables){
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
