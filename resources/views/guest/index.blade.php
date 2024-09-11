<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BoolBnB - Guest</title>
</head>


<body>

    <div class="header">

        <div class="logo">
            {{-- href non funziona, non capisco perchè.. --}}
            <img src="{{ asset('img/Logo_BoolBnB_.png') }}" href="/home" alt="BoolBnB_Logo" style="height: 5rem;">
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
    </div>

    <div class="container">
        <!-- A-side (barra laterale per la ricerca e i filtri) -->
        <div class="aside">
            <h4>Ricerca</h4>
            <form action="">
                <label for="city">Città:</label>
                <input type="text" id="city" name="city" placeholder="Inserisci città...">

                <label for="max_price">Prezzo Massimo:</label>
                <input type="number" id="max_price" name="max_price" placeholder="Prezzo massimo...">

                <label for="services">Servizi Disponibili:</label>
                <select id="services" name="services">
                    <option value="wifi">Wi-Fi</option>
                    <option value="parking">Parcheggio</option>
                    <option value="pool">Piscina</option>
                    <option value="air_conditioning">Aria condizionata</option>
                </select>

                <button type="submit" style="background-color: var(--color-blue); padding: 10px; color: var(--color-light); border: none; border-radius: 5px;">Cerca</button>
            </form>
        </div>


        <!-- Body principale per ora è solo un placeholder! -->
        <div class="content">
            <div class="placeholder">
                <h2>Elenco appartamenti</h2>
                <p>Qui saranno mostrati gli appartamenti...</p>
            </div>
        </div>
        {{-- Aggiungere altro in futuro... --}}





    </div>

</body>



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

    .aside {
        background-color: var(--color-medium-dark);
        padding: 20px;
        width: 16rem;
        height: 100vh;
        padding-right: 2.4rem;
    }

    .aside h4 {
        margin-bottom: 20px;
    }

    .aside label {
        display: block;
        margin-bottom: 10px;
    }

    .aside input, .aside select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: none;
        border-radius: 5px;
    }

    .content {
        flex: 1;
        padding: 20px;
    }

    .container {
        display: flex;
    }

    .placeholder {
        background-color: var(--color-blue-dark);
        padding: 50px;
        text-align: center;
        border-radius: 10px;
    }

    .placeholder h2 {
        color: var(--color-light);
    }
</style>
</html>
