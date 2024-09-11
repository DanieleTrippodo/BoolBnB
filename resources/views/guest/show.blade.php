@extends('layouts.app')

@section('content')
    <h1>{{ $apartment->title }}</h1>
    <p>Numero di Stanze: {{ $apartment->rooms_num }}</p>
    <p>Numero di Letti: {{ $apartment->beds_num }}</p>
    <p>Superficie: {{ $apartment->sq_mt }} m²</p>
    <p>Indirizzo: {{ $apartment->address }}</p>
@endsection
