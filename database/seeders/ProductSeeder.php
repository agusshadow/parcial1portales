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
                'image' => 'images/TLOU2.jpg',
                'description' => 'Juego de acción y aventura desarrollado por Naughty Dog',
                'gender_id' => 1,
                'platform_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'FIFA 23',
                'price' => 49,
                'image' => 'images/FIFA23.jpeg',
                'description' => 'Simulador de fútbol desarrollado por EA Sports',
                'gender_id' => 2,
                'platform_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Super Mario Odyssey',
                'price' => 45,
                'image' => 'images/super-mario-odyssey.jpg',
                'description' => 'Aventura 3D de Mario desarrollada por Nintendo',
                'gender_id' => 1,
                'platform_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Elden Ring',
                'price' => 69,
                'image' => 'images/EldenRing.jpg',
                'description' => 'RPG de mundo abierto con dificultad desafiante desarrollado por FromSoftware',
                'gender_id' => 3,
                'platform_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Age of Empires IV',
                'price' => 39,
                'image' => 'images/AgeofEmpiresIV.jpg',
                'description' => 'Juego de estrategia en tiempo real basado en eventos históricos',
                'gender_id' => 4,
                'platform_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Microsoft Flight Simulator',
                'price' => 59,
                'image' => 'images/MicrosoftFlightSimulator.jpg',
                'description' => 'Simulador de vuelo realista con mapas satelitales',
                'gender_id' => 5,
                'platform_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Call of Duty: Modern Warfare II',
                'price' => 70,
                'image' => 'images/CallofDutyModernWarfareII.jpg',
                'description' => 'Shooter en primera persona con campaña y multijugador',
                'gender_id' => 6,
                'platform_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Celeste',
                'price' => 19,
                'image' => 'images/Celeste.jpg',
                'description' => 'Juego de plataformas desafiante con fuerte narrativa emocional',
                'gender_id' => 7,
                'platform_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Genshin Impact',
                'price' => 0,
                'image' => 'images/GenshinImpact.jpg',
                'description' => 'RPG de mundo abierto con mecánicas gacha',
                'gender_id' => 3,
                'platform_id' => 7, // Mobile
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Red Dead Redemption 2',
                'price' => 59,
                'image' => 'images/RedDeadRedemption2.jpg',
                'description' => 'Aventura de mundo abierto en el viejo oeste con historia cinematográfica',
                'gender_id' => 8,
                'platform_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hollow Knight',
                'price' => 15,
                'image' => 'images/HollowKnight.jpg',
                'description' => 'Metroidvania de acción con exploración profunda y ambientación oscura',
                'gender_id' => 7,
                'platform_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Forza Horizon 5',
                'price' => 59,
                'image' => 'images/ForzaHorizon5.jpg',
                'description' => 'Simulador de conducción arcade en mundo abierto',
                'gender_id' => 2,
                'platform_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
