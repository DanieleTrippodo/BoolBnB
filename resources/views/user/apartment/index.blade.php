@extends('layouts.admin')

@section('content'){{-- test2 --}}

@foreach ($apartments as $apartment)
    <<div class="card" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{ $apartment->title}}</h5>

        </div>



        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('user.apartments.show', $apartment->id) }}" class="btn btn-info me-1">Show</a>
            <a href="{{ route('user.apartments.edit', $apartment->id) }}" class="btn btn-primary me-1">Edit</a>
            <form action="{{ route('user.apartments.destroy', $apartment->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>

            </form>
        </div>
      </div>

@endforeach


@endsection
