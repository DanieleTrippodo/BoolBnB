<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use App\Models\Apartment;
use Braintree\Gateway;
use Illuminate\Http\Request;

class BraintreeController extends Controller
{
    // Metodo per generare il token Braintree e visualizzare la vista di pagamento
    public function token(Gateway $gateway, Request $request)
    {
        // Trova lo sponsor e l'appartamento dall'input del form o altri parametri
        $sponsor = Sponsor::findOrFail($request->input('sponsor_id'));
        $apartment = Apartment::findOrFail($request->input('apartment_id'));

        // Genera il client token per Braintree
        $token = $gateway->clientToken()->generate();

        // Passa il token, lo sponsor e l'appartamento alla vista
        return view('braintree', [
            'token' => $token,
            'sponsor' => $sponsor,
            'apartment' => $apartment
        ]);
    }

    // Metodo per processare il pagamento e assegnare lo sponsor
    public function processPayment(Request $request, Gateway $gateway)
    {
        // Recupera il nonce, l'ID dello sponsor e l'ID dell'appartamento
        $nonceFromTheClient = $request->input('nonce');
        $sponsor_id = $request->input('sponsor_id');
        $apartment_id = $request->input('apartment_id');

        // Trova lo sponsor e l'appartamento nel database
        $sponsor = Sponsor::findOrFail($sponsor_id);
        $apartment = Apartment::findOrFail($apartment_id);

        // Esegui il pagamento tramite Braintree
        $result = $gateway->transaction()->sale([
            'amount' => $sponsor->cost, // Usa il costo dello sponsor
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        // Controlla se il pagamento è andato a buon fine
        if ($result->success) {
            // Imposta le date di inizio e fine sponsorizzazione
            $start_date = now();
            $end_date = $start_date->copy()->addHours($sponsor->duration);

            // Aggiungi la sponsorizzazione nella tabella ponte (associa l'appartamento allo sponsor)
            $apartment->sponsors()->attach($sponsor_id, [
                'start_date' => $start_date,
                'end_date' => $end_date,
            ]);

            // Reindirizza alla pagina degli appartamenti con un messaggio di successo
            return redirect()->route('user.apartments.index')
                             ->with('success', 'Pagamento effettuato e sponsorizzazione assegnata con successo.');
        } else {
            // Gestione dell'errore di pagamento
            return redirect()->back()->withErrors('Errore nel pagamento: ' . $result->message);
        }
    }
}