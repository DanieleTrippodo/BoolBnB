@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3" style="width: 100%;">
                    <h3 class="card-title-1">{{ $apartment->title }}</h3>
                    <!-- Mostra l'immagine se esiste, altrimenti un'immagine di placeholder -->
                    @if ($apartment->images)
                        <img src="{{ asset('storage/' . $apartment->images) }}" alt="" class="img-fluid">
                    @else
                        <span style="font-size: 100%">&#9888;</span>
                    @endif

                    <div class="card-body">
                        <p class="card-text">
                            <strong>Indirizzo:</strong> {{ $apartment->address }}<br>
                            <strong>Stanze:</strong> {{ $apartment->rooms_num }}<br>
                            <strong>Letti:</strong> {{ $apartment->beds_num }}<br>
                            <strong>Bagni:</strong> {{ $apartment->bathroom_num }}<br>
                            <strong>Metri quadrati:</strong> {{ $apartment->sq_mt }} m²<br>

                        </p>
                    </div>


                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Visibilità:</strong>
                            @if ($apartment->visibility)
                                <span class="badge bg-success">Visibile</span>
                            @else
                                <span class="badge bg-danger">Nascosto</span>
                            @endif
                        </li>
                        <li class="list-group-item"><strong>Creato il:</strong>
                            {{ $apartment->created_at->format('d/m/Y H:i') }}</li>
                        <li class="list-group-item"><strong>Ultimo aggiornamento:</strong>
                            {{ $apartment->updated_at->format('d/m/Y H:i') }}</li>
                    </ul>

                    <!-- Sezione Servizi Extra -->
                    <div class="card-body-2">
                        <h5 class="card-title">Servizi Extra</h5>
                        @if ($apartment->extraServices->count() > 0)
                            <ul class="list-inline">
                                @foreach ($apartment->extraServices as $service)
                                    <li class="list-inline-item">
                                        <span id="service-span" class="badge">{{ $service->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Nessun servizio extra associato a questo appartamento.</p>
                        @endif
                    </div>
                    <hr>

                    <div class="card-body-3">
                        <a href="{{ route('user.apartments.index') }}" class="btn btn-secondary">Torna agli
                            appartamenti</a>
                        <a href="{{ route('user.apartments.edit', $apartment->id) }}" class="btn btn-primary">Modifica
                            appartamento</a>
                        <a href="{{ route('user.sponsorships.index', $apartment->id) }}"
                            class="btn btn-primary">Sponsorizza</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<style>
    body {
        background: linear-gradient(135deg, #f8f9fa, #ffc0cb, #0a3d62);
        font-family: 'Roboto', sans-serif;
        color: #333;
    }

    .card {
        border-radius: 20px !important;
        box-shadow: 0 0.4rem 0.8rem rgba(0, 0, 0, 0.1);
        padding: 2rem;
        background-color: white;
        border-left: 0.5rem solid #1e88e5;
        text-align: center;
    }

    .card-header {
        font-size: 1.5rem;
        font-weight: bold;
        color: #1e88e5;
        text-align: center;
    }

    .card-body-2 {
        justify-content: space-evenly;
        margin: 1rem;
    }

    .card-body-3 {
        display: flex;
        justify-content: space-evenly;
    }

    img {
        border-radius: 20px;
    }

    span {
        padding: .5rem !important;
    }

    .card-title-1 {
        font-size: 2rem;
        font-weight: bolder !important;
        color: #1e88e5;
        text-align: center;
        text-transform: uppercase;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        margin-bottom: 1rem;
    }

    #service-span {
        border: 4px solid #ccc;
        border-radius: 20px;
        color: black
    }
</style>
