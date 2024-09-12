@extends('layouts.app')

@section('content')
    <section class="container d-flex">
        <div id="apartment-list" class="row">
            <div class="col-3">
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
            </div>
        </div>

        <div id="apartment-list" class="row">
            <div class="col-9 d-flex flex-column">
                <div id="sponsorized" class="d-flex flex-wrap justify-content-around align-items-center">
                    @if($apartments->isEmpty())
                        <p>Nessun appartamento trovato.</p>
                    @else
                        @foreach ($apartments as $apartment)
                            <div class="card mb-3">
                                @if ($apartment->images)
                                    {{-- Se è disponibile la foto dell'appartamento --}}
                                    <img src="{{ asset('storage/' . $apartment->images) }}" class="card-img-top"
                                        alt="Immagine mancante">
                                @else
                                    <img src="..." class="card-img-top" alt="Immagine segnaposto"> {{-- Inserire immagine placeholder --}}
                                @endif

                                <div class="card-body">
                                    <h5 class="card-title">{{ $apartment->title }}</h5>
                                </div>

                                <div class="card-footer">
                                    <div class="btn-group" role="group"> {{-- Azioni per appartamento --}}
                                        <a href="{{ route('user.apartments.show', $apartment->id) }}"
                                            class="btn btn-primary me-1">Visualizza</a>
                                        <a href="{{ route('user.apartments.edit', $apartment->id) }}"
                                            class="btn btn-primary me-1">Modifica</a>

                                        <form action="{{ route('user.apartments.destroy', $apartment->id) }}" method="POST" style="display:inline;" class="apartment-form-delete" data-apartment-name="{{ $apartment->title }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Elimina</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div id="unsponsorized" class="d-flex flex-wrap justify-content-around align-items-center">
                    @if($apartments->isEmpty())
                        <p>Nessun appartamento trovato.</p>
                    @else
                        @foreach ($apartments as $apartment)
                            <div class="card mb-3">
                                @if ($apartment->images)
                                    {{-- Se è disponibile la foto dell'appartamento --}}
                                    <img src="{{ asset('storage/' . $apartment->images) }}" class="card-img-top"
                                        alt="Immagine mancante">
                                @else
                                    <img src="..." class="card-img-top" alt="Immagine segnaposto"> {{-- Inserire immagine placeholder --}}
                                @endif

                                <div class="card-body">
                                    <h5 class="card-title">{{ $apartment->title }}</h5>
                                </div>

                                <div class="card-footer">
                                    <div class="btn-group" role="group"> {{-- Azioni per appartamento --}}
                                        <a href="{{ route('user.apartments.show', $apartment->id) }}"
                                            class="btn btn-primary me-1">Visualizza</a>
                                        <a href="{{ route('user.apartments.edit', $apartment->id) }}"
                                            class="btn btn-primary me-1">Modifica</a>

                                        <form action="{{ route('user.apartments.destroy', $apartment->id) }}" method="POST" style="display:inline;" class="apartment-form-delete" data-apartment-name="{{ $apartment->title }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Elimina</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

    </section>
@endsection
