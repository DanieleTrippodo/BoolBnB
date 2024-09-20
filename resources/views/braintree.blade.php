@extends('layouts.admin')

@section('content')
    <div class="py-12">
        <!-- Drop-in container per Braintree -->
        <div id="dropin-container" style="display: flex; justify-content: center; align-items: center;"></div>
        <!-- Bottone per confermare il pagamento -->
        <div style="display: flex; justify-content: center; align-items: center; color: white">
            <button id="submit-button" class="btn btn-sm btn-success">Procedi con il pagamento</button>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script>
        const button = document.querySelector('#submit-button');
        braintree.dropin.create({
            authorization: '{{ $token }}',  // Usa il token generato dal controller
            container: '#dropin-container'
        }, function (createErr, instance) {
            button.addEventListener('click', function () {
                instance.requestPaymentMethod(function (err, payload) {
                    if (err) {
                        console.log('Errore nella richiesta del metodo di pagamento:', err);
                        return;
                    }

                    // Invia la richiesta AJAX per il pagamento
                    (function($) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: "POST",
                            url: "{{ route('payment') }}",  // La rotta per processare il pagamento
                            data: {
                                nonce: payload.nonce,  // Il nonce del pagamento
                                sponsor_id: "{{ $sponsor->id }}",  // L'ID dello sponsor passato dal controller
                                apartment_id: "{{ $apartment->id }}"  // L'ID dell'appartamento passato dal controller
                            },
                            success: function (response) {
                                console.log('Pagamento completato con successo!', response);
                                window.location.href = "{{ route('user.apartments.index') }}";  // Reindirizza dopo il successo
                            },
                            error: function (response) {
                                console.log('Errore durante il pagamento:', response);
                                alert('C\'è stato un problema con il pagamento. Riprova.');
                            }
                        });
                    })(jQuery);
                });
            });
        });
    </script>
@endsection
