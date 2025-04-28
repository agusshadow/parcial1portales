<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'The Last of Us Part II',
                'price' => 59,
                'image' => 'tlou2.jpg',
                'description' => 'Juego de acción y aventura desarrollado por Naughty Dog',
                'gender_id' => 1,
                'platform_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'FIFA 23',
                'price' => 49,
                'image' => 'fifa23.jpg',
                'description' => 'Simulador de fútbol desarrollado por EA Sports',
                'gender_id' => 2,
                'platform_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Super Mario Odyssey',
                'price' => 45,
                'image' => 'mario.jpg',
                'description' => 'Aventura 3D de Mario desarrollada por Nintendo',
                'gender_id' => 1,
                'platform_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}