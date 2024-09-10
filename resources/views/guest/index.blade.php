@extends('layouts.app')

@section('content')
    <h1>Appartamenti Disponibili</h1>
    <ul>
        @foreach ($apartments as $apartment)
            <li>
                <a href="{{ route('guest.show', $apartment->id) }}">{{ $apartment->title }}</a>
            </li>
        @endforeach
    </ul>
@endsection
