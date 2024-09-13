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
    // Verifica se il parametro 'location' è presente nella richiesta
    $location = $request->input('location');

    // Se 'location' è presente, esegui la ricerca
    if ($location) {
        $apartments = Apartment::where('address', 'LIKE', '%' . $location . '%')
                               ->where('visibility', true)
                               ->with('extraServices')
                               ->get();
    } else {
        // Se non viene specificata una location, restituisci tutti gli appartamenti
        $apartments = Apartment::where('visibility', true)
                               ->with('extraServices')
                               ->get();
    }

    // Restituisci la risposta JSON
    return response()->json([
        'success' => true,
        'results' => $apartments
    ]);
}
}