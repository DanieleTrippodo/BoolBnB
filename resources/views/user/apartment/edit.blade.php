@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mx-auto">
                <div class="form-header-wrapper">
                    <h2 class="text-center form-header p-2">Modifica appartamento</h2>
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
                <!-- Aggiungiamo il div con bordo stondato e blu a sinistra -->
                <div id="big-card" class="card-body form-container">

                    <form action="{{ route('user.apartments.update', $apartment) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Titolo -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Titolo</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ old('title', $apartment->title) }}" required>
                        </div>

                        <!-- Numero di Stanze -->
                        <div class="mb-3">
                            <label for="rooms_num" class="form-label">Numero di Stanze</label>
                            <input type="number" class="form-control" id="rooms_num" name="rooms_num"
                                value="{{ old('rooms_num', $apartment->rooms_num) }}" required>
                        </div>

                        <!-- Numero di Letti -->
                        <div class="mb-3">
                            <label for="beds_num" class="form-label">Numero di Letti</label>
                            <input type="number" class="form-control" id="beds_num" name="beds_num"
                                value="{{ old('beds_num', $apartment->beds_num) }}" required>
                        </div>

                        <!-- Numero di Bagni -->
                        <div class="mb-3">
                            <label for="bathroom_num" class="form-label">Numero di Bagni</label>
                            <input type="number" class="form-control" id="bathroom_num" name="bathroom_num"
                                value="{{ old('bathroom_num', $apartment->bathroom_num) }}" required>
                        </div>

                        <!-- Metri Quadrati -->
                        <div class="mb-3">
                            <label for="sq_mt" class="form-label">Metri Quadrati</label>
                            <input type="number" class="form-control" id="sq_mt" name="sq_mt"
                                value="{{ old('sq_mt', $apartment->sq_mt) }}" required>
                        </div>

                        <!-- Indirizzo -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Indirizzo</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ old('address', $apartment->address) }}" required>
                        </div>

                        <!-- Immagine esistente -->
                        <div class="mb-3">
                            @if ($apartment->images)
                                <div>
                                    <label>Immagine Corrente:</label>
                                    <img src="{{ asset('storage/' . $apartment->images) }}" alt="Immagine Corrente"
                                        class="img-thumbnail" width="200">
                                </div>
                            @endif
                        </div>

                        <!-- Nuova Immagine -->
                        <div class="mb-3">
                            <label for="images" class="form-label">Nuova Immagine</label>
                            <input type="file" class="form-control" id="images" name="images">
                        </div>

                        <!-- Servizi Extra -->
                        <div class="mb-3">
                            <label for="extra_services" class="form-label">Servizi Extra</label>
                            <div class="form-check">
                                @foreach ($services as $service)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="extra_services[]"
                                            value="{{ $service->id }}" id="service-{{ $service->id }}"
                                            {{ in_array($service->id, old('extra_services', $apartment->extraServices->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="service-{{ $service->id }}">
                                            {{ $service->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Visibilità -->
                        <div class="mb-3">
                            <label for="visibility" class="form-label">Visibilità</label>
                            <select class="form-select" id="visibility" name="visibility">
                                <option value="1"
                                    {{ old('visibility', $apartment->visibility) == 1 ? 'selected' : '' }}>
                                    Visibile</option>
                                <option value="0"
                                    {{ old('visibility', $apartment->visibility) == 0 ? 'selected' : '' }}>
                                    Nascosto</option>
                            </select>
                        </div>

                        <!-- Pulsanti -->
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" value="Aggiorna">
                            <input type="reset" class="btn btn-secondary" value="Resetta">
                        </div>
                    </form>
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

    .form-header {
        font-size: 2rem;
        font-weight: bold;
        color: #1e88e5;
        margin-bottom: 1.5rem;
        text-align: center;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        background: linear-gradient(135deg, #1e88e5, #0a3d62);
        border-radius: 15px;
        color: white;
    }

    .container {
        margin-top: 2rem;
    }

    .form-container {
        background-color: #ffffff;
        border-radius: 1.5rem;
        padding: 2rem;
        box-shadow: 0 0.4rem 0.8rem rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        border-left: 0.5rem solid #1e88e5;
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

    .img-thumbnail {
        border-radius: 1rem;
        max-width: 200px;
    }

    #big-card {
        padding: 2rem;
    }
</style>
