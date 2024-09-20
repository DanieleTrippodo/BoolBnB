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
                        <div class="card mb-3 apartment-card">
                            <div id="conteiner-img">
                                @if ($apartment->images)
                                    <img id="img-house" src="{{ asset('storage/' . $apartment->images) }}"
                                        alt="Apartment Image" class="img-thumbnail">
                                @endif
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">{{ $apartment->title }}</h5>
                            </div>

                            <div class="card-footer">
                                <div class="btn-group" role="group"> {{-- Azioni per appartamento --}}
                                    <a href="{{ route('user.apartments.show', $apartment->id) }}"
                                        class="btn btn-cr btn-primary me-1">Visualizza</a>
                                    <a href="{{ route('user.apartments.edit', $apartment->id) }}"
                                        class="btn btn-cr btn-primary me-1">Modifica</a>

                                    <form action="{{ route('user.apartments.destroy', $apartment->id) }}" method="POST"
                                        style="display:inline;" class="apartment-form-delete"
                                        data-apartment-name="{{ $apartment->title }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-cr btn-danger"
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

    #img-house {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .card-footer {
        display: flex;
    }

    #conteiner-img {
        height: 15rem;
        border-radius:
    }

    .btn-cr {
        padding: 0.5rem 1rem;
        text-align: center;
        border-radius: 0.5rem;
        min-width: 120px;
    }

    .btn-group {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        justify-content: center;
    }

    .btn-group .btn {
        flex-grow: 1;
    }
</style>
