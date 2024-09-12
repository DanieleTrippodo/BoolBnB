@extends('layouts.app')

@section('content')

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

    /* A-side (barra laterale) */
    .a-side {
        background-color: var(--color-primary);
        color: var(--color-text-light);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .a-side h5 {
        color: var(--color-text-light);
    }

    .a-side label {
        color: var(--color-text-light);
    }

    .a-side input, .a-side select {
        background-color: var(--color-background);
        color: var(--color-primary);
        border: 1px solid var(--color-secondary);
        border-radius: 5px;
    }

    .a-side button {
        background-color: var(--color-secondary);
        color: var(--color-text-light);
        border: none;
        border-radius: 5px;
        padding: 10px;
        width: 100%;
    }

    .a-side button:hover {
        background-color: var(--color-primary);
    }

    /* Stile delle card degli appartamenti */
    .card {
        background-color: var(--color-background);
        border: 1px solid var(--color-primary);
        border-radius: 8px;
        overflow: hidden;
    }

    .card h5 {
        color: var(--color-primary);
    }

    .card-footer {
        background-color: var(--color-background);
    }

    .card-footer .btn {
        background-color: var(--color-primary);
        color: var(--color-text-light);
        border: none;
    }

    .card-footer .btn:hover {
        background-color: var(--color-secondary);
    }

    .card-footer .btn-danger {
        background-color: #dc3545;
    }

    .card-footer .btn-danger:hover {
        background-color: #c82333;
    }

    /* Titolo principale */
    .main-title {
        color: var(--color-primary);
        font-size: 2em;
        margin-bottom: 20px;
    }

</style>

<div class="container mt-4">
    <div class="row">
        <!-- A-side (barra laterale per la ricerca e i filtri) -->
        <aside class="col-md-3 a-side">
            <h5>Ricerca Appartamenti</h5>
            <form action="{{ route('guest.search') }}" method="GET">
                <div class="mb-3">
                    <label for="location">Posizione</label>
                    <input type="text" name="location" id="location" class="form-control" placeholder="Inserisci città...">
                </div>

                <div class="mb-3">
                    <label for="min_price">Prezzo Minimo</label>
                    <input type="number" name="min_price" id="min_price" class="form-control" placeholder="Prezzo minimo...">
                </div>

                <div class="mb-3">
                    <label for="rooms_num">Numero di Stanze</label>
                    <input type="number" name="rooms_num" id="rooms_num" class="form-control" placeholder="Minimo numero di stanze...">
                </div>

                <button type="submit">Cerca</button>
            </form>
        </aside>

        <!-- Contenuto principale (lista appartamenti) -->
        <div class="col-md-9">
            <h2 class="main-title">Appartamenti Disponibili</h2>

            <div class="row">
                @if($apartments->isEmpty())
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            Nessun appartamento trovato.
                        </div>
                    </div>
                @else
                    @foreach ($apartments as $apartment)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                @if ($apartment->images)
                                    <img src="{{ asset('storage/' . $apartment->images) }}" class="card-img-top" alt="Immagine mancante">
                                @else
                                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Immagine segnaposto">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $apartment->title }}</h5>
                                    <p class="card-text">{{ Str::limit($apartment->description, 100) }}</p>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('user.apartments.show', $apartment->id) }}" class="btn">Visualizza</a>
                                        <a href="{{ route('user.apartments.edit', $apartment->id) }}" class="btn">Modifica</a>

                                        <form action="{{ route('user.apartments.destroy', $apartment->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Elimina</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
