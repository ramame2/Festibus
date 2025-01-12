<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;

class BookingController extends Controller
{
public function create(Request $request)
{
// Get route details from the request
$departure = $request->input('departure');
$destination = $request->input('destination');
$departureTime = $request->input('departure_time');
$price = $request->input('price');

// Get the currently authenticated user
$user = auth()->user();  // This retrieves the logged-in user

// Pass the route data and user data to the view
return view('booking.create', compact('departure', 'destination', 'departureTime', 'price', 'user'));
}

public function store(Request $request)
{
// Validate and store the booking data
$request->validate([
'departure' => 'required|string|max:255',
'destination' => 'required|string|max:255',
'departure_time' => 'required',
'price' => 'required|numeric|min:0',
'name' => 'required|string|max:255',
'email' => 'required|string|email|max:255',
'number_of_people' => 'required|integer|min:1',
'payment_method' => 'required|string|max:255',
]);
    $user = auth()->user() ?: User::first();
$totalPrice = $request->input('price') * $request->input('number_of_people');

// Create the booking and associate it with the authenticated user
Booking::create([
'user_id' => $user->id,
'departure' => $request->input('departure'),
'destination' => $request->input('destination'),
'departure_time' => $request->input('departure_time'),
'price' => $request->input('price'),
'name' => $request->input('name'),
'email' => $request->input('email'),
'number_of_people' => $request->input('number_of_people'),
'total_price' => $totalPrice,
'payment_method' => $request->input('payment_method'),
'departure_date' => $request->departure_date,
]);

return redirect()->route('home')->with('success', 'Uw boeking is succesvol aangemaakt! U kunt uw reis nu bekijken en beheren via uw profiel.');
}
    public function index(Request $request)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
        }

        // Search and filter logic
        $search = $request->input('search', '');
        $bookings = Booking::when($search, function ($query, $search) {
            return $query->where('departure', 'like', "%{$search}%")
                ->orWhere('destination', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })
            ->orderBy($request->input('sort_by', 'departure'), $request->input('sort_order', 'asc'))
            ->get();


        $groupedBookings = $bookings->groupBy('destination');

        return view('booking.index', compact('groupedBookings', 'search'));
    }

// Edit booking (for admin)
public function edit($id)
{
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
    }

    $booking = Booking::findOrFail($id);
return view('booking.edit', compact('booking'));
}

// Update booking (for admin)
public function update(Request $request, $id)
{
$booking = Booking::findOrFail($id);

$booking->update([
'departure' => $request->input('departure'),
'destination' => $request->input('destination'),
'departure_time' => $request->input('departure_time'),
'price' => $request->input('price'),
'name' => $request->input('name'),
'email' => $request->input('email'),
'number_of_people' => $request->input('number_of_people'),
'total_price' => $request->input('price') * $request->input('number_of_people'),
'payment_method' => $request->input('payment_method'),
'departure_date' => $request->departure_date,
]);

return redirect()->route('booking.index')->with('success', 'Boeking succesvol bijgewerkt.');
}

// Delete booking (for admin)
public function destroy($id)
{
$booking = Booking::findOrFail($id);
$booking->delete();

return back()->with('success', 'Boeking succesvol verwijderd.');
}

}
