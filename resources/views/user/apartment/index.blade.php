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
                    <div class="col-md-4">
                        <div class="card mb-3" style="width: 80%;">
                            @if($apartment->images)
                                <img src="{{ asset('storage/' . $apartment->images) }}" alt="Apartment Image" class="img-thumbnail" width="200">
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
