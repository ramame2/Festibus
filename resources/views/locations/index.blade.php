@extends('layouts.admin')
@section('title', 'Sations')
@section('content')
    <div class="profile_container">
        <h1>Locaties</h1>
        <a href="{{ route('locations.create') }}" class="buttons">Voeg een nieuwe locatie toe</a>
        <table class="table_profile">
            <thead>
            <tr>
                <th>Naam</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Actie</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($locations as $location)
                <tr>
                    <td>{{ $location->name }}</td>
                    <td>{{ $location->latitude }}</td>
                    <td>{{ $location->longitude }}</td>
                    <td>
                        <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-warning">Bewerken</a>
                        <form action="{{ route('locations.destroy', $location->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
