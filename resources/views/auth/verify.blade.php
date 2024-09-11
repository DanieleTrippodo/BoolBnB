@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verifica il Tuo Indirizzo Email') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('Un nuovo link di verifica è stato inviato al tuo indirizzo email.') }}
                            </div>
                        @endif

                        {{ __('Prima di procedere, controlla la tua email per il link di verifica.') }}
                        {{ __('Se non hai ricevuto l\'email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('clicca qui per richiederne un altro') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
