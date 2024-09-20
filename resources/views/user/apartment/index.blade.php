@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="row">
            @if ($apartments->isEmpty())
                <div class="col-12 text-center">
                    <h3>Non hai appartamenti.</h3>
                    <a href="{{ route('user.apartments.create') }}" class="btn btn-success">Aggiungi un appartamento</a>
                </div>
            @else
                @foreach ($apartments as $apartment)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div id="cards" class="card mb-3 apartment-card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $apartment->title }}</h5>
                            </div>
                            <div id="conteiner-img" class="position-relative">
                                {{-- Contenitore per immagine e testo --}}
                                @if ($apartment->images)
                                    <img id="img-house" src="{{ asset('storage/' . $apartment->images) }}"
                                        alt="Apartment Image" class="img-thumbnail">
                                @endif

                                {{-- Scritta sponsorizzato all'interno dell'immagine --}}
                                @if ($apartment->sponsors && $apartment->sponsors->count() > 0)
                                    <p class="sponsor-label">SPONSORED</p>
                                @endif
                            </div>
                            <div class="card-footer">
                                <div class="btn-group" role="group"> {{-- Azioni per appartamento --}}
                                    <a id="btn-one" href="{{ route('user.apartments.show', $apartment->id) }}"
                                        class="btn btn-cr btn-primary me-1">Visualizza</a>
                                    <a id="btn-two" href="{{ route('user.apartments.edit', $apartment->id) }}"
                                        class="btn btn-cr btn-primary me-1">Modifica</a>

                                    <form action="{{ route('user.apartments.destroy', $apartment->id) }}" method="POST"
                                        style="display:inline;" class="apartment-form-delete"
                                        data-apartment-name="{{ $apartment->title }}">
                                        @csrf
                                        @method('DELETE')
                                        <button id="btn-three" type="submit" class="btn btn-cr btn-danger"
                                            id="btn-danger">Elimina</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

{{-- new dev --}}
@section('custom-scripts')
    @vite('resources/js/delete-confirm.js')
@endsection

<style>
    body {
        background: linear-gradient(135deg, #f8f9fa, #ffc0cb, #0a3d62);
        font-family: 'Roboto', sans-serif;
        color: #333;
        height: auto;
    }

    .apartment-card {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
    }

    #cards {
        border-radius: 20px;
    }

    #img-house {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;
    }

    .sponsor-label {
        position: absolute;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(255, 215, 0, 0.8);
        padding: 5px 10px;
        border-radius: 15px;
        font-weight: bold;
        color: white;
    }

    .card-body {
        text-align: center;

        h5 {
            color: #0a3d62;
            font-weight: bolder;
            font-size: 1.4rem;
        }
    }

    .card-footer {
        display: flex;
    }

    #conteiner-img {
        position: relative;
        height: 15rem;
        border-radius: 20px;
    }

    .btn-cr {
        padding: 0.5rem 1rem;
        text-align: center;
        border-radius: 15px;
        min-width: 120px;
    }

    .btn-group {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        justify-content: center;
    }

    #btn-two {
        background-color: goldenrod;
    }

    #btn-one,
    #btn-two,
    #btn-three {
        border-radius: 10px;
        padding: 0.5rem 1rem;
        background-color: #0a3d62;
        color: white;
        border: none;
        font-weight: bold;
        text-transform: uppercase;
        transition: background-color 0.3s ease, transform 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    #btn-one:hover,
    #btn-two:hover,
    #btn-three:hover {
        background-color: #ff5733;
        transform: translateY(-3px);
    }

    #btn-one:active,
    #btn-two:active,
    #btn-three:active {
        background-color: #c13e27;
        transform: translateY(0);
    }
</style>
