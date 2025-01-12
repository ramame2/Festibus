
@extends('layouts.admin')

@section('title', 'Gebruiker bewerken')

@section('content')
    <h2>Gebruiker bewerken</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required>

        <button type="submit">Bijwerken</button>
    </form>
@endsection
