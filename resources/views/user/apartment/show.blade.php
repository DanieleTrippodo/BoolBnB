@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3" style="width: 100%;">
                    <!-- Mostra l'immagine se esiste, altrimenti un'immagine di placeholder -->
                    @if ($apartment->images)
                        <img src="{{ asset('storage/' . $apartment->images) }}"
                            alt="" class="img-fluid">
                    @else
                        <span style="font-size: 100%">&#9888;</span>
                    @endif

                    <div class="card-body">
                        <h3 class="card-title">{{ $apartment->title }}</h3>
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
                    <div class="card-body">
                        <h5 class="card-title">Servizi Extra</h5>
                        @if ($apartment->extraServices->count() > 0)
                            <ul class="list-inline">
                                @foreach ($apartment->extraServices as $service)
                                    <li class="list-inline-item">
                                        <span class="badge bg-primary">{{ $service->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Nessun servizio extra associato a questo appartamento.</p>
                        @endif
                    </div>

                    <div class="card-body">
                        <a href="{{ route('user.apartments.index') }}" class="btn btn-secondary">Torna agli
                            appartamenti</a>
                        <a href="{{ route('user.apartments.edit', $apartment->id) }}" class="btn btn-primary">Modifica
                            appartamento</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
