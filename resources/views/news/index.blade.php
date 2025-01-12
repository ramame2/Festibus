@extends('layouts.app')
@section('title', 'Nieuws')
@section('content')
    <div class="profile_container">
        <h2>Nieuws Management</h2>

        <form method="GET" action="{{ route('news.create') }}">
            <button type="submit" class="btn btn-primary">Voeg nieuws toe</button>
        </form>


    @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table_profile">
            <thead>
            <tr>
                <th>Title</th>
                <th>Inhoud</th>
                <th>Published At</th>
                <th>Actie</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($news as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->content }}</td>
                    <td>{{ $item->created_at->format('F j, Y') }}</td>
                    <td>
                        <a href="{{ route('news.edit', $item->id) }}" class="btn btn-warning">Bewerken</a>
                        <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
