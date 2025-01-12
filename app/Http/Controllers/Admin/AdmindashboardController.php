<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $messages = Contact::latest()->take(5)->get(); // Haal de laatste 5 berichten op
        $unreadCount = Contact::whereNull('read_at')->count(); // Ongelezen berichten tellen
        return view('admin.dashboard', compact('messages', 'unreadCount'));
    }
}
