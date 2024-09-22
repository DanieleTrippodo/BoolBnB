@extends('layouts.admin')

@section('content')

    <div class="container mt-4 p-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-header-wrapper">
                    <h2 class="text-center form-header">Crea appartamento</h2>
                </div>
            </div>

            @if ($errors->any())
                <div class="col-8">
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="col-md-8">
                <form id="apartment-form" action="{{ route('user.apartments.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="rooms_num" class="form-label">Numero di Stanze</label>
                        <input type="number" class="form-control" id="rooms_num" name="rooms_num"
                            value="{{ old('rooms_num') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="beds_num" class="form-label">Numero di Letti</label>
                        <input type="number" class="form-control" id="beds_num" name="beds_num"
                            value="{{ old('beds_num') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="bathroom_num" class="form-label">Numero di Bagni</label>
                        <input type="number" class="form-control" id="bathroom_num" name="bathroom_num"
                            value="{{ old('bathroom_num') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="sq_mt" class="form-label">Metri Quadrati</label>
                        <input type="number" class="form-control" id="sq_mt" name="sq_mt" value="{{ old('sq_mt') }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Indirizzo</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ old('address') }}" required>
                        <ul id="suggestions-list">
                        </ul>
                    </div>

                    <div class="mb-3">
                        <label for="images" class="form-label">Immagine</label>
                        <input type="file" class="form-control" id="images" name="images"
                            value="{{ old('images') }}">
                    </div>

                    <div class="mb-3">
                        <label for="extra_services" class="form-label">Servizi Extra</label>
                        <div id="error-message" class="alert alert-danger" style="display: none;">
                        </div>
                        <div class="form-check">
                            @foreach ($services as $service)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extra_services[]"
                                        value="{{ $service->id }}" id="service-{{ $service->id }}">
                                    <label class="form-check-label" for="service-{{ $service->id }}">
                                        {{ $service->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="visibility" class="form-label">Visibilità</label>
                        <select class="form-select" id="visibility" name="visibility">
                            <option value="1" {{ old('visibility') == 1 ? 'selected' : '' }}>Visibile</option>
                            <option value="0" {{ old('visibility') == 0 ? 'selected' : '' }}>Nascosto</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="Crea Appartamento">
                        <input type="reset" class="btn btn-secondary" value="Reset">
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection

@section('custom-scripts')
    @vite('resources/js/delete-confirm.js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('apartment-form');
            const errorMessage = document.getElementById('error-message');
            form.addEventListener('submit', function(event) {
                const checkedServices = document.querySelectorAll('input[name="extra_services[]"]:checked');
                if (checkedServices.length < 2) {
                    event.preventDefault();
                    errorMessage.style.display = 'block';
                    errorMessage.textContent =
                        'Devi selezionare almeno 2 servizi extra per creare l\'appartamento.';
                } else {
                    errorMessage.style.display = 'none';
                }
            });
        });
    </script>
@endsection
<style>
    body {
        background: linear-gradient(135deg, #f8f9fa, #ffc0cb, #0a3d62);
        font-family: 'Roboto', sans-serif;
        color: #333;
    }

    .container {
        margin-top: 2rem;
    }

    form {
        background-color: #ffffff;
        border-radius: 1.5rem;
        padding: 2rem;
        box-shadow: 0 0.4rem 0.8rem rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        border-left: 0.5rem solid #1e88e5;
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

    .form-control,
    .form-select {
        border-radius: 1rem;
        padding: 1.2rem;
        font-size: 1rem;
        border: 1px solid #ddd;
        transition: all 0.3s ease-in-out;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #1e88e5;
        box-shadow: 0 0 0.3rem rgba(30, 136, 229, 0.5);
    }

    .btn-primary {
        background-color: #1e88e5;
        border: none;
        padding: 1rem 1.5rem;
        border-radius: 1rem;
        font-size: 1rem;
        transition: background-color 0.3s ease-in-out;
        margin-right: 1rem;
    }

    .btn-primary:hover {
        background-color: #1565c0;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        padding: 1rem 1.5rem;
        border-radius: 1rem;
        font-size: 1rem;
        transition: background-color 0.3s ease-in-out;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .alert-danger {
        border-radius: 1rem;
        padding: 1.5rem;
        font-size: 1rem;
    }
</style>
