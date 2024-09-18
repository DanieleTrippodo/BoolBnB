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

            $apartments = $apartments->with('extraServices')->get();

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
                $query->whereIn('extra_services.id', $extraServices); // Specifica la tabella 'extra_services'
            });
        }

        $apartments = $apartments->with('extraServices')->get();

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

    // Funzione per geocodificare la località usando un'API esterna (TomTom, Google, ecc.)
    protected function geocodeLocation($location)
    {
        // Esempio di chiamata API (sostituisci con la tua API di geocodifica)
        $apiKey = 'S14VN8AzM8BoQ73JkRu5N2PqtkZtrrjN';  // Aggiungi la chiave API nel file .env
        $url = "https://api.tomtom.com/search/2/geocode/" . urlencode($location) . ".json?key=" . $apiKey;

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (isset($data['results'][0]['position'])) {
            return [
                'lat' => $data['results'][0]['position']['lat'],
                'lng' => $data['results'][0]['position']['lon']
            ];
        }

        return null; // Se la località non è trovata
    }
}