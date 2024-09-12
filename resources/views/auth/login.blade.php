@extends('layouts.app')

@section('content')

<style>
    /* Palette di colori */
    :root {
        --color-background: #fefbfa;
        --color-primary: #003f6c;
        --color-secondary: #a34a62;
        --color-text-light: #ffffff;
    }

    body {
        background-color: var(--color-background);
    }

    .auth-container {
        max-width: 500px;
        margin: 50px auto;
        background-color: var(--color-background);
        border: 1px solid var(--color-primary);
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    }

    .auth-title {
        color: var(--color-primary);
        text-align: center;
        font-size: 1.5rem;
        margin-bottom: 30px;
    }

    .form-control {
        background-color: var(--color-background);
        border: 1px solid var(--color-primary);
        color: var(--color-primary);
    }

    .form-control:focus {
        border-color: var(--color-secondary);
        box-shadow: none;
    }

    .btn-auth {
        background-color: var(--color-primary);
        color: var(--color-text-light);
        border: none;
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        margin-top: 10px;
    }

    .btn-auth:hover {
        background-color: var(--color-secondary);
    }

    .auth-links {
        text-align: center;
        margin-top: 20px;
    }

    .auth-links a {
        color: var(--color-primary);
        text-decoration: none;
    }

    .auth-links a:hover {
        color: var(--color-secondary);
    }
</style>

<div class="auth-container">
    <h2 class="auth-title">Accedi al tuo account</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Indirizzo Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Ricordami</label>
        </div>

        <button type="submit" class="btn-auth">Login</button>
    </form>

    <div class="auth-links">
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">Hai dimenticato la password?</a>
        @endif
        <br>
        <a href="{{ route('register') }}">Non hai un account? Registrati qui</a>
    </div>
</div>

@endsection
