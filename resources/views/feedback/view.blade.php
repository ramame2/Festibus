@extends('layouts.app')

@section('title', 'Reviews')
@section('content')
    <div class="profile_container">
        <h1>Feedbacks</h1>

        <!-- Display the average rating -->
        <h4>Average Rating: {{ number_format($averageRating, 1) }} Sterren
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
            </span>
        </h4>

        @if($feedbacks->isEmpty())
            <p>No feedbacks available.</p>
        @else
            <table class="table_profile">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Rating</th>
                </tr>
                </thead>
                <tbody>
                @foreach($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback->id }}</td>
                        <td>{{ $feedback->name }}</td>
                        <td>{{ $feedback->email }}</td>
                        <td>{{ $feedback->message }}</td>
                        <td>{{ $feedback->rating }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
