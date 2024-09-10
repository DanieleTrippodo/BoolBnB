@extends('layouts.app')

@section('content')
    <h1>Appartamenti Disponibili</h1>


    {{-- Ricerca appartamento --}}
    <form action="{{ route('guest.search') }}" method="GET">
        <label for="location">Posizione:</label>
        <input type="text" name="location" id="location" placeholder="Inserisci città...">

        <label for="min_price">Prezzo Minimo:</label>
        <input type="number" name="min_price" id="min_price" placeholder="Prezzo minimo...">


        <label for="rooms_num">Numero di Stanze:</label>
        <input type="number" name="rooms_num" id="rooms_num" placeholder="Minimo numero di stanze...">

        <button type="submit">Cerca</button>
    </form>


    @if($apartments->isEmpty())
    <p>Nessun appartamento trovato.</p>
    @else
        <ul>
            @foreach ($apartments as $apartment)
                <li>
                    <a href="{{ route('guest.show', $apartment->id) }}">{{ $apartment->title }}</a>
                </li>
            @endforeach
        </ul>
    @endif



@endsection
