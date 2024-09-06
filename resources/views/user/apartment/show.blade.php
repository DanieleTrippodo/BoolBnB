@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $project->name }}</div>
                <h2 style="background: {{ $project->type->color }}">{{ $project->type->name }} </h2>

                <div class="card-body">
                    <p>{{ $project->description }}</p>
                    <p>{{ $project->url }}</p>
                    <p>{{ $project->programming_language }}</p>
                    <p>{{ $project->type->name }}</p>
                    <p>@forelse ($project->technologies as $technology)
                        {{ $technology->name }}
                    @empty
                        No technologies.
                    @endforelse</p>
                    <div class="image">
                        <img src="{{ asset('storage/' . $project->updated_on) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
