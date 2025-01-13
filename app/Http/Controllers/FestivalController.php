<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Festival;


class FestivalController extends Controller
{
    public function index()
    {
        $latestFestivals = Festival::latest()->take(17)->get(); // Haal de laatste 17 festivals op
        return view('festival.festival', compact('latestFestivals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'datum' => 'required|date',
            'beschrijving' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Festival::create([
            'naam' => $request->naam,
            'datum' => $request->datum,
            'beschrijving' => $request->beschrijving,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Festival toegevoegd!');
    }


    public function edit($id)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
        }


        $festival = Festival::findOrFail($id);
        return view('festival.edit', compact('festival'));
    }

    public function update(Request $request, $id)
    {

        $festival = Festival::findOrFail($id);

        $request->validate([
            'naam' => 'required|string|max:255',
            'datum' => 'required|date',
            'beschrijving' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $festival->naam = $request->naam;
        $festival->datum = $request->datum;
        $festival->beschrijving = $request->beschrijving;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $festival->image = $imagePath;
        }

        $festival->save();

        return redirect()->route('festival')->with('success', 'Festival succesvol bijgewerkt!');
    }


    public function destroy($id)
    {

            if (!auth()->check() || auth()->user()->role !== 'admin') {
                return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
            }

            $festival = Festival::findOrFail($id);
        if (file_exists(public_path('images/' . $festival->image))) {
            unlink(public_path('images/' . $festival->image));
        }
        $festival->delete();

        return redirect()->back()->with('success', 'Festival verwijderd!');
    }
}
