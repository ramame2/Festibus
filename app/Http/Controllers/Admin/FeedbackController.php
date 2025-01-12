<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback; // Import the Feedback model

class FeedbackController extends Controller
{
    public function index()
    {
        // Retrieve all feedback records from the database
        $feedbacks = Feedback::all();

        // Return the data to the admin feedback page view
        return view('admin.feedback.index', compact('feedbacks'));
    }
}
