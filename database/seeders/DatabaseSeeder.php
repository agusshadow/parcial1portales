<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(GenderSeeder::class);
        $this->call(PlatformSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(CartSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
