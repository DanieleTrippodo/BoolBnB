@extends('layouts.admin')

@section('content')

<!-- Container per il messaggio di successo -->
@if (session('success'))
<div class="alert alert-success text-center" style="max-width: 500px; margin: 20px auto;">
    {{ session('success') }}
</div>

<!-- Aggiungi un meta tag per reindirizzare dopo 2 secondi -->
<meta http-equiv="refresh" content="2;url={{ route('user.apartments.index') }}" />
@endif

<div>
    <h2 class="text-center title">Sponsorizzazione</h2>
</div>

<div class="container d-flex justify-content-center align-items-center">
    @foreach ($sponsors as $sponsor)
        <div class="card text-center me-3" style="width: 18rem;">
            <div class="card-body" id="card">
                <h5 class="card-title">{{ $sponsor->name }}</h5>
                <p class="card-text"><span>Durata:</span> {{ $sponsor->duration }} H</p>
                <p class="card-text"><span>Costo:</span> {{ $sponsor->cost }} &euro;</p>

                <!-- Bottone per aprire la modale -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#paymentModal" data-sponsor-id="{{ $sponsor->id }}">
                    Acquista
                </button>
            </div>
        </div>
    @endforeach
</div>

<!-- Modal per il pagamento -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="paymentModalLabel">Pagamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="payment-form" action="{{ route('user.sponsorships.assign', $apartment->id) }}" method="POST">
                    @csrf
                    <!-- Campo nascosto per l'id dello sponsor -->
                    <input type="hidden" name="sponsor_id" id="sponsor_id" value="">

                    <!-- Dettagli pagamento -->
                    <div class="mb-3">
                        <label for="card_number" class="form-label">Numero Carta</label>
                        <input type="text" class="form-control" id="card_number" placeholder="1234 5678 9012 3456" maxlength="19" required>
                    </div>
                    <div class="mb-3">
                        <label for="expiration" class="form-label">Scadenza</label>
                        <input type="text" class="form-control" id="expiration" placeholder="MM/YY" maxlength="5" required>
                    </div>
                    <div class="mb-3">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cvv" placeholder="123" maxlength="3" required>
                    </div>

                    <!-- Sezione per gli errori -->
                    <div id="error-messages" class="text-danger"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="confirm-payment">Conferma Pagamento</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Imposta l'id dello sponsor nel form quando la modale si apre
        var paymentModal = document.getElementById('paymentModal');
        paymentModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var sponsorId = button.getAttribute('data-sponsor-id');
            document.getElementById('sponsor_id').value = sponsorId;
        });

        // Aggiungi spazi automaticamente ogni 4 cifre nel numero della carta
        document.getElementById('card_number').addEventListener('input', function(e) {
            var input = e.target;
            var value = input.value.replace(/\D/g, ''); // Rimuove tutto tranne numeri
            var formattedValue = value.match(/.{1,4}/g)?.join(' ') || value; // Aggiungi uno spazio ogni 4 numeri
            input.value = formattedValue;
        });

        // Aggiungi lo slash automaticamente nel campo di scadenza
        document.getElementById('expiration').addEventListener('input', function(e) {
            var input = e.target;
            var value = input.value.replace(/\D/g, ''); // Rimuove tutto tranne numeri
            if (value.length >= 2) {
                input.value = value.substring(0, 2) + '/' + value.substring(2, 4);
            } else {
                input.value = value;
            }
        });

        // Gestione del pagamento
        document.getElementById('confirm-payment').addEventListener('click', function() {
            var cardNumber = document.getElementById('card_number').value.replace(/\s+/g, ''); // Rimuove spazi
            var expiration = document.getElementById('expiration').value;
            var cvv = document.getElementById('cvv').value;
            var errorMessages = document.getElementById('error-messages');
            errorMessages.innerHTML = ''; // Resetta i messaggi di errore

            // Validazione del numero di carta (16 cifre)
            var cardNumberRegex = /^\d{16}$/;
            if (!cardNumberRegex.test(cardNumber)) {
                errorMessages.innerHTML += "<p>Il numero della carta deve essere esattamente di 16 cifre.</p>";
                return;
            }

            // Validazione della data di scadenza (MM/YY) e anno >= anno corrente
            var expirationRegex = /^(0[1-9]|1[0-2])\/([0-9]{2})$/;
            if (!expirationRegex.test(expiration)) {
                errorMessages.innerHTML += "<p>La data di scadenza deve essere nel formato MM/YY.</p>";
                return;
            }

            var currentDate = new Date();
            var currentYear = currentDate.getFullYear() % 100; // Ottieni le ultime due cifre dell'anno corrente
            var currentMonth = currentDate.getMonth() + 1; // Mesi da 0 a 11
            var expMonth = parseInt(expiration.split('/')[0], 10);
            var expYear = parseInt(expiration.split('/')[1], 10);

            if (expYear < currentYear || (expYear === currentYear && expMonth < currentMonth)) {
                errorMessages.innerHTML += "<p>La data di scadenza non può essere nel passato.</p>";
                return;
            }

            // Validazione del CVV (3 cifre)
            var cvvRegex = /^\d{3}$/;
            if (!cvvRegex.test(cvv)) {
                errorMessages.innerHTML += "<p>Il CVV deve essere esattamente di 3 cifre.</p>";
                return;
            }

            // Se tutte le validazioni sono corrette, invia il form
            document.getElementById('payment-form').submit();
        });
    });
</script>

@endsection

<style>
body {
    background: linear-gradient(135deg, #f8f9fa, #ffc0cb, #0a3d62);
    font-family: 'Roboto', sans-serif;
    color: #333;
    height: 100%;
        h5,
        span{
        font-weight: bold;
        font-size: 1.2rem;
    }
    h5{
        text-transform: uppercase;
    }
    .title{
        font-size: 2rem;
        font-weight: bold;
        color: #1e88e5;
        margin-bottom: 1.5rem;
        text-align: center;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        background: linear-gradient(135deg, #1e88e5, #0a3d62);
        border-radius: 15px;
        color: white;
        width: 50%;
        margin: 0 auto;
        margin-bottom: 2rem;
        margin-top: 2rem;
        padding: .5rem;
    }

    #payment-form {
    background-color: #ffffff;
    border-radius: 1.5rem;
    padding: 2rem;
    box-shadow: 0 0.4rem 0.8rem rgba(0, 0, 0, 0.5);
    margin-bottom: 2rem;
    border-left: 0.5rem solid #1e88e5;
    h5{
        text-align: center;
    }

}

</style>
