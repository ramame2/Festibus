@extends('layouts.app')
@section('title', $departure . ' naar ' . $destination . ' reserveren' )
@section('content')
    <div class="container">
        <div class="booking-section">
            <h2>Boekingsformulier</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('booking.store') }}">
                @csrf

                <div class="form-group">
                    <label for="departure">Vertrekkingsplaats</label>
                    <input type="text" id="departure" name="departure" class="form-control" value="{{ $departure }}" readonly>
                </div>

                <div class="form-group">
                    <label for="destination">Bestemming</label>
                    <input type="text" id="destination" name="destination" class="form-control" value="{{ $destination }}" readonly>
                </div>

                <div class="form-group">
                    <label for="departure_date">Vertrekdatum</label>
                    <input type="date" id="departure_date" name="departure_date" class="form-control" value="{{ old('departure_date', request('departure_date')) }}" readonly>
                </div>

                <div class="form-group">
                    <label for="departure_time">Vertrektijd</label>
                    <input type="time" id="departure_time" name="departure_time" class="form-control" value="{{ $departureTime }}" readonly>
                </div>

                <div class="form-group">
                    <label for="price">Ticketprijs</label>
                    <input type="number" id="price" name="price" class="form-control" value="{{ $price }}" readonly>
                </div>

                <!-- Name and Email fields, autofilled if the user is logged in -->
                @auth
                    <div class="form-group">
                        <label for="name">Naam</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                    </div>
                @else
                    <!-- If the user is not logged in, ask for name and email -->
                    <div class="form-group">
                        <label for="name">Naam</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                @endauth

                <div class="form-group">
                    <label for="number_of_people">Aantal Personen</label>
                    <input type="number" id="number_of_people" name="number_of_people" class="form-control" value="1" min="1" step="1" required>
                </div>

                <div class="form-group">
                    <label for="total_price">Totale Prijs</label>
                    <input type="number" id="total_price" name="total_price" class="form-control" value="{{ $price }}" readonly>
                </div>

                <div class="form-group">
                    <label for="payment_method">Betaalmethode</label>
                    <select id="payment_method" name="payment_method" class="form-control" required>
                        <option value="credit_card">Creditcard</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank_transfer">Bankoverschrijving</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Boeking Bevestigen</button>
            </form>

            <!-- Admin actions: edit, delete, or manage bookings -->
            @can('manage-booking')
                <div class="admin-actions mt-3">
                    <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-warning">Bewerken</a>
                    <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Verwijderen</button>
                    </form>
                </div>
            @endcan
        </div>
    </div>

    <script>
        document.getElementById('number_of_people').addEventListener('input', function() {
            const price = parseFloat(document.getElementById('price').value);
            const numberOfPeople = parseInt(this.value);
            document.getElementById('total_price').value = (price * numberOfPeople).toFixed(2);
        });
    </script>
@endsection
