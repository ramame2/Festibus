@extends('layouts.app')
@section('title', 'Contact')
@section('title', 'Contact Pagina')

@section('content')
    <div class="contact-section">
        <h2>Neem contact met ons op</h2>
        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        <form action="{{ route('contact.store') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <div>
                <label for="naam">Naam:</label>
                <input type="text" id="naam" name="naam" required>
            </div>
            <div>
                <label for="nummer">Nummer:</label>
                <input type="text" id="nummer" name="nummer" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="bericht">Bericht:</label>
                <textarea id="bericht" name="bericht" rows="4" required></textarea>
            </div>
            <div>
                <button type="submit">Verzenden</button>
            </div>
        </form>
    </div>


@endsection
