@extends('layouts.app')

@section('title', 'FAQ')
@section('content')
    <div class="profile_container">
        <h2>FAQ</h2>



        <form method="GET" action="{{ route('faq.index') }}">
        <input type="text" id="search-input" name="search" placeholder="Zoek FAQs" value="{{ request('search') }}">

        <button type="submit">Zoek</button>
        </form>

    <!-- FAQ List -->
    <table class="table_profile">
        <thead>
        <tr>
            <th>Vraag</th>
            <th>Antwoord</th>
            @if(auth()->check() && auth()->user()->role === 'admin')
            <th>Bewerken</th>
            @endif


        </tr>
        </thead>
        <tbody>

        @foreach ($faqs as $faq)
            <tr>
                <td>{{ $faq->question }}</td>
                <td>{{ $faq->answer }}</td>
                @if(auth()->check() && auth()->user()->role === 'admin')

                    <td>
                    <a href="{{ route('faq.edit', $faq) }}" class="btn btn-warning btn-sm">Bewerken</a>

                    <form method="POST" action="{{ route('faq.destroy', $faq) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('FAQ Verwijderen?')">Verwijderen</button>
                    </form>
                </td>

                    @endif
            </tr>

        @endforeach
        </tbody>
    </table>
    </div>

    <div class="additional-info">

        @if(auth()->check() && auth()->user()->role === 'admin')
            <div class="d-flex justify-content-center">
                <a href="{{ route('faq.create') }}" class="buttons">Voeg nieuwe FAQ toe</a>
            </div>
        @endif

        <p>Als u nog vragen hebt, stuur deze dan via de <a href="../contact">contactpagina</a>, en we beantwoorden u graag binnen 5 werkdagen.</p> </div>
<br><br>
@endsection
