@extends('layouts.app')
@section('title', 'Nieuws')
@section('content')
    <div class="profile_container">
        <h2>Bewerk Nieuws</h2>

        <form action="{{ route('news.update', $news->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $news->title }}" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" class="form-control" rows="5" required>{{ $news->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
