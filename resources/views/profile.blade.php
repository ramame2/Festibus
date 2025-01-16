@extends('layouts.app')
@section('title',  $user->name . ' Profiel')
@section('content')



    <div class="profile_container">

        <h2>Welkom, {{ optional(auth()->user())->name }}!</h2>
        <a href="{{ route('users.edit', $user->id) }}" class="buttons">Beheer uw account</a>
        <h3>Uw boekingen</h3>
        @if($bookings->isEmpty())
            <p>Nog geen boekingen. Ontdek nieuwe avonturen en reis naar uw favoriete festivals! Begin vandaag nog met het boeken van uw tickets en maak uw droomreis werkelijkheid.</p>
        @else
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table_profile">
                <thead>
                <tr>
                    <th>Vertrek</th>
                    <th>Bestemming</th>
                    <th>Datum</th>
                    <th>Vertrektijd</th>
                    <th>Aantal</th>
                    <th>Tickets prijs</th>
                    <th>Beheren</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    @php
                        $departureDate = \Carbon\Carbon::parse($booking->departure_date);
                        $currentDate = \Carbon\Carbon::now();
                        $isCancelable = $departureDate->diffInDays($currentDate) < 1;
                    @endphp
                    <tr>
                        <td>{{ $booking->departure }}</td>
                        <td>{{ $booking->destination }}</td>
                        <td>{{ $booking->departure_date }}</td>
                        <td>{{ $booking->departure_time }}</td>
                        <td>{{ $booking->number_of_people }}</td>
                        <td>{{ $booking->total_price }}</td>
                        <td>
                            @if($isCancelable)
                                <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Weet u zeker dat u deze reis wilt annuleren?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Annuleren</button>
                                </form>
                            @else
                                <span class="text-muted">Annuleren is niet meer mogelijk</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @endif
    </div>

@endsection
