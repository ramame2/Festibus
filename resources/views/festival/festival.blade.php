@extends('layouts.app')
@section('title', 'Festivals')
@section('content')
    <div class="festival-section">
        <h2>Laatste Festivals</h2>

        <div class="festival-gallery">
            @foreach($latestFestivals as $festival)
                <div class="festival-item">
                    <img src="{{ asset('storage/' . $festival->image) }}" alt="{{ $festival->naam }}">
                    <h3>{{ $festival->naam }}</h3>
                    <p>{{ \Carbon\Carbon::parse($festival->datum)->format('d-m-Y') }}</p>
                    <p>{{ $festival->beschrijving }}</p>

                    {{-- Alleen zichtbaar voor admins: Verwijderknop --}}
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <form action="{{ route('festivals.destroy', $festival->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Verwijderen</button>
                        </form>

                        {{-- Bewerken van festival --}}
                        <a href="{{ route('festivals.edit', $festival->id) }}" class="btn btn-warning">Bewerken</a>
                    @endif
                </div>
            @endforeach
        </div>

        @if(auth()->check() && auth()->user()->role === 'admin')
            <div class="festival-add-form">
                <h3>Voeg een nieuw festival toe</h3>
                <form action="{{ route('festivals.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="naam">Naam:</label>
                        <input type="text" name="naam" id="naam" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="datum">Datum:</label>
                        <input type="date" name="datum" id="datum" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="beschrijving">Beschrijving:</label>
                        <textarea name="beschrijving" id="beschrijving" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Afbeelding:</label>
                        <input type="file" name="image" id="image" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Toevoegen</button>
                </form>
            </div>
        @endif

          </div>
@endsection
