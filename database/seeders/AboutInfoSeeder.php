<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutInfo;

class AboutInfoSeeder extends Seeder
{
    public function run()
    {
        // Define actual opening hours
        $openingHours = [
            'maandag' => '09:00 - 17:00',
            'dinsdag' => '09:00 - 17:00',
            'woensdag' => '09:00 - 17:00',
            'donderdag' => '09:00 - 19:00',
            'vrijdag' => '09:00 - 17:00',
            'zaterdag' => '10:00 - 16:00',
            'zondag' => 'Gesloten',
        ];

        // Seed the AboutInfo table with actual data
        AboutInfo::create([
            'phone' => '+31 0000 000 00',
            'location' => 'Almere, Netherlands',
            'email' => 'admin@domain.com',
            'opening_hours' => json_encode($openingHours),
        ]);
    }
}
