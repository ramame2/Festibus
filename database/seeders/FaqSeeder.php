<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
public function run()
{
$faqs = [

[
'question' => 'Wat is Festibus?',
'answer' => 'Festibus is een busdienst die veilige en comfortabele ritten biedt naar verschillende bestemmingen.',
'category' => 'Algemeen',
],
[
'question' => 'Wat voor soort diensten biedt Festibus aan?',
'answer' => 'Festibus biedt vervoer aan voor dagelijkse woon-werkverkeer, toeristische trips en speciale evenementen.',
'category' => 'Algemeen',
],
[
'question' => 'Hoe kan ik een ticket kopen voor de Festibus?',
'answer' => 'Tickets kunnen worden gekocht via onze website, mobiele app of bij onze stations.',
'category' => 'Algemeen',
],
[
'question' => 'Wat zijn de openingstijden van de klantenservice?',
'answer' => 'Onze klantenservice is bereikbaar van maandag tot vrijdag van 08:00 tot 18:00 uur.',
'category' => 'Algemeen',
],
[
'question' => 'Biedt Festibus een loyaliteitsprogramma aan?',
'answer' => 'Ja, we bieden een loyaliteitsprogramma waarbij je korting kunt verdienen bij frequente reizen.',
'category' => 'Algemeen',
],

[
'question' => 'Wat is de vertrektijd van de Festibus bij Station X?',
'answer' => 'De exacte vertrektijden kunnen worden gevonden op onze website of mobiele app.',
'category' => 'Specifiek',
],
[
'question' => 'Zijn er kortingen voor studenten, ouderen of kinderen?',
'answer' => 'Ja, Festibus biedt kortingen aan voor studenten, ouderen en kinderen. Deze kortingen kunnen worden aangevraagd via onze website of bij het kopen van een ticket bij onze stations.',
'category' => 'Specifiek',
],
[
'question' => 'Hoe vaak rijden de Festibussen?',
'answer' => 'De frequentie van de ritten verschilt per route. Raadpleeg onze app voor de meest actuele informatie.',
'category' => 'Specifiek',
],
[
'question' => 'Rijden de Festibussen ook op feestdagen?',
'answer' => 'Festibus rijdt op belangrijke vakantiedagen, maar de dienstregeling kan variëren. Kijk voor de specifieke data op onze website.',
'category' => 'Specifiek',
],

[
'question' => 'Is er een toilet aan boord van de Festibus?',
'answer' => 'Ja, de meeste Festibussen zijn uitgerust met toiletten voor het gemak van onze passagiers.',
'category' => 'Services',
],
[
'question' => 'Is er WiFi of stroomvoorziening beschikbaar aan boord?',
'answer' => 'Ja, Festibus biedt gratis WiFi en stroomvoorziening aan boord zodat passagiers comfortabel kunnen reizen.',
'category' => 'Services',
],
[
'question' => 'Wat voor veiligheidsmaatregelen neemt Festibus?',
'answer' => 'Festibus volgt strikte veiligheidsprotocollen, zoals het dragen van veiligheidsgordels en het uitvoeren van regelmatige inspecties van onze voertuigen.',
'category' => 'Services',
],
[
'question' => 'Zijn de bussen toegankelijk voor rolstoelgebruikers?',
'answer' => 'Onze bussen zijn toegankelijk voor rolstoelen en andere mobiliteitshulpmiddelen.',
'category' => 'Services',
],


[
'question' => 'Zijn er Festibus stations bij mij in de buurt?',
'answer' => 'U kunt de dichtstbijzijnde Festibus stations vinden via onze website of mobiele app.',
'category' => 'Bereikbaarheid',
],
[
'question' => 'Kan ik mijn Festibus-route volgen via GPS of een app?',
'answer' => 'Ja, Festibus biedt een mobiele app waarmee u real-time updates en route-informatie kunt volgen.',
'category' => 'Bereikbaarheid',
],
[
'question' => 'Kan ik telefonisch contact opnemen voor route-informatie?',
'answer' => 'Ja, de klantenservice is telefonisch bereikbaar voor route-informatie en vragen over de beschikbaarheid van stations.',
'category' => 'Bereikbaarheid',
],
[
'question' => 'Welke betaalmethoden worden geaccepteerd?',
'answer' => 'We bieden verschillende manieren van betaling aan, waaronder via de app, creditcard en contant bij het station.',
'category' => 'Bereikbaarheid',
],
];

// Insert all FAQs into the database
foreach ($faqs as $faq) {
Faq::create($faq);
}
}
}
