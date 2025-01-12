@extends('layouts.app')
@section('title', 'Routes')
@section('content')
    <div class="container-home">
        <!-- Map Section -->
        <div class="map-section">
            <div id="map" style="height: 400px; width: 100%;"></div>
        </div>

        <!-- Route Results Section -->
        <div class="content-wrapper">
            <h2>Route Opties</h2>
            <div id="route-options" class="route-options">
                <p><strong>Vertrekkingsplaats:</strong> {{ $departure->name }}</p>
                <p><strong>Bestemming:</strong> {{ $destination->name }}</p>

                <h3>Route Details</h3>
                <ul>
                    <li>Vertrek: {{ $departure->name }} ({{ $departure->latitude }}, {{ $departure->longitude }})</li>
                    <li>Bestemming: {{ $destination->name }} ({{ $destination->latitude }}, {{ $destination->longitude }})</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Leaflet Map and Directions Script -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize the map
            var map = L.map('map').setView([{{ $departure->latitude }}, {{ $departure->longitude }}], 10); // Center on departure

            // Add tile layer to the map
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add markers for departure and destination
            var departureMarker = L.marker([{{ $departure->latitude }}, {{ $departure->longitude }}]).addTo(map)
                .bindPopup("Vertrek: {{ $departure->name }}")
                .openPopup();

            var destinationMarker = L.marker([{{ $destination->latitude }}, {{ $destination->longitude }}]).addTo(map)
                .bindPopup("Bestemming: {{ $destination->name }}")
                .openPopup();

            // Create a route using Leaflet Routing Machine
            L.Routing.control({
                waypoints: [
                    L.latLng({{ $departure->latitude }}, {{ $departure->longitude }}),
                    L.latLng({{ $destination->latitude }}, {{ $destination->longitude }})
                ],
                createMarker: function() { return null; }, // Disable markers on the route
                routeWhileDragging: true
            }).addTo(map);

            // Optional: Zoom to fit the bounds of the route
            map.fitBounds([
                [{{ $departure->latitude }}, {{ $departure->longitude }}],
                [{{ $destination->latitude }}, {{ $destination->longitude }}]
            ]);
        });
    </script>
@endsection
