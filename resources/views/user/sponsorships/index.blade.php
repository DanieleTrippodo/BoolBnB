@extends('layouts.admin')

@section('content')

<!-- Container per il messaggio di successo -->
@if (session('success'))
<div class="alert alert-success text-center" style="max-width: 500px; margin: 20px auto;">
    {{ session('success') }}
</div>

<!-- Aggiungi un meta tag per reindirizzare dopo 2 secondi -->
<meta http-equiv="refresh" content="2;url={{ route('user.apartments.index') }}" />
@endif


<div class="container d-flex justify-content-center align-items-center">




    @foreach ($sponsors as $sponsor)
        <div class="card text-center me-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"> {{ $sponsor->name }} </h5>
                <p class="card-text"> {{ $sponsor->duration }} H</p>
                <p class="card-text"> {{ $sponsor->cost }} &euro;</p>
                <a href="{{ route('token') }}" class="btn btn-success">Acquista</a>
            </div>
        </div>
    @endforeach
</div>
@endsection


{{-- <form action="{{ route('user.sponsorships.assign', $apartment->id) }}" method="POST">
    @csrf
    <!-- Passa l'id dello sponsor -->
    <input type="hidden" name="sponsor_id" value="{{ $sponsor->id }}">
    <button type="submit" class="btn btn-success">Acquista</button>
</form> --}}
