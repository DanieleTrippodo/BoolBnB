<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // rendiamo visibili tutti gli appartamenti
    public function index()
    {
        $apartments = Apartment::where('visibility', true)->get();
        return view('guest.index', compact('apartments'));
    }

    public function show($id)
    {
        // Carica l'appartamento e i suoi servizi solo se è visibile
        $apartment = Apartment::where('id', $id)
                              ->where('visibility', true)
                              ->with('extraServices')  // Carica i servizi associati
                              ->firstOrFail();

        return view('guest.show', compact('apartment'));
    }


    public function search(Request $request)
{
    $location = $request->input('location');

    // Inizializza la query sugli appartamenti
    $apartments = Apartment::query();

    // Filtro per location
    if ($location) {
        $apartments->where('address', 'LIKE', "%{$location}%");
    }

    // Ottieni i risultati della ricerca
    $result = $apartments->get();

    // Restituisce i risultati in formato JSON
    return response()->json($result);
}



    // Ritorna la view con i risultati della ricerca



}