@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 100%;">
                <!-- Mostra l'immagine se esiste, altrimenti un'immagine di placeholder -->
                @if($apartment->images)
                <img src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->title }} project image" class="img-fluid">
                @else
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image Available">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $apartment->title }}</h5>
                    <p class="card-text">
                        Indirizzo: {{ $apartment->address }}<br>
                        Stanze: {{ $apartment->rooms_num }}<br>
                        Letti: {{ $apartment->beds_num }}<br>
                        Bagni: {{ $apartment->bathroom_num }}<br>
                        Metri quadrati: {{ $apartment->sq_mt }} m²<br>
                        Latitude: {{ $apartment->latitude }}<br>
                        Longitude: {{ $apartment->longitude }}<br>
                    </p>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Visibilità:
                        @if($apartment->visibility)
                            <span class="badge bg-success">Visibile</span>
                        @else
                            <span class="badge bg-danger">Nascosto</span>
                        @endif
                    </li>
                    <li class="list-group-item">Creato il: {{ $apartment->created_at->format('d/m/Y H:i') }}</li>
                    <li class="list-group-item">Ultimo aggiornamento: {{ $apartment->updated_at->format('d/m/Y H:i') }}</li>
                </ul>

                <div class="card-body">
                    <a href="{{ route('user.apartments.index') }}" class="card-link">Torna agli appartamenti</a>
                    <a href="{{ route('user.apartments.edit', $apartment->id) }}" class="card-link">Modifica appartamento</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
