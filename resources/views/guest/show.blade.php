<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli Appartamento - BoolBnB</title>
    <style>
        /* Palette di colori */
        :root {
            --color-dark: #21293D;
            --color-medium-dark: #2C3857;
            --color-blue-dark: #394C85;
            --color-blue: #32759E;
            --color-light: #E1DD9F;
        }

        body {
            background-color: var(--color-dark);
            color: var(--color-light);
            font-family: 'Arial', sans-serif;
        }

        .header {
            background-color: var(--color-medium-dark);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header a {
            color: var(--color-light);
            text-decoration: none;
            font-size: 16px;
            padding: 10px 20px;
            background-color: var(--color-blue);
            border-radius: 5px;
            margin-left: 10px;
        }

        .header a:hover {
            background-color: var(--color-blue-dark);
        }

        .header .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .container {
            padding: 20px;
        }

        .apartment-details {
            background-color: var(--color-blue-dark);
            padding: 20px;
            border-radius: 10px;
        }

        .apartment-details h2 {
            color: var(--color-light);
        }

        .apartment-details p {
            font-size: 18px;
        }
    </style>
</head>
<body>

    {{-- <div class="header">
        <div class="logo">
            <a href="/">BoolBnB</a>
        </div>
        <div class="nav">
            @auth
                <a href="/apartments">I tuoi Appartamenti</a>
            @endauth
            @guest
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            @endguest
        </div>
    </div> --}}


    {{-- Da fixare con i nomi giusti per titolo servizi ecc  DANIELE--}}

    <div class="container">
        <div class="apartment-details">
            <h2>{{ $apartment->title }}</h2>
            <p><strong>Città:</strong> {{ $apartment->city }}</p>
            <p><strong>Prezzo:</strong> €{{ $apartment->price }}</p>

            <!-- Gestione sicura dei servizi -->
            <p><strong>Servizi:</strong>
                @if(is_array($apartment->services) && count($apartment->services) > 0)
                    {{ implode(', ', $apartment->services) }}
                @else
                    Nessun servizio disponibile.
                @endif
            </p>

            <p><strong>Descrizione:</strong> {{ $apartment->description }}</p>
        </div>
    </div>


</body>
</html>
