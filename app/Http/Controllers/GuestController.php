<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\ExtraService;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    // Ritorna tutti gli appartamenti visibili
    public function index()
    {
        $apartments = Apartment::where('visibility', true)
            ->with('extraServices', 'sponsors')
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
            ->with('extraServices','sponsors')
            ->firstOrFail();

        // Restituisci la risposta con success e result
        return response()->json([
            'success' => true,
            'result' => $apartment
        ]);
    }

    public function search(Request $request)
{
    // Recupera la location e il raggio (default a 20 km)
    $location = $request->input('location');
    $radius = $request->input('radius', 20); // Il raggio predefinito è 20 km

    // Recupera i campi opzionali aggiuntivi
    $roomsNum = $request->input('rooms_num');
    $bedsNum = $request->input('beds_num');
    $bathroomsNum = $request->input('bathroom_num');
    $extraServices = $request->input('extra_services', []); // Array di ID dei servizi extra

    // Se non viene fornita la località, restituisci tutti gli appartamenti con i filtri aggiuntivi
    if (!$location) {
        $apartments = Apartment::where('visibility', true);

        // Filtri per stanze, letti e bagni se forniti
        if ($roomsNum) {
            $apartments->where('rooms_num', '>=', $roomsNum);
        }

        if ($bedsNum) {
            $apartments->where('beds_num', '>=', $bedsNum);
        }

        if ($bathroomsNum) {
            $apartments->where('bathroom_num', '>=', $bathroomsNum);
        }

        // Filtra gli appartamenti che hanno i servizi extra selezionati
        if (!empty($extraServices)) {
            $apartments->whereHas('extraServices', function ($query) use ($extraServices) {
                $query->whereIn('extra_services.id', $extraServices); // Specifica la tabella 'extra_services'
            });
        }

        // Aggiungi sponsor e ordina per sponsor attivi
        $apartments = $apartments->with(['extraServices', 'sponsors'])
                                 ->orderByRaw('IF(EXISTS(SELECT 1 FROM apartment_sponsor WHERE apartment_sponsor.apartment_id = apartments.id AND apartment_sponsor.start_date <= NOW() AND (apartment_sponsor.end_date IS NULL OR apartment_sponsor.end_date >= NOW())), 1, 0) DESC')
                                 ->get();

        if ($apartments->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Nessun appartamento trovato'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'results' => $apartments
        ], 200, ['Content-Type' => 'application/json']);
    }

    // Geocodifica la location per ottenere latitudine e longitudine
    $coordinates = $this->geocodeLocation($location);

    if (!$coordinates) {
        return response()->json([
            'success' => false,
            'message' => 'Località non trovata',
        ], 404);
    }

    $latitude = $coordinates['lat'];
    $longitude = $coordinates['lng'];

    // Calcola la distanza con la formula dell'Haversine e filtra gli appartamenti
    $apartments = Apartment::selectRaw(
        "*, (6371 * acos(cos(radians(?))
        * cos(radians(latitude))
        * cos(radians(longitude) - radians(?))
        + sin(radians(?))
        * sin(radians(latitude)))) AS distance",
        [$latitude, $longitude, $latitude]
    )
    ->having("distance", "<", $radius)
    ->where('visibility', true);

    // Aggiungi i filtri opzionali per stanze, letti e bagni se forniti
    if ($roomsNum) {
        $apartments->where('rooms_num', '>=', $roomsNum);
    }

    if ($bedsNum) {
        $apartments->where('beds_num', '>=', $bedsNum);
    }

    if ($bathroomsNum) {
        $apartments->where('bathroom_num', '>=', $bathroomsNum);
    }

    // Filtra gli appartamenti che hanno i servizi extra selezionati
    if (!empty($extraServices)) {
        $apartments->whereHas('extraServices', function ($query) use ($extraServices) {
            $query->whereIn('extra_services.id', $extraServices);
        });
    }

    // Aggiungi sponsor e ordina per sponsor attivi
    $apartments = $apartments->with(['extraServices', 'sponsors'])
                             ->orderByRaw('IF(EXISTS(SELECT 1 FROM apartment_sponsor WHERE apartment_sponsor.apartment_id = apartments.id AND apartment_sponsor.start_date <= NOW() AND (apartment_sponsor.end_date IS NULL OR apartment_sponsor.end_date >= NOW())), 1, 0) DESC')
                             ->get();

    if ($apartments->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'Nessun appartamento trovato entro il raggio specificato'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'results' => $apartments
    ]);
}

}
