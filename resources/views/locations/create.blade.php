@extends('layouts.admin')
@section('title', 'Sations')
@section('content')
    <div class="profile_container">
        <h1>Add New Location</h1>
        <form action="{{ route('locations.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="number" step="0.0000001" class="form-control" name="latitude" id="latitude" required readonly>
            </div>
            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="number" step="0.0000001" class="form-control" name="longitude" id="longitude" required readonly>
            </div>
            <div id="map" style="height: 400px;"></div> <!-- Map container -->
            <button type="submit" class="btn btn-success mt-3">Save</button>
        </form>
    </div>

    <!-- Include Leaflet JS and CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <!-- Include Leaflet Control Geocoder -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
        // Initialize the map
        var map = L.map('map').setView([52.3676, 4.9041], 6);

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add a marker on click
        var marker = L.marker([52.3676, 4.9041]).addTo(map); // Initial position

        // Update the latitude and longitude inputs on marker drag or click
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            // Move the marker to the clicked location
            marker.setLatLng([lat, lng]);

            // Update the latitude and longitude input fields
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });

        // Enable search functionality (using Leaflet Control Geocoder)
        var geocoder = L.Control.Geocoder.nominatim();
        L.Control.geocoder({
            query: '',
            placeholder: 'Zoek naar een locatie...',
            errorMessage: 'Locatie niet gevonden!'
        })
            .on('markgeocode', function(e) {
                var lat = e.geocode.center.lat;
                var lng = e.geocode.center.lng;

                // Move the marker to the search result
                marker.setLatLng([lat, lng]);

                // Update the latitude and longitude input fields
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            })
            .addTo(map);
    </script>
@endsection
