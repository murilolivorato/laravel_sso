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

    <!-- Styles -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bulma/bulma-rtl.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="columns">
        <div class="column is-6 form-area">
            <div class="columns logo-area">
                <div class="column has-text-centered">
                    <div id="logo"><h1><a href="#"  >SIGO JHE</a></h1></div>
                </div>
            </div>
            @yield('content')
        </div>
        <div class="interactive-bg column is-6">
            <div class="container">
            </div>
        </div>
    </div>
</div>
</body>
</html>
