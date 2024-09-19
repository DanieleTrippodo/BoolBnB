@extends('layouts.admin')

@section('content')
<div class="container d-flex justify-content-center align-items-center">
    @foreach ($sponsors as $sponsor)
        <div class="card text-center me-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"> {{ $sponsor->name }} </h5>
                <p class="card-text"> {{ $sponsor->duration }} H</p>
                <p class="card-text"> {{ $sponsor->cost }} &euro;</p>
                <a href="#" class="btn btn-success">Acquista</a>
            </div>
        </div>
    @endforeach
</div>
@endsection
