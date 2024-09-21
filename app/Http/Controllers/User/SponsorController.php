<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use App\Models\Apartment;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    // Metodo per mostrare tutte le sponsorizzazioni disponibili
    public function sponsorshipsIndex(Apartment $apartment)
    {
        $sponsors = Sponsor::all();
        return view('user.sponsorships.index', compact('sponsors', 'apartment'));
    }

    // Metodo per assegnare una sponsorizzazione a un appartamento
    public function assignSponsor(Request $request, Apartment $apartment)
{
    // Recupera l'ID dello sponsor selezionato dal form
    $sponsor_id = $request->input('sponsor_id');

    // Trova lo sponsor nel database
    $sponsor = Sponsor::findOrFail($sponsor_id);

    // Imposta le date di inizio e fine sponsorizzazione
    $start_date = now();
    $end_date = $start_date->copy()->addHours($sponsor->duration);

    // Aggiungi la sponsorizzazione nella tabella ponte
    $apartment->sponsors()->attach($sponsor_id, [
        'start_date' => $start_date,
        'end_date' => $end_date,
    ]);

    // Reindirizza alla pagina di sponsorizzazioni con un messaggio di successo
    return redirect()->route('user.sponsorships.index', $apartment->id)
                     ->with('success', 'Sponsorizzazione assegnata con successo.');
}

}