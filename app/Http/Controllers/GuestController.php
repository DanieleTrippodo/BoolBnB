<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\ExtraService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GuestController extends Controller
{
    // Ritorna tutti gli appartamenti visibili
    public function index()
    {
        $apartments = Apartment::where('visibility', true)
            ->with('extraServices')
            ->get();

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

        return response()->json([
            'success' => true,
            'result' => $apartment
        ]);
    }

    // Endpoint per ottenere tutti i servizi extra
    public function getAllExtraServices()
    {
        $services = ExtraService::all();

        return response()->json([
            'success' => true,
            'results' => $services
        ]);
    }

    // Funzione di ricerca avanzata
    public function search(Request $request)
    {
        // Recupera i parametri di ricerca
        $location       = $request->input('location');
        $radius         = $request->input('radius', 20); // Raggio predefinito di 20 km
        $rooms          = $request->input('rooms');
        $beds           = $request->input('beds');
        $extraServices  = $request->input('extra_services', []);

        // Inizializza la query di base
        $apartmentsQuery = Apartment::where('visibility', true)
            ->with('extraServices');

        // Se viene fornita una località, geocodificala per ottenere le coordinate
        if ($location) {
            $coordinates = $this->geocodeLocation($location);

            if (!$coordinates) {
                return response()->json([
                    'success' => false,
                    'message' => 'Località non trovata',
                ], 404);
            }

            $latitude  = $coordinates['lat'];
            $longitude = $coordinates['lng'];

            // Aggiungi il calcolo della distanza alla query
            $apartmentsQuery->selectRaw(
                "apartments.*, (6371 * acos(cos(radians(?))
                * cos(radians(latitude))
                * cos(radians(longitude) - radians(?))
                + sin(radians(?))
                * sin(radians(latitude)))) AS distance",
                [$latitude, $longitude, $latitude]
            )
            ->having("distance", "<", $radius);
        }

        // Filtra per numero di stanze se specificato
        if ($rooms) {
            $apartmentsQuery->where('rooms_num', '>=', $rooms);
        }

        // Filtra per numero di letti se specificato
        if ($beds) {
            $apartmentsQuery->where('beds_num', '>=', $beds);
        }

        // Filtra per servizi extra se specificati
        if (!empty($extraServices)) {
            $apartmentsQuery->whereHas('extraServices', function ($query) use ($extraServices) {
                $query->whereIn('extra_services.id', $extraServices);
            }, '=', count($extraServices));
        }

        // Esegui la query
        $apartments = $apartmentsQuery->get();

        if ($apartments->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Nessun appartamento trovato con i criteri specificati'
            ], 404);
        }

        // Restituisce la risposta con gli appartamenti trovati
        return response()->json([
            'success' => true,
            'results' => $apartments
        ], 200, ['Content-Type' => 'application/json']);
    }

    // Funzione per geocodificare la località usando l'API TomTom
    private function geocodeLocation($location)
    {
        $apiKey = config('services.tomtom.api_key'); // Assicurati di avere la chiave API nel file .env e configurata in services.php

        $response = Http::get("https://api.tomtom.com/search/2/geocode/" . urlencode($location) . ".json", [
            'key' => $apiKey,
            'limit' => 1,
        ]);

        if ($response->successful() && isset($response['results'][0]['position'])) {
            return [
                'lat' => $response['results'][0]['position']['lat'],
                'lng' => $response['results'][0]['position']['lon'],
            ];
        }

        return null; // Se la località non è trovata
    }
}