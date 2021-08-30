<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
            <header>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <button
                class="navbar-toggler"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#navbarExample01"
                aria-controls="navbarExample01"
                aria-expanded="false"
                aria-label="Toggle navigation"
                >
                <i class="fas fa-bars"></i>
                </button>
                @if(Auth::check())

                    @if(auth()->user())
                        <div class="collapse navbar-collapse" id="navbarExample01">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 pd-l ">
                            <li class="nav-item active ">
                            <a class="nav-link text-light" aria-current="page" href="/">Home</a>
                            </li>
                            <li class="nav-item active ">
                            <a class="nav-link text-light" aria-current="page" href="/edit-page">Profile</a>
                            </li>
                            <li class="nav-item active ">
                            <a class="nav-link text-light" aria-current="page" href="/users-follow">Follow</a>
                            </li>
                            <li class="nav-item active ">
                            <a class="nav-link text-light" aria-current="page" href="/users-follower">Follower</a>
                            </li>
                            <li class="nav-item active ">
                            <a class="nav-link text-light" aria-current="page" href="/users">Users</a>
                            </li>
                            <li class="nav-item active ">
                            <a class="nav-link text-light" aria-current="page" href="/favorite">Favorite</a>
                            </li>
                    @endif

                @endif   
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto pd-r">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item ">
                            <a class="nav-link self-color text-light " href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item ">
                                <a class="nav-link self-color text-light " href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item self-color" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
                </div>
            </div>
            </nav>
        </header>
            <!-- Navbar -->

        <main class="py-4">
            @yield('content')
            @yield('top')
        </main>
    </div>
</body>
</html>
