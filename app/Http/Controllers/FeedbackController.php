<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {

        $feedbacks = Feedback::all();
        $averageRating = Feedback::avg('rating');
        // Return the data to the admin feedback page view
        return view('feedback.index', compact('feedbacks', 'averageRating'));
    }
    public function view()
    {
        // Retrieve all feedback records from the database
        $feedbacks = Feedback::all();
        $averageRating = Feedback::avg('rating');
        // Return the data to the admin feedback page view
        return view('feedback.view', compact('feedbacks', 'averageRating'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        Feedback::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'rating' => $request->rating,
        ]);

        return redirect()->route('feedback.index')->with('success', 'Feedback succesvol verzonden!');
    }
}
