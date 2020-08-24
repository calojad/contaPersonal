<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 0,
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@hotmail.com',
            'password' => '$2y$10$5cz73P31SJP/OKNlyfzQkON/27GzXA97Oq3HSZNxWaP.gjImbIu9S',
            'rol' => 'ADM'
        ]);
    }
}
