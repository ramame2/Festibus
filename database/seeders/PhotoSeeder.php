<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PhotoSeeder extends Seeder
{
    public function run()
    {
        $photos = [
            ['id' => 1, 'title' => '1', 'url' => 'images/1.jpg', 'created_at' => '2024-12-09 20:22:04', 'updated_at' => '2024-12-09 21:02:17'],
            ['id' => 2, 'title' => '2', 'url' => 'images/2.jpg', 'created_at' => '2024-12-09 20:22:04', 'updated_at' => '2024-12-09 21:03:59'],
            ['id' => 3, 'title' => '3', 'url' => 'images/3.jpg', 'created_at' => '2024-12-09 20:22:04', 'updated_at' => '2024-12-09 21:03:59'],
            ['id' => 4, 'title' => '4', 'url' => 'images/4.jpg', 'created_at' => '2024-12-09 20:22:04', 'updated_at' => '2024-12-09 21:03:59'],
            ['id' => 6, 'title' => '6', 'url' => 'images/6.jpg', 'created_at' => '2024-12-09 20:22:04', 'updated_at' => '2024-12-09 21:03:59'],
            ['id' => 7, 'title' => '7', 'url' => 'images/7.jpg', 'created_at' => '2024-12-09 20:22:04', 'updated_at' => '2024-12-09 21:03:59'],
            ['id' => 8, 'title' => '8', 'url' => 'images/8.jpg', 'created_at' => '2024-12-09 20:22:04', 'updated_at' => '2024-12-09 21:03:59'],
            ['id' => 9, 'title' => '1', 'url' => 'images/1.jpg', 'created_at' => '2024-12-09 20:32:47', 'updated_at' => '2024-12-09 21:02:17'],
            ['id' => 10, 'title' => '2', 'url' => 'images/2.jpg', 'created_at' => '2024-12-09 20:32:47', 'updated_at' => '2024-12-09 21:03:59'],
            ['id' => 11, 'title' => '3', 'url' => 'images/3.jpg', 'created_at' => '2024-12-09 20:32:47', 'updated_at' => '2024-12-09 21:03:59'],
            ['id' => 12, 'title' => '4', 'url' => 'images/4.jpg', 'created_at' => '2024-12-09 20:32:47', 'updated_at' => '2024-12-09 21:03:59'],
            ['id' => 14, 'title' => '6', 'url' => 'images/6.jpg', 'created_at' => '2024-12-09 20:32:47', 'updated_at' => '2024-12-09 21:03:59'],
            ['id' => 15, 'title' => '7', 'url' => 'images/7.jpg', 'created_at' => '2024-12-09 20:32:47', 'updated_at' => '2024-12-09 21:03:59'],
            ['id' => 16, 'title' => '8', 'url' => 'images/8.jpg', 'created_at' => '2024-12-09 20:32:47', 'updated_at' => '2024-12-09 21:03:59'],
        ];

        // Insert data into the photos table
        DB::table('photos')->insert($photos);
    }
}
