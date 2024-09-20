<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Token CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BoolBnB') }}</title>

    <link rel="icon" href="{{ asset('logo.ico') }}" type="image/x-icon">

    <!-- Font -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- TomTom Maps SDK (includi qui il CDN) -->
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.14.0/maps/maps-web.min.js"></script>
    <link rel="stylesheet" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.14.0/maps/maps.css">

    {{-- Jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">



    <!-- Script -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <!-- Include l'header -->
        @include('partials.header')
        <main class="py-4">
            @yield('content')
        </main>
        <!-- Include il footer -->
        @include('partials.footer')
    </div>

    @yield('custom-scripts')
</body>

</html>
