<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Display the contact form
    public function index()
    {
        return view('contact');
    }

    // Store the form data in the database
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'naam' => 'required|string|max:255',
            'nummer' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'bericht' => 'required|string',
        ]);

        // Save the data
        Contact::create($validatedData);

        // Redirect with success message
        return redirect('home')->with('success', 'Bedankt! Bericht succesvol verzonden! Wij zullen zo spoedig mogelijk contact met u opnemen.');
    }

    // Display all contact messages
    public function allMessages()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
        return redirect()->route('home')->with('error', 'U bent niet bevoegd om deze pagina te bekijken.');
    }
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        return view('contacts.all', compact('contacts'));
    }
}
