<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        DB::table('users')->insert([
            [
                'name' => 'Pedro',
                'email' => 'pedro@ice.ufjf.br',
                'genero' => 'homem',
                'matricula' => '202265414',
                'cnh' => null,
                'password' => 'PeDro@2023',
                'phone' => '988776655',
                'idade' => 18,
                'user_type_id' => 2,
            ],
            [
                'name' => 'Paula',
                'email' => 'paula@ice.ufjf.br',
                'generp' => 'mulher',
                'matricula' => '202265413',
                'cnh' => '1234567898',
                'password' => 'JARBAS@2023',
                'phone' => '999887766',
                'idade' => 20,
                'user_type_id' => 1,
            ],
        ]);
    }
}
