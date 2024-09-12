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

    /* Titolo principale */
    .main-title {
        color: var(--color-primary);
        font-size: 2em;
        margin-bottom: 20px;
    }

    /* Tabella degli appartamenti */
    .table {
        background-color: var(--color-background);
        border: 1px solid var(--color-primary);
        border-radius: 8px;
    }

    .table th {
        background-color: var(--color-primary);
        color: var(--color-text-light);
        border: none;
    }

    .table td {
        border: 1px solid var(--color-primary);
        color: var(--color-primary);
    }

    .table tbody tr:hover {
        background-color: var(--color-secondary);
        color: var(--color-text-light);
    }

    /* Bottoni */
    .btn-primary {
        background-color: var(--color-primary);
        color: var(--color-text-light);
        border: none;
        padding: 5px 15px;
        border-radius: 5px;
        margin-right: 10px;
    }

    .btn-primary:hover {
        background-color: var(--color-secondary);
    }

    .btn-danger {
        background-color: #dc3545;
        color: var(--color-text-light);
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .card {
        background-color: var(--color-background);
        border: 1px solid var(--color-primary);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .card h5 {
        color: var(--color-primary);
    }

</style>

<div class="container mt-4">
    <h2 class="main-title">I tuoi Appartamenti</h2>

    @if($apartments->isEmpty())
        <div class="alert alert-warning text-center">
            Nessun appartamento trovato.
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Titolo</th>
                    <th>Indirizzo</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($apartments as $apartment)
                    <tr>
                        <td>{{ $apartment->title }}</td>
                        <td>{{ $apartment->address }}</td>
                        <td>
                            <a href="{{ route('user.apartments.show', $apartment->id) }}" class="btn btn-primary">Visualizza</a>
                            <a href="{{ route('user.apartments.edit', $apartment->id) }}" class="btn btn-primary">Modifica</a>
                            <form action="{{ route('user.apartments.destroy', $apartment->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
