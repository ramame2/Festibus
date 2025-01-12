<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\News; // Import the News model
use Illuminate\Http\Request;
use App\Models\BusRoute;

class HomeController extends Controller
{
    // Display the home page with locations and news
    public function index()
    {
        // Get all locations from the database
        $locations = Location::all();

        // Get the latest news from the database (you can adjust this as needed)
        $news = News::latest()->take(5)->get(); // Adjust the number of news items you want to display

        // Get the currently authenticated user
        $user = auth()->user();  // If the user is not logged in, this will be null

        // Return the view with the locations, news, and user variables
        return view('home', compact('locations', 'news', 'user'));
    }

    // Handle the search form for routes
    public function searchRoute(Request $request)
    {
        // Get all locations from the database to pass to the view
        $locations = Location::all();

        // Retrieve the routes based on the departure and destination
        $routes = BusRoute::where('departure_id', $request->departure)
            ->where('destination_id', $request->destination)
            ->get();

        // Get the departure and destination locations based on user input
        $departure = Location::where('name', $request->departure)->first();
        $destination = Location::where('name', $request->destination)->first();

        // Return the view with departure, destination, locations, and routes data
        return view('home', compact('departure', 'destination', 'locations', 'routes'));
    }

    // FAQ page (you can keep this if you need it)
    public function faq()
    {
        return view('pages.faq');
    }
}
