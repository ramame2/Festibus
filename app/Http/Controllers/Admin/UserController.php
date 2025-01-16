<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'U bent niet bevoegd om deze pagina te bezoeken.');
        }

        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $currentUser = auth()->user();

        if ($currentUser->role !== 'admin' && $currentUser->id != $id) {
            return redirect()->route('home')->with('error', 'U bent niet bevoegd om deze gebruiker te bewerken.');
        }

        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $currentUser = auth()->user();

        if ($currentUser->role !== 'admin' && $currentUser->id != $id) {
            return redirect()->route('home')->with('error', 'U bent niet bevoegd om deze gebruiker te bewerken.');
        }

        $user = User::findOrFail($id);

        // Validatie
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        // Controleer het huidige wachtwoord als de gebruiker geen admin is
        if ($currentUser->role !== 'admin') {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Uw huidige wachtwoord is onjuist.');
            }
        }

        // Update gebruikersgegevens
        $user->update($request->only(['name', 'email','role']));

        // Update wachtwoord als een nieuw wachtwoord is ingevuld
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
            $user->save();
        }

        return back()->with('success', 'Gebruiker succesvol bijgewerkt.');
    }

    public function destroy($id)
    {
        $currentUser = auth()->user();

        if ($currentUser->role !== 'admin' && $currentUser->id != $id) {
            return redirect()->route('home')->with('error', 'U bent niet bevoegd om deze gebruiker te bewerken.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('home')->with('success', 'Gebruiker succesvol verwijderd.');
    }

    public function resetPassword(Request $request, $id)
    {
        $currentUser = auth()->user();

        if ($currentUser->role !== 'admin' && $currentUser->id != $id) {
            return redirect()->route('home')->with('error', 'U bent niet bevoegd om deze gebruiker te bewerken.');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Wachtwoord succesvol gereset.');
    }
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role, // Optioneel, als je rollen toevoegt
        ]);

        return redirect()->route('users.index')->with('success', 'Gebruiker succesvol aangemaakt.');
    }

}
