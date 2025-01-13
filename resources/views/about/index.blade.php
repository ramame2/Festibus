@extends('layouts.app')

@section('title', 'Over Ons')

@push('styles')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lightbox.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="festival-section">
    <div class="container mt-5">
        <div class="button-container">
            <!-- Eerste knop -->
            <a href="#" id="wieZijnWeBtn" class="custom-button">Wie zijn we?</a>
            <!-- Derde knop -->
            <a href="#" id="onzeFotosBtn" class="custom-button">Onze Foto's</a>
        </div>
    </div>



    <!-- Wie zijn we Modal -->
    <div id="wieZijnWeModal" class="modal">
        <div class="modal-content">
            <p>Festibus organiseert sinds 2010 busreizen met luxe touringcars naar georganiseerde events en festivals. Uit ervaring weten we wat de belangrijke ingrediënten zijn voor een succesvolle busreis, zoals een leuke buschauffeur en een muziekje aan. Wij faciliteren hier zo goed mogelijk in zodat jullie er zelf een feestje van kunnen maken in de bus.</p> </div>
    </div>


    <!-- Onze Foto's Modal -->
    <div id="onzeFotosModal" class="modal">
        <div class="modal-content">
            <div class="strip-container">
                @foreach($photos as $photo)
                    <div class="thumbnail-container">
                        <img class="thumbnail" src="{{ $photo->url }}" alt="{{ $photo->title }}">


                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="lightbox" class="lightbox">
        <div class="lightbox-content">
            <span class="close" onclick="closeLightbox()">&times;</span>
            <img id="lightbox-img">
        </div>
    </div>

    <!-- About Section -->
    <div class="about-section" id="aboutSection">
        <h1>Over ons</h1>
        <p><strong>Tel:</strong> {{ $aboutInfo->phone }}</p>
        <p><strong>Locatie:</strong> {{ $aboutInfo->location }}</p>
        <p><strong>E-mail:</strong> {{ $aboutInfo->email }}</p>

        <h3>Openingstijden</h3>

        @if(is_array($opening_hours) && count($opening_hours) > 0)
            <table class="table_profile">

                <tbody>
                @foreach($opening_hours as $day => $hours)
                    <tr>
                        <td >{{ ucfirst($day) }}</td>
                        <td >{{ $hours }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No opening hours available.</p>
        @endif



    </div>
    @if(auth()->check() && auth()->user()->role === 'admin')
        <a href="{{ route('about.edit', $aboutInfo->id) }}" class="buttons">Bewerk over-ons en openingstijden </a>
    @endif

</div>


        <script>

            var wieZijnWeModal = document.getElementById("wieZijnWeModal");
            var onzeFotosModal = document.getElementById("onzeFotosModal");
            var lightbox = document.getElementById("lightbox");
            var lightboxImg = document.getElementById("lightbox-img");

            // Get the button elements
            var wieZijnWeBtn = document.getElementById("wieZijnWeBtn");
            var onzeFotosBtn = document.getElementById("onzeFotosBtn");

            // Get the <span> elements that close the modal
            var span = document.getElementsByClassName("close");

            // When the user clicks the button, open the corresponding modal
            wieZijnWeBtn.onclick = function() {
                wieZijnWeModal.style.display = "block";
            }

            onzeFotosBtn.onclick = function() {
                onzeFotosModal.style.display = "block";
            }

            // When the user clicks on any thumbnail image, show it in the lightbox
            var thumbnails = document.getElementsByClassName("thumbnail");
            for (var i = 0; i < thumbnails.length; i++) {
                thumbnails[i].onclick = function() {
                    lightboxImg.src = this.src;
                    lightbox.style.display = "flex";
                }
            }

            // When the user clicks on <span> (x), close the current modal or lightbox
            for (var i = 0; i < span.length; i++) {
                span[i].onclick = function() {
                    this.parentElement.parentElement.style.display = "none";
                }
            }

            // When the user clicks anywhere outside of the modal or lightbox, close it
            window.onclick = function(event) {
                if (event.target == wieZijnWeModal) {
                    wieZijnWeModal.style.display = "none";
                } else if (event.target == onzeFotosModal) {
                    onzeFotosModal.style.display = "none";
                } else if (event.target == lightbox) {
                    lightbox.style.display = "none";
                }
            }

            // Function to close the lightbox
            function closeLightbox() {
                lightbox.style.display = "none";
            }
        </script>

    @endsection
