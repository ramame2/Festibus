@extends('layouts.app')
@section('title', $user->name . ' account bewerken' )
@section('content')
    <div class="profile_container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <div class="mb-3">
                        <label for="role" class="form-label">Rol</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Gebruiker</option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                @endif
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>


                <div class="mb-3">
                    <label for="current_password" class="form-label">Huidig wachtwoord</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">Nieuw wachtwoord</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" >
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Bevestig nieuw wachtwoord</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" >
                </div>


                <button type="submit" class="buttons">Update</button>
            </form>

        @if(auth()->user()->canEdit($user))
            <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="buttons2" onclick="return confirm('Gebruiker verwijderen?')">Verwijderen</button>
            </form>
        @endif


    </div>
@endsection
