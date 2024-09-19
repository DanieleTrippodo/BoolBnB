@extends('layouts.admin')

@section('content')
<div class="container">
    @foreach ($sponsors as $sponsor)
        <div class="card" style="width: 18rem;">
            <div class="card-header">
            {{ $sponsor->name }}
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    {{ $sponsor->duration }} H
                </li>
                <li class="list-group-item">
                    {{ $sponsor->cost }} &euro;
                </li>
            </ul>
        </div>
    @endforeach
</div>
@endsection
