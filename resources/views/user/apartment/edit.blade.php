@extends('layouts.admin')

@section('content')

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
            <form action="{{ route('user.apartments.update', $apartment) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Titolo -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $apartment->title) }}" required>
                </div>

                <!-- Numero di Stanze -->
                <div class="mb-3">
                    <label for="rooms_num" class="form-label">Number of Rooms</label>
                    <input type="number" class="form-control" id="rooms_num" name="rooms_num" value="{{ old('rooms_num', $apartment->rooms_num) }}" required>
                </div>

                <!-- Numero di Letti -->
                <div class="mb-3">
                    <label for="beds_num" class="form-label">Number of Beds</label>
                    <input type="number" class="form-control" id="beds_num" name="beds_num" value="{{ old('beds_num', $apartment->beds_num) }}" required>
                </div>

                <!-- Numero di Bagni -->
                <div class="mb-3">
                    <label for="bathroom_num" class="form-label">Number of Bathrooms</label>
                    <input type="number" class="form-control" id="bathroom_num" name="bathroom_num" value="{{ old('bathroom_num', $apartment->bathroom_num) }}" required>
                </div>

                <!-- Metri Quadrati -->
                <div class="mb-3">
                    <label for="sq_mt" class="form-label">Square Meters</label>
                    <input type="number" class="form-control" id="sq_mt" name="sq_mt" value="{{ old('sq_mt', $apartment->sq_mt) }}" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <!-- L'input dell'indirizzo usa il vecchio valore del database come valore di default -->
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $apartment->address) }}" required>
                    <ul id="suggestions-list" style="list-style-type: none; padding: 0;"></ul>
                </div>


                <!-- Visualizza immagine esistente -->
                <div class="mb-3">
                    @if($apartment->images)
                        <div>
                            <label>Immagine:</label>
                            <img src="{{ asset('storage/' . $apartment->images) }}" alt="Current Image" class="img-thumbnail" width="200">
                        </div>
                    @endif
                </div>

                <!-- Campo di caricamento file per nuove immagini -->
                <div class="mb-3">
                    <label for="images" class="form-label">Nuova Immagine</label>
                    <input type="file" class="form-control" id="images" name="images">
                </div>

                <!-- Servizi Extra -->
                <div class="mb-3">
                    <label for="extra_services" class="form-label">Servizi Extra</label>
                    <div class="form-check">
                        @foreach($services as $service)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="extra_services[]" value="{{ $service->id }}" id="service-{{ $service->id }}"
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
                    <label for="visibility" class="form-label">Visibility</label>
                    <select class="form-select" id="visibility" name="visibility">
                        <option value="1" {{ old('visibility', $apartment->visibility) == 1 ? 'selected' : '' }}>Visible</option>
                        <option value="0" {{ old('visibility', $apartment->visibility) == 0 ? 'selected' : '' }}>Hidden</option>
                    </select>
                </div>

                <!-- Pulsanti -->
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Update">
                    <input type="reset" class="btn btn-secondary" value="Reset">
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
