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

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $apartment->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="rooms_num" class="form-label">Number of Rooms</label>
                    <input type="number" class="form-control" id="rooms_num" name="rooms_num" value="{{ old('rooms_num', $apartment->rooms_num) }}" required>
                </div>

                <div class="mb-3">
                    <label for="beds_num" class="form-label">Number of Beds</label>
                    <input type="number" class="form-control" id="beds_num" name="beds_num" value="{{ old('beds_num', $apartment->beds_num) }}" required>
                </div>

                <div class="mb-3">
                    <label for="bathroom_num" class="form-label">Number of Bathrooms</label>
                    <input type="number" class="form-control" id="bathroom_num" name="bathroom_num" value="{{ old('bathroom_num', $apartment->bathroom_num) }}" required>
                </div>

                <div class="mb-3">
                    <label for="sq_mt" class="form-label">Square Meters</label>
                    <input type="number" class="form-control" id="sq_mt" name="sq_mt" value="{{ old('sq_mt', $apartment->sq_mt) }}" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $apartment->address) }}" required>
                </div>

                <div class="mb-3">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $apartment->latitude) }}" required>
                </div>

                <div class="mb-3">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $apartment->longitude) }}" required>
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label">Images</label>
                    <input type="text" class="form-control" id="images" name="images" value="{{ old('images', $apartment->images) }}">
                </div>

                <div class="mb-3">
                    <label for="visibility" class="form-label">Visibility</label>
                    <select class="form-select" id="visibility" name="visibility">
                        <option value="1" {{ old('visibility', $apartment->visibility) == 1 ? 'selected' : '' }}>Visible</option>
                        <option value="0" {{ old('visibility', $apartment->visibility) == 0 ? 'selected' : '' }}>Hidden</option>
                    </select>
                </div>

                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Update">
                    <input type="reset" class="btn btn-secondary" value="Reset">
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
