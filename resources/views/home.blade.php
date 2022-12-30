<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Castle</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/909/909428.png">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
{{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
 <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

<!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/board.css') }}" rel="stylesheet">


</head>

<body>
<header>

    <div class="banner">
        <a href="/">-Castle-</a>
    </div>
    <div class="navigation">
        @guest
        <div class="right">
            <div class="main-button"> <a href="/">Home</a></div>
            <li class="nav-item">
                <div  id="nav-hover" >

                    <a href="#">Graj</a>
                    <ul>
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Zaloguj') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Zarejestruj') }}</a>
                            </li>
                        @endif
                        @else
                            <div class="right">
                                <div class="main-button"> <a href="/">Home</a><a href="/changePassword">Zmien haslo</a></div>
                                <li class="nav-item dropdown">
                                    <div> Witaj  {{ Auth::user()->name }} !</div>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Wyloguj') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </div>
                    @endguest
                </div>
            </li>

        </div>
    </div>
</header>



<main>

    @yield('board')

</main>

</body>
</html>
