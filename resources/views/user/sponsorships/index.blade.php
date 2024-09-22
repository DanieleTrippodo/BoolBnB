@extends('layouts.admin')

@section('content')
    <!-- Container per il messaggio di conferma -->
    @if (session('success'))
        <div class="alert alert-info text-center" style="max-width: 500px; margin: 20px auto;">
            <!-- Nuovo messaggio di conferma -->
            Reindirizzamento alla pagina di pagamento
        </div>

        <!-- Modifica il reindirizzamento verso http://localhost:5181/ -->
        <meta http-equiv="refresh" content="1;url=http://localhost:5182/" />
    @endif

    <div class="title-conteiner">
        <div class="col-md-8">
            <div class="form-header-wrapper">
                <h2 class="text-center form-header">Sponsorizza</h2>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center align-items-center">
        @foreach ($sponsors as $sponsor)
            <div class="card text-center me-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"> {{ $sponsor->name }} </h5>
                    <p class="card-text"><span> Durata: </span> {{ $sponsor->duration }} H</p>
                    <p class="card-text"><span> Costo: </span> {{ $sponsor->cost }} &euro;</p>

                    <!-- Form per acquistare la sponsorizzazione -->
                    <form action="{{ route('user.sponsorships.assign', $apartment->id) }}" method="POST">
                        @csrf
                        <!-- Passa l'id dello sponsor -->
                        <input type="hidden" name="sponsor_id" value="{{ $sponsor->id }}">
                        <button type="submit" class="btn btn-success">Acquista</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection

<style>
    body {
        background: linear-gradient(135deg, #f8f9fa, #ffc0cb, #0a3d62);
        font-family: 'Roboto', sans-serif;
        color: #333;
        height: 100%;
    }

    .card-body {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.8);

        h5,
        span {
            font-weight: bold;
        }
    }

    .form-header-wrapper {
        background: linear-gradient(135deg, #1e88e5, #0a3d62);
        border-radius: 1.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: .5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 0.4rem 0.8rem rgba(0, 0, 0, 0.1);
    }

    .form-header {
        font-size: 2rem;
        font-weight: bold;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .title-conteiner {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .btn:hover {
        transform: translateY(-3px);
    }
</style>
