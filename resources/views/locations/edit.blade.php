@extends('layouts.admin')
@section('title', 'Sations')
@section('content')
    <div class="profile_container">
        <h1>Edit Locatie</h1>
        <form action="{{ route('locations.update', $location->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $location->name }}" required>
            </div>
            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="number" step="0.0000001" class="form-control" name="latitude" id="latitude" value="{{ $location->latitude }}" required>
            </div>
            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="number" step="0.0000001" class="form-control" name="longitude" id="longitude" value="{{ $location->longitude }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
