@extends('layouts.app')

@section('title', 'Feedback')

@section('content')
    <div class="feedback-section">
        <h2>We horen graag uw mening, suggesties of problemen met alles wat we kunnen verbeteren.</h2>
        <h4>Onze Rating:
            <span>
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= floor($averageRating))
                        ⭐
                    @elseif ($i - $averageRating < 1)
                        🌟
                    @else
                        ☆
                    @endif
                @endfor
            </span> {{ number_format($averageRating, 1) }}
        </h4>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('feedback.store') }}" method="POST">
            @csrf

            <div class="rating-container">
                <h4>Hoeveel sterren van 5 geeft u uw ervaring met ons?</h4>

                <div class="rating">
                    <input type="radio" name="rating" value="5" id="star-5" required><label for="star-5"></label>
                    <input type="radio" name="rating" value="4" id="star-4"><label for="star-4"></label>
                    <input type="radio" name="rating" value="3" id="star-3"><label for="star-3"></label>
                    <input type="radio" name="rating" value="2" id="star-2"><label for="star-2"></label>
                    <input type="radio" name="rating" value="1" id="star-1"><label for="star-1"></label>
                </div>
            </div>

            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Bericht:</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">Feedback indienen</button>
        </form>
    </div>

@endsection
