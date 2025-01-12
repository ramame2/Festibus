@extends('layouts.app')
@section('title', 'Festivals')
@section('content')
    <div class="festival-section">
        <h2>Bewerk Festival: {{ $festival->naam }}</h2>

        <form action="{{ route('festivals.update', $festival->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Specificeer dat dit een PUT request is voor een update -->

            <div class="form-group">
                <label for="naam">Naam:</label>
                <input type="text" name="naam" id="naam" class="form-control" value="{{ old('naam', $festival->naam) }}" required>
            </div>

            <div class="form-group">
                <label for="datum">Datum:</label>
                <input type="date" name="datum" id="datum" class="form-control" value="{{ old('datum', $festival->datum) }}" required>
            </div>

            <div class="form-group">
                <label for="beschrijving">Beschrijving:</label>
                <textarea name="beschrijving" id="beschrijving" class="form-control" required>{{ old('beschrijving', $festival->beschrijving) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Afbeelding:</label>
                <input type="file" name="image" id="image" class="form-control">
                <p>Huidige afbeelding: <img src="{{ asset('storage/' . $festival->image) }}" alt="{{ $festival->naam }}" width="150"></p>
            </div>

            <button type="submit" class="btn btn-primary">Opslaan</button>
        </form>
    </div>
@endsection
