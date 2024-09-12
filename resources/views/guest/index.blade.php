@extends('layouts.app')

@section('content')
    <h1>Appartamenti Disponibili</h1>

    {{-- Ricerca appartamento --}}
    <form id="search-form">
        <label for="location">Posizione:</label>
        <input type="text" name="location" id="location" placeholder="Inserisci città...">

        {{-- <label for="min_price">Prezzo Minimo:</label>
        <input type="number" name="min_price" id="min_price" placeholder="Prezzo minimo...">

        <label for="rooms_num">Numero di Stanze:</label>
        <input type="number" name="rooms_num" id="rooms_num" placeholder="Minimo numero di stanze..."> --}}

        {{-- Il bottone di ricerca è stato rimosso --}}
    </form>

    <ul id="apartment-list">
        @if($apartments->isEmpty())
            <p>Nessun appartamento trovato.</p>
        @else
            @foreach ($apartments as $apartment)
                <li>
                    <a href="{{ route('guest.show', $apartment->id) }}">{{ $apartment->title }}</a>
                </li>
            @endforeach
        @endif
    </ul>

@endsection
