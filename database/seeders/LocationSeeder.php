<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LocationSeeder extends Seeder
{
    public function run()
    {
        // Insert the data for locations
        DB::table('locations')->insert([
            [
                'id' => 1,
                'name' => 'Amsterdam',
                'latitude' => 52.3791890,
                'longitude' => 4.8994310,
                'created_at' => Carbon::parse('2024-12-15 16:03:12'),
                'updated_at' => Carbon::parse('2024-12-15 16:03:12'),
            ],
            [
                'id' => 2,
                'name' => 'Rotterdam',
                'latitude' => 51.9249584,
                'longitude' => 4.4686942,
                'created_at' => Carbon::parse('2024-12-15 16:03:12'),
                'updated_at' => Carbon::parse('2024-12-15 16:03:12'),
            ],
            [
                'id' => 3,
                'name' => 'Utrecht',
                'latitude' => 52.0928760,
                'longitude' => 5.1044800,
                'created_at' => Carbon::parse('2024-12-15 16:03:12'),
                'updated_at' => Carbon::parse('2024-12-15 16:03:12'),
            ],
            [
                'id' => 4,
                'name' => 'Eindhoven',
                'latitude' => 51.4346190,
                'longitude' => 5.4860110,
                'created_at' => Carbon::parse('2024-12-15 16:03:12'),
                'updated_at' => Carbon::parse('2024-12-15 16:03:12'),
            ],
            [
                'id' => 5,
                'name' => 'Den Haag',
                'latitude' => 52.0803290,
                'longitude' => 4.3096500,
                'created_at' => Carbon::parse('2024-12-15 16:03:12'),
                'updated_at' => Carbon::parse('2024-12-15 16:03:12'),
            ],
            [
                'id' => 6,
                'name' => 'Maastricht',
                'latitude' => 50.8493750,
                'longitude' => 5.6946090,
                'created_at' => Carbon::parse('2024-12-15 16:03:12'),
                'updated_at' => Carbon::parse('2024-12-15 16:03:12'),
            ],
            [
                'id' => 7,
                'name' => 'Groningen',
                'latitude' => 53.2193835,
                'longitude' => 6.5665017,
                'created_at' => Carbon::parse('2024-12-15 16:03:12'),
                'updated_at' => Carbon::parse('2024-12-15 16:03:12'),
            ],
            [
                'id' => 8,
                'name' => 'Tilburg',
                'latitude' => 51.5552050,
                'longitude' => 5.0781850,
                'created_at' => Carbon::parse('2024-12-15 16:03:12'),
                'updated_at' => Carbon::parse('2024-12-15 16:03:12'),
            ],
            [
                'id' => 9,
                'name' => 'Almere',
                'latitude' => 52.3507849,
                'longitude' => 5.2647016,
                'created_at' => Carbon::parse('2024-12-15 16:03:12'),
                'updated_at' => Carbon::parse('2024-12-15 16:03:12'),
            ],
            [
                'id' => 10,
                'name' => 'Breda',
                'latitude' => 51.5644477,
                'longitude' => 4.7512296,
                'created_at' => Carbon::parse('2024-12-15 16:03:12'),
                'updated_at' => Carbon::parse('2024-12-15 16:03:12'),
            ],
            [
                'id' => 11,
                'name' => 'Nijmegen',
                'latitude' => 51.8125626,
                'longitude' => 5.8372264,
                'created_at' => Carbon::parse('2024-12-15 16:03:12'),
                'updated_at' => Carbon::parse('2024-12-15 16:03:12'),
            ],
            [
                'id' => 12,
                'name' => 'Haarlem',
                'latitude' => 52.3873878,
                'longitude' => 4.6462194,
                'created_at' => Carbon::parse('2024-12-15 16:03:12'),
                'updated_at' => Carbon::parse('2024-12-15 16:03:12'),
            ],
        ]);
    }
}
