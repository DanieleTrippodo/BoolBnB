<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recupera tutti gli appartamenti
        // $apartments = Apartment::all();

        // Recupera tutti gli appartamenti dell'utente loggato
        $apartments = Apartment::where('user_id', auth()->id())->get();


        return view('user.apartment.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.apartment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        // Validazione dei dati
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'rooms_num' => 'required|integer|min:1',
            'beds_num' => 'required|integer|min:1',
            'bathroom_num' => 'required|integer|min:1',
            'sq_mt' => 'required|integer|min:1',
            'address' => 'required|string|max:255',
            // 'images' => 'url|string',
            'visibility' => 'boolean',
        ]);

        // Chiamata API a TomTom per ottenere le coordinate
        $address = $validatedData['address'];
        $apiKey = config('services.tomtom.api_key');
        $response = Http::withoutVerifying()->get("https://api.tomtom.com/search/2/geocode/{$address}.json", [
            'key' => $apiKey,
        ]);

        if ($response->successful()) {
            $data = $response['results'][0];
            $latitude = $data['position']['lat'];
            $longitude = $data['position']['lon'];
        } else {
            // Gestisci errori API
            return back()->withErrors(['message' => 'Non è stato possibile ottenere le coordinate.']);
        }


        // Uploading Image logic

        $img_path = Storage::put('uploads/apartment', $data['images']);
        $data['images'] = $img_path;

        // Salva l'appartamento con le coordinate ottenute dall'API
        Apartment::create([
            'user_id' => auth()->id(),
            'title' => $validatedData['title'],
            'rooms_num' => $validatedData['rooms_num'],
            'beds_num' => $validatedData['beds_num'],
            'bathroom_num' => $validatedData['bathroom_num'],
            'sq_mt' => $validatedData['sq_mt'],
            'address' => $validatedData['address'],
            'latitude' => $latitude,
            'longitude' => $longitude,
            'images' => $validatedData['images'],
            'visibility' => $validatedData['visibility'] ?? true,
        ]);




        return redirect()->route('user.apartments.index')->with('success', 'Appartamento creato con successo!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {

        // Verifica se l'utente è il proprietario dell'appartamento
        if (auth()->id() !== $apartment->user_id) {
            return redirect()->route('user.apartments.index')->with('error', 'Non hai accesso a questo appartamento.');
        }

        return view('user.apartment.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        // Verifica se l'utente è il proprietario dell'appartamento
        if (auth()->id() !== $apartment->user_id) {
            return redirect()->route('user.apartments.index')->with('error', 'Non hai accesso a questo appartamento.');
        }

        return view('user.apartment.edit', compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        // Verifica se l'utente è il proprietario dell'appartamento
        if (auth()->id() !== $apartment->user_id) {
            return redirect()->route('user.apartments.index')->with('error', 'Non hai accesso a questo appartamento.');
        }

        // Validazione
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'rooms_num' => 'required|integer|min:1',
            'beds_num' => 'required|integer|min:1',
            'bathroom_num' => 'required|integer|min:1',
            'sq_mt' => 'required|integer|min:1',
            'address' => 'required|string|max:255',
            'images' => 'nullable|string',
            'visibility' => 'boolean',
        ]);

        if ($validatedData['address'] !== $apartment->address) {
            $address = $validatedData['address'];
            $apiKey = config('services.tomtom.api_key');

            // Chiamata API TomTom per ottenere le coordinate
            $response = Http::withoutVerifying()->get("https://api.tomtom.com/search/2/geocode/{$address}.json", [
                'key' => $apiKey,
            ]);

            if ($response->successful()) {
                $data = $response['results'][0];
                $validatedData['latitude'] = $data['position']['lat'];
                $validatedData['longitude'] = $data['position']['lon'];
            } else {
                // Gestisci errori API
                return back()->withErrors(['message' => 'Non è stato possibile ottenere le coordinate.']);
            }
        }

        // Aggiorna l'appartamento
        $apartment->update($validatedData);

        return redirect()->route('user.apartments.index')->with('success', 'Appartamento aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        // Verifica se l'utente è il proprietario dell'appartamento
        if (auth()->id() !== $apartment->user_id) {
            return redirect()->route('user.apartments.index')->with('error', 'Non hai accesso a questo appartamento.');
        }

        // Elimina l'appartamento
        $apartment->delete();

        return redirect()->route('user.apartments.index')->with('success', 'Appartamento eliminato con successo!');
    }
}
