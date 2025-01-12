@extends('layouts.app')
@section('title', 'ADMIN DASHBOARD')
@section('content')
    <div class="admin-dashboard">
        <div class="col-md-12 text-center">
            <h1>Admin Dashboard</h1>
        </div>
        <div class="container-home">
        <!-- Locaties Beheren Section -->
        <div class="dashboard-item">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('locations.index') }}" class="dashboard-btn"><h2>locaties Beheren</h2></a>
                    <p class="card-text">Bekijk, bewerk of verwijder steden en stations.</p>

                </div>
            </div>
        </div>
        <!-- Bus Routes Beheren Section -->
        <div class="dashboard-item">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('bus-routes.index') }}"  class="dashboard-btn"><h2>Routes Beheren</h2></a>
                    <p class="card-text">Bekijk, bewerk of verwijder Busroutes.</p>

                </div>
            </div>
        </div>
        <!-- Gebruikers Beheren Section -->
        <div class="dashboard-item">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('users.index') }}" class="dashboard-btn"><h2>Gebruikers Beheren</h2></a>
                    <p class="card-text">Bekijk, bewerk of verwijder gebruikersaccounts in het systeem.</p>

                </div>
            </div>
        </div>

        <!-- Festivals Section -->
        <div class="dashboard-item">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('festivals.index') }}" class="dashboard-btn"><h2>Festivals</h2></a>
                    <p class="card-text">Beheer festivalinformatie zoals namen, locaties en datums.</p>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="dashboard-item">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('faq.index') }}" class="dashboard-btn"> <h2>FAQ</h2></a>
                    <p class="card-text">Bekijk en bewerk veelgestelde vragen die gebruikers kunnen raadplegen.</p>

                </div>
            </div>
        </div>

        <!-- Messages Section -->
        <div class="dashboard-item">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('contacts.all') }}"  class="dashboard-btn"><h2>Berichten</h2></a>
                    <p class="card-text">Bekijk en beheer contactberichten die door gebruikers zijn verzonden.</p>

                </div>
            </div>
        </div>

        <div class="dashboard-item">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('feedback.view') }}"  class="dashboard-btn"> <h2>Feedbacks</h2></a>
                    <p class="card-text">Bekijk feedbacks en beoordelingen.</p>
                </div>
            </div>
        </div>

        <!-- Boekingen Section -->
        <div class="dashboard-item mt-4">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('booking.index') }}" class="dashboard-btn"> <h2 class="card-title">Boekingen</h2></a>
                    <p class="card-text">Bekijk en beheer boekingen van gebruikers voor evenementen.</p>

                </div>
            </div>
        </div>

        <!-- Nieuws Section -->
        <div class="dashboard-item mt-4">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('news.index') }}" class="dashboard-btn"> <h2 class="card-title">Nieuws</h2></a>
                    <p class="card-text">Beheer nieuwsartikelen en aankondigingen voor gebruikers.</p>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
