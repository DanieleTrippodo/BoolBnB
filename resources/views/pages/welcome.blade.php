<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BoolBnB</title>
    <link rel="icon" href="{{ asset('logo.ico') }}" type="image/x-icon">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* CSS per le card */
        .auth-cards {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 50px;
        }

        .card {
            width: 220px;
            height: 160px;
            background-color: #2C3857;
            border: 2px solid #21293D;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .card:hover {
            transform: scale(1.1) rotate(1deg);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        }

        .card-link {
            display: block;
            text-decoration: none;
            color: inherit;
            height: 100%;
            position: relative;
            z-index: 2;
        }

        .card-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            z-index: 2;
        }

        .card h3 {
            font-size: 1.6rem;
            color: #E1DD9F;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #394C85, #32759E);
            z-index: 1;
            opacity: 0.8;
            transition: opacity 0.4s ease;
        }

        .card:hover::before {
            opacity: 1;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background-color: #21293D;
            color: #E1DD9F;
            margin: 0;
            padding: 0;
        }

        /* Flex container styling */
        .relative {
            position: relative;
        }

        .sm\:flex {
            display: flex;
        }

        .sm\:justify-center {
            justify-content: center;
        }

        .sm\:items-center {
            align-items: center;
        }

        .min-h-screen {
            min-height: 100vh;
        }

        .bg-dots-darker {
            background: #2C3857;
        }

        .selection\:bg-red-500::selection {
            background-color: #E1DD9F;
        }

        .selection\:text-white::selection {
            color: #21293D;
        }
    </style>

</head>

<body>
    <!-- Sezione delle card -->
    <div class="auth-cards">
        <div class="card">
            <a href="{{ route('login') }}" class="card-link">
                <div class="card-content">
                    <h3>Accedi</h3>
                </div>
            </a>
        </div>
        <div class="card">
            <a href="{{ route('register') }}" class="card-link">
                <div class="card-content">
                    <h3>Registrati</h3>
                </div>
            </a>
        </div>
    </div>
    </div>
</body>

</html>
