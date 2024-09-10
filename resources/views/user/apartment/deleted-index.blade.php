@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        @foreach ($apartments as $apartment)
            <div class="col-md-4">
                <div class="card mb-3" style="width: 80%;">
                    @if ($apartment->images) {{-- Se è disponibile la foto dell'appartamento --}}
                        <img src="{{ asset('storage/' . $apartment->images) }}" class="card-img-top" alt="Missing">
                    @else
                        <img src="..." class="card-img-top" alt="Placeholder_Image"> {{-- Inserire immagine placeholder --}}
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $apartment->title }}</h5>
                    </div>

                    <div class="card-footer">
                        <div class="btn-group" role="group"> {{-- Azioni per appartamento --}}
                            <form action="{{ route('user.apartments.restore', $apartment->id) }}" method="POST" style="display:inline;" class="apartment-form-delete" data-apartment-name="{{ $apartment->title }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning">Ricrea</button>
                            </form>

                            <form action="{{ route('user.apartments.permanent.delete', $apartment->id) }}" method="POST" style="display:inline;" class="apartment-form-delete" data-apartment-name="{{ $apartment->title }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
