<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rides')->insert([
            [
                'date' => '2023-07-05',
                'time' => '09:00',
                'passengers' => 2,
                'vagas' => 2,
                'from' => 'Praça do São Mateus',
                'destiny' => 'Novo ICE',
                'driver_id' => 2,
                'status' => 'disponível',
                'justWomen' => false,
            ],
            [
                'date' => '2023-07-06',
                'time' => '23:00',
                'passengers' => 2,
                'vagas' => 2,
                'from' => 'RU',
                'destiny' => 'Bairro de Lourdes',
                'driver_id' => 2,
                'status' => 'disponível',
                'justWomen' => true,
            ],
        ]);
    }
}
