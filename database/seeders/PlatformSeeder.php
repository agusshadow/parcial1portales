<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlatformSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('platforms')->insert([
            ['name' => 'PlayStation 5', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Xbox Series X/S', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nintendo Switch', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PC', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PlayStation 4', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Xbox One', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mobile', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
