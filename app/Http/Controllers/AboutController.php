<?php
namespace App\Http\Controllers;

use App\Models\AboutInfo;
use Illuminate\Http\Request;
use App\Models\Photo;

class AboutController extends Controller
{
    public function index()
    {
        $aboutInfo = AboutInfo::first();
        $photos = Photo::all();


        $opening_hours = json_decode($aboutInfo->opening_hours, true);

        return view('about.index', compact('aboutInfo', 'photos', 'opening_hours'));
    }

public function show($id)
{
$aboutInfo = AboutInfo::findOrFail($id);
$photos = Photo::all(); // Haal alle foto's op uit de database
return view('about.index', compact('aboutInfo', 'photos'));
}

public function edit($id)
{
$aboutInfo = AboutInfo::findOrFail($id);
return view('about.edit', compact('aboutInfo'));
}
    public function update(Request $request, $id)
    {

        $aboutInfo = AboutInfo::find($id);

        // Initialize weekdays in Dutch
        $weekdays = ['maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag', 'zondag'];

        // Process the opening hours and format them as needed
        $formattedOpeningHours = [];

        foreach ($weekdays as $day) {
            $status = $request->input("opening_hours.{$day}.status");

            if ($status == 'closed') {
                $formattedOpeningHours[$day] = 'Gesloten';
            } else {
                $opening = $request->input("opening_hours.{$day}.opening");
                $closing = $request->input("opening_hours.{$day}.closing");

                if ($opening && $closing) {
                    $formattedOpeningHours[$day] = "{$opening} - {$closing}";
                } else {
                    $formattedOpeningHours[$day] = 'Gesloten';
                }
            }
        }

        // Save the updated opening hours and other data
        $aboutInfo->update([
            'phone' => $request->input('phone'),
            'location' => $request->input('location'),
            'email' => $request->input('email'),
            'opening_hours' => json_encode($formattedOpeningHours),
        ]);


        return redirect()->route('home')->with('success', 'Over Ons Informatie bijgewerkt!');
    }

}
