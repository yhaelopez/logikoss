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
