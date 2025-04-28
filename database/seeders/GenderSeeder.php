<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('genders')->insert([
            ['name' => 'Acción/Aventura', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Deportes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'RPG', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Estrategia', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Simulación', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Shooter', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Plataformas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mundo abierto', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
