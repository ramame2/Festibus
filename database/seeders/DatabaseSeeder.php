<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AboutInfoSeeder::class,
            NewsSeeder::class,
            FestivalSeeder::class,
            UserSeeder::class,
            LocationSeeder::class,
            BusRoutesSeeder::class,
            FaqSeeder::class,
            PhotoSeeder::class,

        ]);
    }
}
