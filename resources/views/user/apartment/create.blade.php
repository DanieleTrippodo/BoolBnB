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
            </div>
        @endif




        <div class="col-md-8">





        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Project Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Project Description</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}">
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">Project URL</label>
                <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}">
            </div>

            <div class="mb-3">
                <label for="type_id" class="form-label">Project Type</label>
                <select class="form-select" id="type_id" name="type_id">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="technology_id" class="form-label">Technology</label>


                    @foreach($technologies as $technology)

                    <input name="technologies[]" type="checkbox" class="btn-check" id="tech-check-{{ $technology->id}}" autocomplete="off" value="{{ $technology->id }}">
                    <label class="btn btn-outline-primary" for="tech-check-{{ $technology->id}}">

                        {{ $technology->name }}

                    </label>
                    @endforeach

            </div>

            <div class="mb-3">
                <label for="programming_language" class="form-label">Programming Language</label>
                <input type="text" class="form-control" id="programming_language" name="programming_language" value="{{ old('programming_language') }}">
            </div>

            <div class="mb-3">
                <label for="updated_on" class="form-label">Updated On</label>
                <input type="file" class="form-control" id="updated_on" name="updated_on" value="{{ $project->updated_on }}">
            </div>


            <div class="mb-3">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary" value="Reset">
            </div>

        </form>


        </div>
    </div>
</div>

@endsection
