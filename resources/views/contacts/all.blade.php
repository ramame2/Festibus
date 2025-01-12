@extends('layouts.app')

@section('title', 'Messages')
@section('content')
    <div class="profile_container">
        <h2 class="text-center mb-4"Alle Contactberichten></h2>

        @if($contacts->isEmpty())
            <p class="text-center">Er zijn geen contactberichten beschikbaar.</p>
        @else
            <table class="table_profile">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Naam</th>
                    <th>Nummer</th>
                    <th>Email</th>
                    <th>Bericht</th>
                    <th>Datum</th>
                    <th>Reageren</th>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->naam }}</td>
                        <td>{{ $contact->nummer }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->bericht }}</td>
                        <td>{{ $contact->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <a href="mailto:{{ $contact->email }}" style="color: #007bff; text-decoration: none;">
                                stuur een e-mail
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
