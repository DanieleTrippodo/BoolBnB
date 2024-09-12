<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BoolBnB</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Small_Logo.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Nuova palette di colori */
        :root {
            --color-background: #fefbfa;
            --color-primary: #003f6c;
            --color-secondary: #a34a62;
            --color-text-light: #ffffff;
        }

        body {
            background-color: var(--color-background);
            color: var(--color-primary);
        }

        /* Header */
        .header {
            background-color: var(--color-primary);
            padding: 20px;
            color: var(--color-text-light);
        }

        .header .logo img {
            height: 50px;
        }

        .header a {
            color: var(--color-text-light);
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: var(--color-primary);
            transition: background-color 0.3s ease;
        }

        .header a:hover {
            background-color: var(--color-secondary);
        }

        /* Footer */
        /* .footer {
            background-color: var(--color-primary);
            padding: 20px;
            text-align: center;
            color: var(--color-text-light);
        }

        .footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        .footer a {
            color: var(--color-text-light);
            text-decoration: none;
        }

        .footer a:hover {
            color: var(--color-secondary);
        } */
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- Nome del sito che punta alla home (guest.index) -->
                <a class="navbar-brand" href="{{ route('guest.index') }}">
                    {{ config('app.name', 'BoolBnB') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Lato sinistro della navbar -->
                    <ul class="navbar-nav me-auto">
                        <!-- Mostra il link "I tuoi appartamenti" solo se l'utente è autenticato -->
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.apartments.index') }}">I tuoi appartamenti</a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Lato destro della navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Link di autenticazione -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <!-- Mostra l'email o nome utente -->
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name ?? Auth::user()->email}}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Esci') }}
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
