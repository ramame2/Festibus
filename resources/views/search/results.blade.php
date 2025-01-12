@extends('layouts.app')
@section('title', 'Resultaten')
@section('content')
    <div class="profile_container">
    <form method="GET" action="{{ route('search') }}">
        <input type="text" name="query" placeholder="Search..." value="{{ old('query', $query) }}" required>
        <button type="submit">Search</button>
    </form>

    @foreach($results as $table => $items)
        <h2>Resultaten in: {{ ucfirst($table) }}</h2>
        @foreach($items as $item)
            <div class="result">
                @if($table == 'news')
                    <h3>{{ $item->title }}</h3>
                    <p>{{ $item->content }}</p>
                @elseif($table == 'locations')
                    <h3>{{ $item->name }}</h3>
                @elseif($table == 'faqs')
                    <h3>{{ $item->question }}</h3>
                    <p>{{ $item->answer }}</p>
                @endif
                <h3>{{ $item->naam ?? $item->title ?? '' }}</h3>


                <p>{{ $item->beschrijving ?? $item->content ?? ''}}</p>


                @if(isset($item->image))
                    {!! $item->image !!}
                @endif


                @if(isset($item->link))
                    <a href="{{ $item->link }}">Meer info</a>
                @endif
            </div>
        @endforeach
    @endforeach

    @if($pages)
        <h3>Paginas:</h3>
        <ul>
            @foreach($pages as $page)
                <li><a href="{{ url($page) }}">{{ $page }}</a></li>
            @endforeach
        </ul>
        @endif

                            <div id="map" style="height: 300px; justify-self: center;width: 60%; margin-top: 20px; "></div>

        <!-- Scripts section -->
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


        <script>
            // Initialize the map with a default center and zoom level
            var map = L.map('map').setView([52.3676, 4.9041], 6);

            // Add the OpenStreetMap layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var hasLocations = false;

            @foreach($results as $table => $items)
                @if($table == 'locations')
                hasLocations = true;
            @foreach($items as $item)
            L.marker([{{ $item->latitude }}, {{ $item->longitude }}])
                .addTo(map)
                .bindPopup("<b>{{ $item->name }}</b><br>Lat: {{ $item->latitude }}, Lng: {{ $item->longitude }}");
            @endforeach

            @if ($items->count() > 0)
            map.setView([{{ $items[0]->latitude }}, {{ $items[0]->longitude }}], 10);  // Zoom level adjusted (12 is a closer zoom)
            @endif
            @endif
            @endforeach

            // Show the map only if there are locations
            if (hasLocations) {
                document.getElementById('map').style.display = 'block';
            }
        </script>

@endsection
