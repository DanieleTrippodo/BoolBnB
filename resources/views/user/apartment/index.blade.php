@extends('layouts.admin')

@section('content')



<div class="container">
    <div class="row justify-content-center">


        <table class="table table-striped table-hover">
            <thead>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Technology</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>URL</th>
                    <th>Programming Language</th>
                    <th>Img</th>
                    <th>Actions</th>
                </tr>
            </thead>


            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->type->name }}</td>

                    <td>
                        @forelse ($project->technologies as $technology)
                            {{ $technology->name }}
                        @empty
                            No technologies.
                        @endforelse


                   </td>


                    <td>{{ $project->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->url }}</td>
                    <td>{{ $project->programming_language }}</td>
                    <td> <div class="image">
                        <img src="{{ asset('storage/' . $project->updated_on) }}" alt="" class="img-fluid w-25">
                    </div>
                    </td>
                    <td class="">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-info me-1">Show</a>
                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-primary me-1">Edit</a>
                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>

                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>


</div>


@endsection
