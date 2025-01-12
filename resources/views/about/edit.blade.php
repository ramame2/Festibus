@extends('layouts.app')

@section('title', 'Over Ons Bewerken')

@section('content')
    @if(!auth()->check() || auth()->user()->role !== 'admin')
        @php
            header('Location: ' . route('home'));
            exit;
        @endphp
    @endif

    <div class="profile_container">
        <h1>Bewerk Over Ons Informatie</h1>
        <form method="POST" action="{{ route('about.update', $aboutInfo->id) }}">
            @csrf
            @method('PUT')

            <!-- Algemene Informatie -->
            <div class="form-group">
                <label for="email">E-mail</label>
                <textarea id="email" name="email" class="form-control" rows="4">{{ old('email', $aboutInfo->email) }}</textarea>
            </div>

            <!-- Telefoonnummer -->
            <div class="form-group">
                <label for="phone">Telefoonnummer</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $aboutInfo->phone) }}">
            </div>

            <!-- Locatie -->
            <div class="form-group">
                <label for="location">Locatie (Google Maps Embed)</label>
                <textarea id="location" name="location" class="form-control" rows="3">{{ old('location', $aboutInfo->location) }}</textarea>
            </div>

            <!-- Openingstijden -->
            <div id="openingHoursContainer">
                @foreach(['maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag', 'zondag'] as $day)
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <input type="text" name="opening_hours[{{ $day }}][day]" class="form-control" value="{{ ucfirst($day) }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <input type="time" name="opening_hours[{{ $day }}][opening]" class="form-control" value="{{ isset($opening_hours[$day]) ? $opening_hours[$day]['opening'] : '' }}">
                        </div>
                        <div class="col-md-3">
                            <input type="time" name="opening_hours[{{ $day }}][closing]" class="form-control" value="{{ isset($opening_hours[$day]) ? $opening_hours[$day]['closing'] : '' }}">
                        </div>
                        <div class="col-md-3">
                            <select name="opening_hours[{{ $day }}][status]" class="form-control">
                                <option value="closed" {{ isset($opening_hours[$day]) && (!$opening_hours[$day]['opening'] || !$opening_hours[$day]['closing']) ? 'selected' : '' }}>Gesloten</option>
                                <option value="open" {{ isset($opening_hours[$day]) && $opening_hours[$day]['opening'] && $opening_hours[$day]['closing'] ? 'selected' : '' }}>Open</option>
                            </select>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-success mt-3">Opslaan</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Initialize time picker for opening and closing hours
        flatpickr('.time-picker', {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            altInput: true,
            altFormat: "H:i"
        });

        // Function to add a new opening hour row
        function addOpeningHour() {
            const openingHourHtml = `<div class="row mb-2">
            <div class="col-md-3">
                <select name="opening_hours[][day]" class="form-control">
                    <option value="">Kies dag</option>
                    <option value="Maandag">Maandag</option>
                    <option value="Dinsdag">Dinsdag</option>
                    <option value="Woensdag">Woensdag</option>
                    <option value="Donderdag">Donderdag</option>
                    <option value="Vrijdag">Vrijdag</option>
                    <option value="Zaterdag">Zaterdag</option>
                    <option value="Zondag">Zondag</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" name="opening_hours[][opening]" class="form-control time-picker" placeholder="Openingstijd">
            </div>
            <div class="col-md-3">
                <input type="text" name="opening_hours[][closing]" class="form-control time-picker" placeholder="Sluitingstijd">
            </div>
        </div>`;
            document.getElementById('openingHoursContainer').insertAdjacentHTML('beforeend', openingHourHtml);
            flatpickr('.time-picker', { enableTime: true, noCalendar: true, dateFormat: "H:i", time_24hr: true, altInput: true, altFormat: "H:i" });
        }
    </script>
@endsection
