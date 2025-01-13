<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('images/fff.jpg') }}" >
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    @if(!auth()->check() || auth()->user()->role !== 'admin')
        @php
            header('Location: ' . route('home'));
            exit;
        @endphp
    @endif

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


        @auth

            <!-- Admin Bar -->
            <div class="admin-bar">
                <ul>
                    <li><a href="{{ route('admin.dashboard') }}">Welkom, {{ auth()->user()->name }}!</a></li>
                    <li><a href="{{ route('users.index') }}">Beheer Users</a></li>
                    <li><a href="{{ route('festivals.index') }}">Festivals</a></li>
                    <li><a href="{{ route('faq.index') }}"> FAQs</a></li>
                    <li><a href="{{ route('contacts.all') }}">Messages</a></li>
                    <li><a href="{{ route('feedback.view') }}">Feedback en reviews</a></li>
                    <li><a href="{{ route('booking.index') }}">Boekingen</a></li>
                    <li><a href="{{ route('news.index') }}">Nieuws Updaten</a></li>
                </ul>
            </div>

        @endauth

</head>
<body>
@if (!Request::is('/') )
    @php
        $breadcrumbs = [
            'Home' => route('home'),
            trim(View::yieldContent('title')) => ''
        ];
    @endphp

    <x-breadcrumb :links="$breadcrumbs" />

@endif
<div>
    @yield('content')
</div>


</body>
@include('components.footer')
</html>

