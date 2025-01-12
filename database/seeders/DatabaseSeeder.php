<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            NewsSeeder::class,
            FestivalSeeder::class,
            UserSeeder::class,
            locationSeeder::class,
            BusRoutesSeeder::class,
            faqSeeder::class,

        ]);
    }
}
