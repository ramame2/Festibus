@extends('layouts.app')

@section('title', 'Bus Route')
@section('content')
    <div class="profile_container">
        <h1>Bus Routes</h1>
        <a href="{{ route('locations.create') }}" class="buttons">Voeg een nieuwe locatie toe</a>
        <a href="{{ route('bus-routes.create') }}" class="buttons2">Nieuwe busroute toevoegen</a>
        <a href="{{ route('locations.index') }}" class="buttons">Locaties Beheren</a>
        <table class="table_profile">
            <thead>
            <tr>
                <th>Vertreklocatie</th>
                <th>Bestemmingslocatie</th>
                <th>Vertrektijd</th>
                <th>Duur</th>
                <th>Kosten</th>
                <th>Acties</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($busRoutes as $busRoute)
                <tr>
                    <td>{{ $busRoute->departureLocation->name }}</td>
                    <td>{{ $busRoute->destinationLocation->name }}</td>
                    <td>{{ $busRoute->departure_time }}</td>
                    <td>{{ $busRoute->duration }}</td>
                    <td>{{ $busRoute->costs }}</td>
                    <td>
                        <a href="{{ route('bus-routes.edit', $busRoute->id) }}" class="btn btn-warning">Bewerking</a>
                        <form action="{{ route('bus-routes.destroy', $busRoute->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Vervijderen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
