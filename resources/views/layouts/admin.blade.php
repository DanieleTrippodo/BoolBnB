<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Token CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title')</title>

    <!-- Font -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- TomTom Maps SDK (includi qui il CDN) -->
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.14.0/maps/maps-web.min.js"></script>
    <link rel="stylesheet" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.14.0/maps/maps.css">

    <!-- includes the Braintree JS client SDK -->
    <script src="https://js.braintreegateway.com/web/dropin/1.43.0/js/dropin.min.js"></script>
    <!-- includes jQuery -->
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        @include('partials.header')

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @yield('custom-scripts')
</body>

</html>
