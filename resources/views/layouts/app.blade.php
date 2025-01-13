
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('images/fff.jpg') }}" >
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('node_modules/admin-lte/dist/css/adminlte.min.css') }}">
    <script src="{{ asset('node_modules/admin-lte/dist/js/adminlte.min.js') }}"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>

<body>
@auth
    @if(auth()->check() && auth()->user()->role === 'admin')
        <!-- Admin Bar -->
        <div class="admin-bar">
            <ul>
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('users.index') }}">Beheer Users</a></li>
                <li><a href="{{ route('festivals.index') }}">Festivals</a></li>
                <li><a href="{{ route('faq.index') }}"> FAQs</a></li>
                <li><a href="{{ route('contacts.all') }}">Messages</a></li>
                <li><a href="{{ route('feedback.view') }}">Feedback en reviews</a></li>
                <li><a href="{{ route('booking.index') }}">Boekingen</a></li>
                <li><a href="{{ route('news.index') }}">Nieuws Updaten</a></li>
            </ul>
        </div>
    @endif
@endauth

@include('partials.header')
@if (!Request::is('/') )
    @php
        $breadcrumbs = [
            'Home' => route('home'),
            trim(View::yieldContent('title')) => ''
        ];
    @endphp

    <x-breadcrumb :links="$breadcrumbs" />

@endif
<div class="container" >
    @yield('content')
</div>


@include('components.footer')

</body>

</html>
