@extends('layouts.app')

@section('content')

<style>
    /* Stile per il Jumbotron e le info */
    .jumbotron {
        background-color: var(--color-primary);
        color: var(--color-text-light);
        padding: 60px 30px;
        text-align: center;
        border-radius: 8px;
        margin-bottom: 30px;
    }

    .jumbotron h1 {
        font-size: 3em;
        margin-bottom: 20px;
    }

    .jumbotron p {
        font-size: 1.5em;
    }

    .info-section {
        padding: 40px 0;
        background-color: var(--color-background);
        color: var(--color-primary);
        text-align: center;
    }

    .info-section h2 {
        margin-bottom: 20px;
        font-size: 2.5em;
        color: var(--color-secondary);
    }

    .info-section p {
        font-size: 1.2em;
        margin-bottom: 10px;
    }

</style>

<div class="container mt-4">
    <!-- Jumbotron -->
    <div class="jumbotron">
        <h1>Benvenuto su BoolBnB!</h1>
        <p>Trova il tuo appartamento ideale con un semplice clic.</p>
        <a class="btn btn-secondary btn-lg" href="{{ route('guest.search') }}">Cerca appartamenti</a>
    </div>

    <!-- Informazioni aggiuntive -->
    <div class="info-section">
        <h2>Perché scegliere BoolBnB?</h2>
        <p>BoolBnB ti permette di trovare l'appartamento perfetto in qualsiasi città.</p>
        <p>Con filtri avanzati e opzioni per ogni esigenza, la tua prossima casa è a portata di clic.</p>
    </div>
</div>

@endsection
