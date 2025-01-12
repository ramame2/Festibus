<?php
namespace App\Http\Controllers;

use App\Models\BusRoute;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\News;
class BusRouteController extends Controller
{


    public function searchForm()
    {
        $locations = Location::all(); // Retrieve all locations for the search form
        return view('home', compact('locations'));
    }

    public function search(Request $request)
    {
        $departure_id = $request->departure;

        // Fetch all destinations for the selected departure location
        $routes = BusRoute::where('departure_id', $departure_id)
            ->get(); // Retrieve all routes for the departure location

        // Extract distinct destinations from the routes
        $destinations = $routes->pluck('destination_id')->unique();

        // Fetch the corresponding location details for the destinations
        $destination_locations = Location::whereIn('id', $destinations)->get();

        $query = $request->input('query'); // Get the search query
        $departure_id = $request->input('departure'); // Get the departure location if provided, it can be null

        // Validate that the departure and destination IDs exist in the locations table
        $request->validate([
            'departure' => 'required|exists:locations,id',
        ]);

        $departure_id = $request->departure;
        $destination_id = $request->destination;

        // Fetch the routes based on the departure and destination IDs
        $routes = BusRoute::where('departure_id', $departure_id)
            ->when($destination_id, function ($query, $destination_id) {
                return $query->where('destination_id', $destination_id);
            })
            ->get();

        $locations = Location::all();

        $news = News::latest()->take(5)->get();


        // Pass the routes and news to the view
        return view('home', compact('routes', 'locations', 'news'));
    }


    public function index()
    {
        $departure_id = request()->departure;  // Access the 'departure' parameter from the request
        $destination_id = request()->destination;
        $routes = BusRoute::where('departure_id', $departure_id)
            ->when($destination_id, function ($query, $destination_id) {
                return $query->where('destination_id', $destination_id);
            })
            ->get();
        $locations = Location::all();
        $busRoutes = BusRoute::with(['departureLocation', 'destinationLocation'])->get();
        return view('bus_routes.index', compact('locations', 'routes','busRoutes'));
    }

    public function create()
    {
        $locations = Location::all();
        return view('bus_routes.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'departure_id' => 'required|exists:locations,id',
            'destination_id' => 'required|exists:locations,id',
            'departure_time' => 'required|date_format:H:i',
            'duration' => 'required|date_format:H:i',
            'costs' => 'required|numeric',
        ]);

        BusRoute::create($validated);

        return redirect()->route('bus-routes.index')->with('success', 'Bus route created successfully!');
    }

    public function edit($id)
    {
        $busRoute = BusRoute::with(['departureLocation', 'destinationLocation'])->findOrFail($id);
        $locations = Location::all();
        return view('bus_routes.edit', compact('busRoute', 'locations'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'departure_id' => 'required|exists:locations,id',
            'destination_id' => 'required|exists:locations,id',
            'departure_time' => 'required|date_format:H:i',
            'duration' => 'required|date_format:H:i',
            'costs' => 'required|numeric',
        ]);

        $busRoute = BusRoute::findOrFail($id);
        $busRoute->update($validated);

        return redirect()->route('bus-routes.index')->with('success', 'Bus route updated successfully!');
    }

    public function destroy($id)
    {
        $busRoute = BusRoute::findOrFail($id);
        $busRoute->delete();

        return redirect()->route('bus-routes.index')->with('success', 'Bus route deleted successfully!');
    }
}
