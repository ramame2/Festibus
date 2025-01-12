@extends('layouts.app')

@section('title', 'FAQ')
@section('content')
    <div class="profile_container">
        <h2>Edit FAQ</h2>

        <!-- Display success message if any -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('faq.update', $faq) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="question">Vraag</label>
                <input type="text" name="question" id="question" class="form-control" value="{{ old('question', $faq->question) }}" required>
                @error('question')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="answer">Antwoord</label>
                <textarea name="answer" id="answer" class="form-control" rows="5" required>{{ old('answer', $faq->answer) }}</textarea>
                @error('answer')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="Algemeen" {{ old('category', $faq->category) == 'Algemeen' ? 'selected' : '' }}>Algemeen</option>
                    <option value="Specifiek" {{ old('category', $faq->category) == 'Specifiek' ? 'selected' : '' }}>Specifieke Vragen</option>
                    <option value="Services" {{ old('category', $faq->category) == 'Services' ? 'selected' : '' }}>Veiligheid en Services</option>
                    <option value="Bereikbaarheid" {{ old('category', $faq->category) == 'Bereikbaarheid' ? 'selected' : '' }}>Bereikbaarheid</option>
                </select>
                @error('category')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">FAQ Updaten</button>
        </form>
    </div>
@endsection
