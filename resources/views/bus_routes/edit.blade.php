@extends('layouts.app')

@section('title', 'Bus Route')
@section('content')
    <div class="profile_container">
        <h1>Edit Bus Route</h1>
        <form action="{{ route('bus-routes.update', $busRoute->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="departure_id">Vertrek</label>
                <select class="form-control" name="departure_id" id="departure_id" required>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" @if($busRoute->departure_id == $location->id) selected @endif>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="destination_id">Bestemming</label>
                <select class="form-control" name="destination_id" id="destination_id" required>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" @if($busRoute->destination_id == $location->id) selected @endif>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="departure_time">Vertrektijd</label>
                <input type="time" class="form-control" name="departure_time" id="departure_time" value="{{ $busRoute->departure_time }}" required>
            </div>
            <div class="form-group">
                <label for="duration">Duur</label>
                <input type="time" class="form-control" name="duration" id="duration" value="{{ $busRoute->duration }}" required>
            </div>
            <div class="form-group">
                <label for="costs">Kosten</label>
                <input type="number" step="0.01" class="form-control" name="costs" id="costs" value="{{ $busRoute->costs }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Updaten</button>
        </form>
    </div>
@endsection
