@extends('layouts.app')
@section('title', 'Boeking van ' . $booking->name)
@section('content')
    <div class="profile_container">
        <h2>Boeking Bewerken</h2>

        <form method="POST" action="{{ route('booking.update', $booking->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="departure">Vertrekkingsplaats</label>
                <input type="text" id="departure" name="departure" class="form-control" value="{{ $booking->departure }}" required>
            </div>

            <div class="form-group">
                <label for="destination">Bestemming</label>
                <input type="text" id="destination" name="destination" class="form-control" value="{{ $booking->destination }}" required>
            </div>

            <div class="form-group">
                <label for="departure_date">Vertrekdatum</label>
                <input type="date" id="departure_date" name="departure_date" class="form-control" value="{{ $booking->departure_date }}" required>
            </div>

            <div class="form-group">
                <label for="departure_time">Vertrektijd</label>
                <input type="time" id="departure_time" name="departure_time" class="form-control" value="{{ $booking->departure_time }}" required>
            </div>

            <div class="form-group">
                <label for="price">Ticketprijs</label>
                <input type="number" id="price" name="price" class="form-control" value="{{ $booking->price }}" required>
            </div>

            <div class="form-group">
                <label for="number_of_people">Aantal Personen</label>
                <input type="number" id="number_of_people" name="number_of_people" class="form-control" value="{{ $booking->number_of_people }}" required>
            </div>

            <div class="form-group">
                <label for="payment_method">Betaalmethode</label>
                <select id="payment_method" name="payment_method" class="form-control" required>
                    <option value="credit_card" {{ $booking->payment_method == 'credit_card' ? 'selected' : '' }}>Creditcard</option>
                    <option value="paypal" {{ $booking->payment_method == 'paypal' ? 'selected' : '' }}>PayPal</option>
                    <option value="bank_transfer" {{ $booking->payment_method == 'bank_transfer' ? 'selected' : '' }}>Bankoverschrijving</option>
                </select>
            </div>


            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $booking->name) }}" required>
            </div>
            <div class="form-group">
                <label for="name">E-mail</label>
                <input type="text" id="email" name="email" class="form-control" value="{{ old('email', $booking->email) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Opslaan</button>
        </form>
    </div>
@endsection
