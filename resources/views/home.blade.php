@extends('layouts.app')
@section('title', 'Festibus')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@section('content')

    <div class="container-home">

            <!-- Zoekveld Sectie -->
        <div class="search-container">

            <div class="news-section">

                <div id="news-items" class="news-items">
                    @foreach($news as $item)
                        <div class="news-item" style="display: none;">  <h3>Laatste Nieuws</h3>
                            <h4>{{ $item->title }}</h4>
                            <p>{{ Str::limit($item->content, 100) }} <a href="{{ route('news.show', $item->id) }}"></a></p>
                        </div>
                    @endforeach
                </div>

                <form id="search-form" method="GET" action="{{ route('search') }}">
                    @csrf
                    <input type="text" id="search-input" name="query" placeholder="Zoek naar een festival, route of een andere informatie" required>
                    <button type="submit" class="btn btn-search">Zoeken</button>
                </form>

                <div class="map-section">
                    <!-- Responsive map container -->
                    <div id="map"></div>

                </div>
            </div>

        </div>
        <!-- Routes Sectie -->
        <div class="content-wrapper">
            <div class="routes-section">
                <h2>Routes</h2>

                <form id="route-form" method="POST" action="{{ route('routes.search') }}#route-options">
                    @csrf
                    <!-- Vertrekkingsplaats Selectie -->
                    <div class="form-group">
                        <label for="departure">{{ __('Vertrekkingsplaats') }}</label>
                        <select id="departure" class="form-control @error('departure') is-invalid @enderror" name="departure" required>
                            <option value="" disabled selected>Selecteer een locatie</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        @error('departure')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>

                    <!-- Bestemming Selectie -->
                    <div class="form-group">
                        <label for="destination">{{ __('Bestemming') }}</label>
                        <select id="destination" class="form-control @error('destination') is-invalid @enderror" name="destination" >
                            <option value="" disabled selected>Selecteer een locatie</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        @error('destination')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>
                    <!-- Vertrekdatum -->
                    <div class="form-group">
                        <label for="departure_date">{{ __('Vertrekdatum') }}</label>
                        <input type="date" id="departure_date" class="form-control @error('departure_date') is-invalid @enderror" name="departure_date" required
                               min="{{ \Carbon\Carbon::today()->toDateString() }}"
                               max="{{ \Carbon\Carbon::today()->addMonths(3)->toDateString() }}"
                               value="{{ \Carbon\Carbon::today()->toDateString() }}">
                        @error('departure_date')
                        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="departure_time">{{ __('Vertrektijd') }}</label>
                        <input type="time" id="departure_time" class="form-control @error('departure_time') is-invalid @enderror" name="departure_time" required
                               value="{{ \Carbon\Carbon::now()->format('H:i') }}" step="60">
                        @error('departure_time')
                        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
                        @enderror
                    </div>



                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Zoek </button>
                </form>
            </div>

        </div>

    </div>
    <!-- Route Resultaten Sectie -->
    <div id="route-options" class="route-options">
        @if(isset($routes) && $routes->isEmpty())
            <prr>Helaas! Er zijn momenteel geen routes beschikbaar. We werken er hard aan om binnenkort nieuwe routes aan te bieden.</prr>
        @elseif(isset($routes))
            @php
                // Array to track displayed combinations
                $displayedRoutes = [];
            @endphp
            @foreach($routes as $route)


                    <div class="route-option">

                        <pv>Van: {{ $route->departure->name }}</pv>
                        <pb>naar: {{ $route->destination->name }}</pb>
                        <p>Vertrekdatum: </p><pt>{{ \Carbon\Carbon::parse(old('departure_date', request('departure_date')))->format('d-m-Y') }}</pt>

                        <p>Vertrektijd: </p>
                        <pt>{{ \Carbon\Carbon::parse($route->departure_time)->format('H:i') }}</pt>

                        <p>Duur:</p>
                        <pt>{{ \Carbon\Carbon::parse('1970-01-01 ' . $route->duration)->format('H:i') }} uur:min</pt>

                        <p>Aankomsttijd:</p> <pt> {{ \Carbon\Carbon::parse($route->departure_time)->addMinutes((int)explode(':', $route->duration)[0] * 60 + (int)explode(':', $route->duration)[1])->format('H:i') }}</pt>
                        <pp>Prijs: €{{ $route->costs }}</pp>
                        <form method="GET" action="{{ route('booking.create') }}" id="booking-form">
                            <input type="hidden" name="departure" value="{{ $route->departure->name }}">
                            <input type="hidden" name="destination" value="{{ $route->destination->name }}">
                            <input type="hidden" name="departure_time" value="{{ $route->departure_time }}">
                            <input type="hidden" name="departure_date" value="{{ request('departure_date') }}">
                            <input type="hidden" name="price" value="{{ $route->costs }}">

                            @auth
                                <!-- If the user is logged in, automatically pass name and email -->
                                <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                <button type="submit" class="btn-booking-ticket">Boek uw ticket</button>
                            @else
                                <!-- If the user is not logged in, show the modal options to login or continue as guest -->
                                <button type="button" class="btn-booking-ticket" onclick="showLoginOptions()">Boek uw ticket</button>
                            @endauth
                        </form>


                        <!-- Modal (Popup) for Login/Guest Options -->
                        <div id="loginOptionsModal" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal()">&times;</span>
                                <h3>Wilt u zich aanmelden?</h3>
                                <button onclick="window.location='{{ route('login') }}'">Inloggen</button>
                                <button onclick="window.location='{{ route('register') }}'">Registreren</button>
                                <button onclick="submitAsGuest()">Doorgaan als Gast</button>
                            </div>
                        </div>


                    </div>




            @endforeach
        @endif
    </div>



    <!-- Scripts section -->
    <script src="{{ asset('js/home.js') }}"></script>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- Map view -->
    <script>

        // Initialize the map
        var map = L.map('map').setView([52.3676, 4.9041], 6); // Default center in the Netherlands

        // Add the OpenStreetMap layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Display all locations
        @foreach($locations as $location)
        L.marker([{{ $location->latitude }}, {{ $location->longitude }}])
            .addTo(map)
            .bindPopup("<b>{{ $location->name }}</b><br>Lat: {{ $location->latitude }}, Lng: {{ $location->longitude }}");
        @endforeach

        // Check if routes exist and display them
        @if(isset($routes) && !$routes->isEmpty())
        @foreach($routes as $route)
        @php
            $departureLat = $route->departure->latitude;
            $departureLng = $route->departure->longitude;
            $destinationLat = $route->destination->latitude;
            $destinationLng = $route->destination->longitude;
        @endphp

        // Add markers for departure and destination
        var departureMarker = L.marker([{{ $departureLat }}, {{ $departureLng }}]).addTo(map);
        departureMarker.bindPopup("Vertrek locatie: {{ $route->departure->name }}").openPopup();

        var destinationMarker = L.marker([{{ $destinationLat }}, {{ $destinationLng }}]).addTo(map);
        destinationMarker.bindPopup("Bestemming: {{ $route->destination->name }}");

        // Draw a line between departure and destination
        L.polyline([
            [{{ $departureLat }}, {{ $departureLng }}],
            [{{ $destinationLat }}, {{ $destinationLng }}]
        ], { color: 'red', weight: 3 }).addTo(map);

        // Zoom in on the departure location for the first route
        @if ($loop->first)
        map.setView([{{ $departureLat }}, {{ $departureLng }}], 15); // Adjust zoom level as needed
        @endif
        @endforeach
        @endif


    </script>


@endsection
