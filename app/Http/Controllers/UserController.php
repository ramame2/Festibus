<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display the list of users
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        if($request->user()->canEdit($user)) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);

            // Exclude '_token' from the request data
            $user->update($request->except('_token'));

            if ($request->user()->isAdmin() && $request->has('role')) {
                $user->update(['role' => $request->role]);
            }

            return redirect()->route('users.index')->with('success', 'User updated successfully');
        }

        return redirect()->route('users.index')->with('error', 'You do not have permission to edit this user');
    }

    // Show the edit form for a user
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    // Update the user (e.g., role, email)

    // Delete a user
    public function destroy(User $user)
    {
        if(auth()->user()->canEdit($user)) {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User deleted successfully');
        }

        return redirect()->route('users.index')->with('error', 'You do not have permission to delete this user');
    }

    // Reset a user's password
    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Password reset successfully');
    }

    // Reset 2FA for a user
    public function resetTwoFactor(User $user)
    {
        $user->update([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ]);

        return redirect()->route('users.index')->with('success', 'Two-factor authentication reset successfully');
    }

    // User enabling 2FA
    public function enableTwoFactor(Request $request, User $user)
    {
        if($request->user()->canEdit($user)) {
            // Here, implement the logic to generate 2FA secret and recovery codes
            // For example:
            // $user->generateTwoFactorSecret();
            // $user->generateTwoFactorRecoveryCodes();

            $user->save();

            return redirect()->route('users.index')->with('success', 'Two-factor authentication enabled successfully');
        }

        return redirect()->route('users.index')->with('error', 'You do not have permission to enable 2FA for this user');
    }
}
