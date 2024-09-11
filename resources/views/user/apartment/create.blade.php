@extends('user.apartment.layouts.create-or-edit');

@section('page-title')
    Crea un nuovo appartamento
@endsection

@section('form-action')
    {{ route('user.apartments.store') }}
@endsection

@section('form-method')
    @method('POST')
@endsection
