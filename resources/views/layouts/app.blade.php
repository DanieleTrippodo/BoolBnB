<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BoolBnB</title>
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

    <!-- Header -->
    <div class="header d-flex justify-content-between align-items-center">
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/Logo_BoolBnB_.png') }}" alt="BoolBnB Logo">
            </a>
        </div>
        <div>
            @auth
                <a href="{{ route('user.apartments.index') }}" class="btn">I tuoi Appartamenti</a>
                <a href="{{ route('user.apartments.create') }}" class="btn">Crea Appartamento</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn">Login</a>
                <a href="{{ route('register') }}" class="btn">Register</a>
            @endguest
        </div>
    </div>

    <!-- Main Content -->
    <main class="container my-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <div class="footer">
        {{-- PlaceHolder --}}
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
