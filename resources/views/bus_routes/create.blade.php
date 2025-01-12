@extends('layouts.admin')
@section('title', 'Bus Route')
@section('content')
    <div class="profile_container">
        <h1>Voeg Nieuwe Bus Route</h1>
        <form action="{{ route('bus-routes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="departure_id">Vertrek Locatie</label>
                <select class="form-control" name="departure_id" id="departure_id" required>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="destination_id">Bestemming</label>
                <select class="form-control" name="destination_id" id="destination_id" required>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="departure_time">Vertrektijd</label>
                <input type="time" class="form-control" name="departure_time" id="departure_time" required>
            </div>
            <div class="form-group">
                <label for="duration">Duur</label>
                <input type="time" class="form-control" name="duration" id="duration" required>
            </div>
            <div class="form-group">
                <label for="costs">Kosten</label>
                <input type="number" step="0.01" class="form-control" name="costs" id="costs" required>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
