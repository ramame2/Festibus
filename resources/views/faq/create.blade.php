
@extends('layouts.app')

@section('title', 'FAQ')
@section('content')
    @if(auth()->check() && auth()->user()->role === 'admin')
        <div class="profile_container">
        <h2>Add New FAQ</h2>

        <form method="POST" action="{{ route('faq.store') }}">
            @csrf
            <div>
                <label for="question">Question</label>
                <input type="text" name="question" id="question" required>
            </div>

            <div>
                <label for="answer">Answer</label>
                <textarea name="answer" id="answer" required></textarea>
            </div>

            <div>
                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <option value="Algemeen">Algemene Vragen</option>
                    <option value="Specifiek">Specifieke Vragen</option>
                    <option value="Services">Veiligheid en Services</option>
                    <option value="Bereikbaarheid">Bereikbaarheid</option>
                </select>
            </div>

            <button type="submit">Add FAQ</button>
        </form>
    </div>
    @endif
@endsection
