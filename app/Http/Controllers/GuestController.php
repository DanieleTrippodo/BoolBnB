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

    public function search(Request $request)
{
    // Recupera i parametri di ricerca
    $location = $request->input('location');
    $radius = $request->input('radius', 20); // Raggio in km, default 20
    $rooms_num = $request->input('rooms_num');
    $beds_num = $request->input('beds_num');
    $services = $request->input('services', []);

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

    // Query di base per gli appartamenti visibili
    $query = Apartment::selectRaw(
        "apartments.*, (6371 * acos(cos(radians(?))
        * cos(radians(latitude))
        * cos(radians(longitude) - radians(?))
        + sin(radians(?))
        * sin(radians(latitude)))) AS distance",
        [$latitude, $longitude, $latitude]
    )
    ->where('visibility', true)
    ->having('distance', '<=', $radius);

    // Filtra per numero minimo di stanze
    if ($rooms_num) {
        $query->where('rooms_num', '>=', $rooms_num);
    }

    // Filtra per numero minimo di posti letto
    if ($beds_num) {
        $query->where('beds_num', '>=', $beds_num);
    }

    // Filtra per servizi aggiuntivi
    if (!empty($services)) {
        $query->whereHas('extraServices', function ($q) use ($services) {
            $q->whereIn('extra_services.id', $services);
        }, '=', count($services));
    }

    // Esegui la query e ottieni i risultati
    $apartments = $query->with('extraServices')->get();

    if ($apartments->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'Nessun appartamento trovato con i criteri specificati',
        ], 404);
    }

    return response()->json([
        'success' => true,
        'results' => $apartments,
    ]);
}

/* per fare la chiamata GET alla rotta /search */
public function getServices()
{
    $services = ExtraService::all();

    return response()->json([
        'success' => true,
        'results' => $services,
    ]);
}




/* Logica dietro ai Meassaggi */
public function storeMessage(Request $request, $id)
{
    // Validazione dei dati
    $validatedData = $request->validate([
        'sender_email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    // Recupera l'appartamento
    $apartment = Apartment::findOrFail($id);

    // Crea il nuovo messaggio
    Message::create([
        'apartment_id' => $apartment->id,
        'name' => Auth::check() ? Auth::user()->name : 'Ospite',
        'sender_email' => $validatedData['sender_email'],
        'message' => $validatedData['message'],
    ]);

    return redirect()->back()->with('success', 'Messaggio inviato con successo!');
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
}
