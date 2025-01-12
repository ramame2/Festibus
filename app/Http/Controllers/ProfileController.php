<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\user;


class ProfileController extends Controller
{

    public function showProfile()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Redirect to login if the user is not logged in
        if (!$user) {
            return redirect()->route('login');
        }

        // Retrieve bookings only if the user is not an admin
        $bookings = $user->bookings;

        // Pass the user and bookings (if any) to the view
        return view('profile', compact('user', 'bookings'));
    }

}
