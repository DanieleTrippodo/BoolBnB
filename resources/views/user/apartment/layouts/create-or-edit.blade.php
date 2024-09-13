@extends('layouts.app')

@section('content')

<style>
    /* Nuova palette di colori */
    :root {
        --color-background: #fefbfa;
        --color-primary: #003f6c;
        --color-secondary: #a34a62;
        --color-text-light: #ffffff;
    }

    body {
        background-color: var(--color-background);
        color: var(--color-primary);
    }

    .form-control {
        background-color: var(--color-background);
        color: var(--color-primary);
        border: 1px solid var(--color-secondary);
        border-radius: 5px;
    }

    .form-control:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 5px rgba(0, 63, 108, 0.5);
    }

    label {
        color: var(--color-primary);
    }

    .btn-primary {
        background-color: var(--color-primary);
        color: var(--color-text-light);
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .btn-primary:hover {
        background-color: var(--color-secondary);
    }

    .btn-secondary {
        background-color: var(--color-secondary);
        color: var(--color-text-light);
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
    }

</style>

<div class="container">
    <div class="row justify-content-center">

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
            <form action="{{ route('user.apartments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label for="rooms_num" class="form-label">Numero di Stanze</label>
                    <input type="number" class="form-control" id="rooms_num" name="rooms_num" value="{{ old('rooms_num') }}" required>
                </div>

                <div class="mb-3">
                    <label for="beds_num" class="form-label">Numero di Letti</label>
                    <input type="number" class="form-control" id="beds_num" name="beds_num" value="{{ old('beds_num') }}" required>
                </div>

                <div class="mb-3">
                    <label for="bathroom_num" class="form-label">Numero di Bagni</label>
                    <input type="number" class="form-control" id="bathroom_num" name="bathroom_num" value="{{ old('bathroom_num') }}" required>
                </div>

                <div class="mb-3">
                    <label for="sq_mt" class="form-label">Metri Quadrati</label>
                    <input type="number" class="form-control" id="sq_mt" name="sq_mt" value="{{ old('sq_mt') }}" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Indirizzo</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                    <ul id="suggestions-list" style="list-style: none; padding: 0;"></ul>
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label">Immagine</label>
                    <input type="file" class="form-control" id="images" name="images" value="{{ old('images') }}">
                </div>

                <!-- Extra Services -->
                <div class="mb-3">
                    <label for="extra_services" class="form-label">Servizi Extra</label>
                    <div class="form-check">
                        @foreach($services as $service)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="extra_services[]" value="{{ $service->id }}" id="service-{{ $service->id }}">
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
    @vite('resources/js/autocomplete.js')
@endsection
