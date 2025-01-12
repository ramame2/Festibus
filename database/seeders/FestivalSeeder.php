<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FestivalSeeder extends Seeder
{
    public function run()
    {
        DB::table('festivals')->insert([
            [
                'naam' => 'Thunderdome',

                'datum' => '2025-01-06',
                'beschrijving' => 'Ben jij klaar voor 2 nachten vol met hardcore, veel gestamp en vooral goede artiesten. Goed nieuws, want op 1-6-2025 komt Thunderdome weer terug naar het Sportpaleis in Antwerpen.',
                'image' => 'images/9.jpg'
            ],
            [
                'naam' => 'Sneeuw Festival',
                'datum' => '2025-12-06',
                'beschrijving' => 'Sneeuwbal Winterfestival 2025 Ben jij klaar voor de ultimate winter rave? Hou jij niet van een winterstop of hou je gewoon teveel van festivals? Dan is Sneeuwbal Winterfestival echt iets voor jou. Dit jaar zal de editie plaatsvinden op zaterdag 5 december.',
                'image' => 'images/10.jpg'
            ],
            [
                'naam' => 'Karnaval Festival',
                'datum' => '2025-08-20',
                'beschrijving' => 'Op zaterdag 20 augustus is het weer een groot feest tijdens Karnaval Festival. Hou jij van stampen houdt dit festival echt iets voor jou. Met je foutste feestkleding stampen de hardste kicks of meezingen op de mooie nederlandse hits, op Karnaval Festival kan het allemaal. Dit jaar biedt Karnaval Festival 100% feestgarantie want het festival vindt van jaar plaats in de Brabanthallen in Den Bosch.',
                'image' => 'images/11.jpg'
            ]
        ]);
    }
}
