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

        <div id="apartment-list" class="row">
            <div class="col-9 d-flex flex-column">
                <div id="sponsorized" class="d-flex flex-wrap justify-content-around align-items-center">
                    @if($apartments->isEmpty())
                        <p>Nessun appartamento trovato.</p>
                    @else
                        @foreach ($apartments as $apartment)
                            <div class="card mb-3">
                                @if ($apartment->images)
                                    {{-- Se è disponibile la foto dell'appartamento --}}
                                    <img src="{{ asset('storage/' . $apartment->images) }}" class="card-img-top"
                                        alt="Immagine mancante">
                                @else
                                    <img src="..." class="card-img-top" alt="Immagine segnaposto"> {{-- Inserire immagine placeholder --}}
                                @endif

                                <div class="card-body">
                                    <h5 class="card-title">{{ $apartment->title }}</h5>
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

                                <div class="card-footer">
                                    <div class="btn-group" role="group"> {{-- Azioni per appartamento --}}
                                        <a href="{{ route('user.apartments.show', $apartment->id) }}"
                                            class="btn btn-primary me-1">Visualizza</a>
                                        <a href="{{ route('user.apartments.edit', $apartment->id) }}"
                                            class="btn btn-primary me-1">Modifica</a>

                                        <form action="{{ route('user.apartments.destroy', $apartment->id) }}" method="POST" style="display:inline;" class="apartment-form-delete" data-apartment-name="{{ $apartment->title }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Elimina</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div id="unsponsorized" class="d-flex flex-wrap justify-content-around align-items-center">
                    @if($apartments->isEmpty())
                        <p>Nessun appartamento trovato.</p>
                    @else
                        @foreach ($apartments as $apartment)
                            <div class="card mb-3">
                                @if ($apartment->images)
                                    {{-- Se è disponibile la foto dell'appartamento --}}
                                    <img src="{{ asset('storage/' . $apartment->images) }}" class="card-img-top"
                                        alt="Immagine mancante">
                                @else
                                    <img src="..." class="card-img-top" alt="Immagine segnaposto"> {{-- Inserire immagine placeholder --}}
                                @endif

                                <div class="card-body">
                                    <h5 class="card-title">{{ $apartment->title }}</h5>
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
