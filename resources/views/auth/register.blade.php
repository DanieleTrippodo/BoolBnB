@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Intestazione del form -->
                <h2 class="text-center form-header">Registrazione</h2>

                <div class="card-body">
                    <form id="registerForm" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ old('name') }}" autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="surname" class="col-md-4 col-form-label text-md-end">{{ __('Cognome') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text"
                                    class="form-control @error('surname') is-invalid @enderror" name="surname"
                                    value="{{ old('surname') }}" autocomplete="surname" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="date_of_birth"
                                class="col-md-4 col-form-label text-md-end">{{ __('Data di nascita') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date" class="form-control" name="date_of_birth"
                                    value="{{ old('date_of_birth') }}" autocomplete="date_of_birth" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">
                                {{ __('Indirizzo Email') }} <span style="color: red;">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="Campo obbligatorio">
                                <span id="emailError" style="color: red; display: none;"></span>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">
                                {{ __('Password') }} <span style="color: red;">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password" placeholder="Campo obbligatorio">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">
                                {{ __('Conferma Password') }} <span style="color: red;">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Campo obbligatorio">
                                <span id="passwordMismatch" style="color: red; display: none;">Le password non
                                    coincidono.</span>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    body {
        background: linear-gradient(135deg, #f8f9fa, #ffc0cb, #0a3d62);
        font-family: 'Roboto', sans-serif;
        color: #333;
    }

    .form-header {
        font-size: 2rem;
        font-weight: bold;
        color: #1e88e5;
        margin-bottom: 1.5rem;
        text-align: center;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        background: linear-gradient(135deg, #1e88e5, #0a3d62);
        border-radius: 15px;
        color: white;
    }

    h2 {
        padding: .5rem;
    }

    .container {
        margin-top: 2rem;
    }

    .card-body form {
        background-color: #ffffff;
        border-radius: 1.5rem;
        padding: 2rem;
        box-shadow: 0 0.4rem 0.8rem rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        border-left: 0.5rem solid #1e88e5;
    }

    .form-control,
    .form-select {
        border-radius: 1rem;
        padding: 1.2rem;
        font-size: 1rem;
        border: 1px solid #ddd;
        transition: all 0.3s ease-in-out;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #1e88e5;
        box-shadow: 0 0 0.3rem rgba(30, 136, 229, 0.5);
    }

    .btn-primary {
        background-color: #1e88e5;
        border: none;
        padding: 1rem 1.5rem;
        border-radius: 1rem;
        font-size: 1rem;
        transition: background-color 0.3s ease-in-out;
        margin-right: 1rem;
    }

    .btn-primary:hover {
        background-color: #1565c0;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        padding: 1rem 1.5rem;
        border-radius: 1rem;
        font-size: 1rem;
        transition: background-color 0.3s ease-in-out;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .alert-danger {
        border-radius: 1rem;
        padding: 1.5rem;
        font-size: 1rem;
    }
</style>
