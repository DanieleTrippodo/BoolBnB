@extends('layouts.admin')

@section('content')

<!-- Container per il messaggio di conferma -->
@if (session('success'))
<div class="alert alert-info text-center" style="max-width: 500px; margin: 20px auto;">
    <!-- Nuovo messaggio di conferma -->
    Reindirizzamento alla pagina di pagamento</div>

<!-- Modifica il reindirizzamento verso http://localhost:5181/ -->
<meta http-equiv="refresh" content="1;url=http://localhost:5182/" />
@endif

<div class="container d-flex justify-content-center align-items-center">
    @foreach ($sponsors as $sponsor)
        <div class="card text-center me-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"> {{ $sponsor->name }} </h5>
                <p class="card-text"> Durata: {{ $sponsor->duration }} H</p>
                <p class="card-text"> Costo: {{ $sponsor->cost }} &euro;</p>

                <!-- Form per acquistare la sponsorizzazione -->
                <form action="{{ route('user.sponsorships.assign', $apartment->id) }}" method="POST">
                    @csrf
                    <!-- Passa l'id dello sponsor -->
                    <input type="hidden" name="sponsor_id" value="{{ $sponsor->id }}">
                    <button type="submit" class="btn btn-success">Acquista</button>
                </form>
            </div>
        </div>
    @endforeach
</div>

@endsection
