<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // Ritorna tutti gli appartamenti visibili
    public function index()
    {
        $apartments = Apartment::where('visibility', true)
                               ->with('extraServices')
                               ->get();

        // Restituisci la risposta con success e results
        return response()->json([
            'success' => true,
            'results' => $apartments
        ]);
    }

    // Mostra un singolo appartamento con i suoi dettagli e servizi
    public function show($id)
    {
        $apartment = Apartment::where('id', $id)
                              ->where('visibility', true)
                              ->with('extraServices')
                              ->firstOrFail();

        // Restituisci la risposta con success e result
        return response()->json([
            'success' => true,
            'result' => $apartment
        ]);
    }

    // Funzione di ricerca
    public function search(Request $request)
{
    // Ottieni il parametro location dalla query string
    $location = $request->input('location');

    // Inizializza la query sugli appartamenti
    $apartments = Apartment::query();

    // Filtro per location (se fornito)
    if ($location) {
        $apartments->where('address', 'LIKE', "%{$location}%");
    }

    // Esegui la query per appartamenti visibili e con eventuali filtri
    $result = $apartments->where('visibility', true)
                         ->with('extraServices')  // Carica i servizi associati
                         ->get();

    // Restituisci i risultati come JSON
    return response()->json([
        'success' => true,
        'results' => $result
    ]);
}