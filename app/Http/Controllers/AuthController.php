<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
public function showLoginForm()
{
return view('auth.login');
}

public function login(Request $request)
{
$request->validate([
'username' => 'required|string',
'password' => 'required|string',
]);

$credentials = $request->only(['username', 'password']);

if (Auth::attempt($credentials)) {
return redirect()->route('dashboard');  // Redirect to a protected route after login
}

return back()->withErrors(['message' => 'Invalid credentials']);
}

public function logout()
{
Auth::logout();
return redirect()->route('login');
}

public function showRegistrationForm()
{
return view('auth.register');
}

public function register(Request $request)
{
$request->validate([
'name' => 'required|string|max:255',
'email' => 'required|string|email|max:255|unique:users',
'password' => 'required|string|min:8|confirmed',
]);

$user = User::create([
'name' => $request->name,
'email' => $request->email,
'password' => Hash::make($request->password),
]);

Auth::login($user);  // Log in the user after registration

return redirect()->route('dashboard');
}
}
