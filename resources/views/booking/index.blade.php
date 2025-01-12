@extends('layouts.app')
@section('title', 'Boekingen')
@section('content')
    <div class="profile_container">
        <h2>Beheer Boekingen</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <form method="GET" action="{{ route('booking.index') }}">
            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Zoek boekingen" value="{{ $search }}">
            </div>
            <button type="submit" class="buttons">Zoeken</button>
        </form>

        <table class="table_profile">
            <thead>
            <tr>
                <th>
                    <a href="{{ route('booking.index', ['sort_by' => 'id', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">#</a>
                    @if (request('sort_by') == 'id')
                        @if (request('sort_order') == 'asc')
                            ↑
                        @else
                            ↓
                        @endif
                    @endif
                </th>
                <th>
                    <a href="{{ route('booking.index', ['sort_by' => 'departure', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">Vertrekkingsplaats</a>
                    @if (request('sort_by') == 'departure')
                        @if (request('sort_order') == 'asc')
                            ↑
                        @else
                            ↓
                        @endif
                    @endif
                </th>
                <th>
                    <a href="{{ route('booking.index', ['sort_by' => 'destination', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">Bestemming</a>
                    @if (request('sort_by') == 'destination')
                        @if (request('sort_order') == 'asc')
                            ↑
                        @else
                            ↓
                        @endif
                    @endif
                </th>
                <th>
                    <a href="{{ route('booking.index', ['sort_by' => 'departure_date', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">
                        Vertrekdatum
                        @if (request('sort_by') == 'departure_date')
                            @if (request('sort_order') == 'asc')
                                ↑
                            @else
                                ↓
                            @endif
                        @endif
                    </a>
                </th>

                <th>Vertrektijd</th>
                <th>Prijs</th>
                <th>Name</th>
                <th>Aantal Personen</th>
                <th>Acties</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($groupedBookings as $destination => $userBookings)
                @php
                    $previousDestination = null;
                @endphp

                @foreach ($userBookings as $booking)
                    <!-- Show the destination header only if it's different from the previous one -->
                    @if ($booking->destination !== $previousDestination)
                        <tr>
                            <td colspan="8"><strong>Naar: {{ $booking->destination }}</strong></td>
                        </tr>
                    @endif

                    <!-- Booking details row -->
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->departure }}</td>
                        <td>{{ $booking->destination }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->departure_date)->format('d-m-Y') }}</td>
                        <td>{{ $booking->departure_time }}</td>
                        <td>{{ $booking->price }}</td>
                        <td>{{ $booking->name }}</td>
                        <td>{{ $booking->number_of_people }}</td>
                        <td>
                            <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-warning">Bewerken</a>
                            <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Boeking verwijderen?')">Verwijderen</button>
                            </form>
                        </td>
                    </tr>

                    @php
                        // Update the previousDestination variable
                        $previousDestination = $booking->destination;
                    @endphp


                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
