<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script defer type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        @yield('defered-scripts')
        {{-- <script defer type="text/javascript" src="{{ asset('js/filepond.js') }}"></script> --}}

        <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
        {{-- <link type="text/css" rel="stylesheet" href="{{ asset('css/filepond.css') }}"> --}}

        @yield('css')
    </head>
    <body class="d-flex flex-column min-vh-100 bg-ccdl-light-gray">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-link">
                            <a class="nav-link" href="{{ route('users.index') }}">{{ __('users') }}</a>
                        </li>
                        <li class="nav-link">
                            <a class="nav-link" href="{{ route('posts.index') }}">{{ __('posts') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
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
        <main>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-9 ms-sm-auto col-lg-10 py-3 px-md-4">
                        @include('includes.messages')
                        @yield('main')
                    </div>

                </div>
            </div>
        </main>

        @yield('js')

    </body>
</html>
