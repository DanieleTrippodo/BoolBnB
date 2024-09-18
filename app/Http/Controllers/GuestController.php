<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\ExtraService;
use App\Models\Sponsor;
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
            ->with(['extraServices', 'sponsors']) // Aggiungi la relazione con gli sponsor
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

        // Se non viene fornita la località, restituisci tutti gli appartamenti
        if (!$location) {
            $apartments = Apartment::where('visibility', true)
                ->with('extraServices')
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
            ->where('visibility', true)
            ->with('extraServices')
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

    // Funzione per geocodificare la località usando un'API esterna (TomTom, Google, ecc.)
    private function geocodeLocation($location)
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

    // Funzione per assegnare uno sponsor a un appartamento
    public function assignSponsor(Request $request, $apartmentId)
    {
        // Validazione dei dati in ingresso
        $request->validate([
            'sponsor_id' => 'required|exists:sponsors,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        // Trova l'appartamento tramite ID
        $apartment = Apartment::findOrFail($apartmentId);

        // Associa lo sponsor all'appartamento con le date specificate
        $apartment->sponsors()->attach($request->sponsor_id, [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sponsor assegnato correttamente!'
        ]);
    }
}
