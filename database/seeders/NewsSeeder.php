<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('news')->insert([
            [
                'title' => 'Nuevo lanzamiento: Elden Ring DLC',
                'content' => 'FromSoftware ha anunciado el lanzamiento del esperado DLC de Elden Ring. El contenido descargable incluirá nuevas áreas, jefes y equipamiento para los jugadores.',
                'images' => 'elden_ring_dlc.jpg',
                'links' => 'https://www.eldenring.com/shadowofthetree',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Ofertas de verano en juegos de PC',
                'content' => 'Nuestra tienda lanza increíbles descuentos en juegos digitales para PC. Aprovecha hasta un 70% de descuento en títulos AAA y juegos indie seleccionados durante todo el mes.',
                'images' => 'summer_sales.jpg',
                'links' => 'https://www.nuestratienda.com/ofertas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Guía para activar claves de Steam',
                'content' => 'Aprende a activar tus claves de juegos en Steam de manera sencilla. Este tutorial paso a paso te ayudará a disfrutar de tus compras lo antes posible.',
                'images' => 'steam_keys.jpg',
                'links' => 'https://www.nuestratienda.com/guias/activar-steam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Nuevo sistema de recompensas para clientes',
                'content' => 'Hemos lanzado un nuevo sistema de recompensas para nuestros clientes fieles. Por cada compra acumularás puntos que podrás canjear por descuentos en futuras compras.',
                'images' => 'rewards.jpg',
                'links' => 'https://www.nuestratienda.com/recompensas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}