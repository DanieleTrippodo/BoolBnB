@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="col-md-8 mx-auto">
            <div class="form-header-wrapper">
                <h2 class="text-center form-header">I tuoi appartamenti</h2>
            </div>
        </div>

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
                                @if ($apartment->images)
                                    <img id="img-house" src="{{ asset('storage/' . $apartment->images) }}"
                                        alt="Apartment Image" class="img-thumbnail">
                                @endif

                                @if ($apartment->sponsors && $apartment->sponsors->count() > 0)
                                    <p class="sponsor-label">SPONSORIZZATO</p>
                                @endif
                            </div>
                            <div class="card-footer">
                                <div class="btn-group" role="group">
                                    <a id="btn-one" href="{{ route('user.apartments.show', $apartment->id) }}"
                                        class="btn btn-cr btn-primary me-1">Visualizza</a>
                                    <a id="btn-two" href="{{ route('user.apartments.edit', $apartment->id) }}"
                                        class="btn btn-cr btn-primary me-1">Modifica</a>
                                    <form id="delete-form-{{ $apartment->id }}"
                                        action="{{ route('user.apartments.destroy', $apartment->id) }}" method="POST"
                                        style="display:inline;" class="apartment-form-delete"
                                        data-apartment-name="{{ $apartment->title }}">
                                        @csrf
                                        @method('DELETE')
                                        <button id="btn-three" type="button" class="btn btn-cr btn-danger"
                                            onclick="confermaEliminazione('{{ $apartment->id }}', '{{ $apartment->title }}')">Elimina</button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confermaEliminazione(id, title) {
        Swal.fire({
            title: 'Sei sicuro?',
            text: "Stai per eliminare l'appartamento: " + title,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#002b4d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sì, elimina!',
            cancelButtonText: 'Annulla'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
    document.addEventListener('DOMContentLoaded', function() {
        const apartments = @json($apartments);
        document.body.classList.toggle('empty-apartments', apartments.length === 0);
    });
</script>

<style>
    body {
        background: linear-gradient(135deg, #f8f9fa, #ffc0cb, #0a3d62);
        font-family: 'Roboto', sans-serif;
        color: #333;
        height: auto;
    }

    .empty-apartments {
        height: 100%;
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

    #btn-three {
        background-color: red;
    }

    #btn-three:hover {
        transform: translateY(-3px);
    }

    #btn-one:hover,
    #btn-two:hover {
        background-color: #ac93a7;
        transform: translateY(-3px);
    }

    #btn-one:active,
    #btn-two:active,
    #btn-three:active {
        background-color: #c13e27;
        transform: translateY(0);
    }

    .form-header-wrapper {
        background: linear-gradient(135deg, #1e88e5, #0a3d62);
        border-radius: 1.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: .5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 0.4rem 0.8rem rgba(0, 0, 0, 0.1);
    }

    .form-header {
        font-size: 2rem;
        font-weight: bold;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    @media (max-width: 768px) {
        .form-header {
            font-size: 1.5rem;
        }

        .form-header-wrapper {
            padding: 0.5rem;
        }
    }
</style>
