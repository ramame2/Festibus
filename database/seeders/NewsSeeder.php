<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class NewsSeeder extends Seeder
{
    public function run()
    {
        DB::table('news')->insert([
            ['title' => 'Eerste Festival Aangekondigd!', 'content' => 'Het eerste festival van het seizoen wordt gehouden op 20 january.', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Nieuwe Locaties Toegevoegd', 'content' => 'We hebben nieuwe festival locaties toegevoegd voor dit jaar.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

