<header>

    <div class="animated-bus-container">
        <img src="{{ asset('images/gif.gif') }}" alt="Bewegende Bus" class="animated-bus">
    </div>
    <nav>
        <div class="nav-left">
            @auth
                    <p class="welcome-message" style="text-decoration: none;">
                        {{ __('Welkom,') }} {{ Auth::user()->name }}! <br>
                    </p>

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" >Admin Dashboard</a>
                @endif
                    <a href="{{ route('profile') }}">Uw profiel</a>


                    <a class="uitloggen" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        {{ __('Uitloggen') }}
                    </a>


                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>

            @else
                <p class="welcome-message" style="text-decoration: none;">Welkom!<br>
                </p>
                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                    <a href="{{ route('login') }}">{{ __('Inloggen') }}</a>

            @endauth
</div>


        <div class="nav-middle">
            <p class="brand-title">Festibus</p>
        </div>

        <div class="nav-right">
            <a href="/">
                <img src="{{ asset('images/fff.jpg') }}" alt="Logo" class="logo">
            </a>
        </div>
    </nav>
</header>
