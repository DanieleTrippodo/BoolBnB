@extends('user.apartment.layouts.create-or-edit')

@section('page-title')
    Modifica {{ $apartment->title }}
@endsection

@section('form-action')
    {{ route('user.apartments.update', $apartment) }}
@endsection

@section('form-method')
    @method('PUT')
@endsection
