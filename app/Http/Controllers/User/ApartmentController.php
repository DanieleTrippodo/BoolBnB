<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\ExtraService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recupera gli appartamenti ordinando prima quelli sponsorizzati
        $apartments = Apartment::where('user_id', auth()->id())
            ->with('sponsors')
            ->get()
            ->sortByDesc(function($apartment) {
                return $apartment->sponsors->count();
            });

        return view('user.apartment.index', compact('apartments'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Recupera tutti i servizi extra per il form di creazione
        $services = ExtraService::all();

        return view('user.apartment.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validazione dei dati
        $validatedData = $request->validate([
            'title'            => 'required|string|max:255',
            'rooms_num'        => 'required|integer|min:1',
            'beds_num'         => 'required|integer|min:1',
            'bathroom_num'     => 'required|integer|min:1',
            'sq_mt'            => 'required|integer|min:1',
            'address'          => 'required|string|max:255',
            'images'           => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'visibility'       => 'boolean',
            'extra_services'   => 'required|array|min:1',
        ]);

        // Chiamata API a TomTom per ottenere le coordinate
        $address = $validatedData['address'];
        $apiKey = config('services.tomtom.api_key');
        $response = Http::withoutVerifying()->get("https://api.tomtom.com/search/2/geocode/" . urlencode($address) . ".json", [
            'key' => $apiKey,
        ]);

        if ($response->successful() && isset($response['results'][0])) {
            $data      = $response['results'][0];
            $latitude  = $data['position']['lat'];
            $longitude = $data['position']['lon'];
        } else {
            return back()->withErrors(['message' => 'Non è stato possibile ottenere le coordinate.']);
        }

        // Gestione del caricamento dell'immagine
        if ($request->hasFile('images')) {
            // Salva l'immagine nel disco 'public'
            $img_path = $request->file('images')->store('uploads/apartments', 'public');
            $validatedData['images'] = $img_path;
        }

        // Salva l'appartamento con le coordinate ottenute dall'API
        $apartment = Apartment::create([
            'user_id'        => auth()->id(),
            'title'          => $validatedData['title'],
            'rooms_num'      => $validatedData['rooms_num'],
            'beds_num'       => $validatedData['beds_num'],
            'bathroom_num'   => $validatedData['bathroom_num'],
            'sq_mt'          => $validatedData['sq_mt'],
            'address'        => $validatedData['address'],
            'latitude'       => $latitude,
            'longitude'      => $longitude,
            'images'         => $validatedData['images'] ?? null,
            'visibility'     => $validatedData['visibility'] ?? true,
        ]);

        // Sincronizza i servizi extra selezionati
        if (isset($validatedData['extra_services'])) {
            $apartment->extraServices()->sync($validatedData['extra_services']);
        }

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

        // Recupera i servizi extra per il form di modifica
        $services = ExtraService::all();

        return view('user.apartment.edit', compact('apartment', 'services'));
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

        // Validazione dei dati
        $validatedData = $request->validate([
            'title'            => 'required|string|max:255',
            'rooms_num'        => 'required|integer|min:1',
            'beds_num'         => 'required|integer|min:1',
            'bathroom_num'     => 'required|integer|min:1',
            'sq_mt'            => 'required|integer|min:1',
            'address'          => 'required|string|max:255',
            'images'           => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'visibility'       => 'boolean',
            'extra_services'   => 'required|array|min:1',
        ]);

        // Verifica se l'indirizzo è cambiato per aggiornare le coordinate
        if ($validatedData['address'] !== $apartment->address) {
            $address = $validatedData['address'];
            $apiKey  = config('services.tomtom.api_key');

            // Chiamata API TomTom per ottenere le coordinate
            $response = Http::withoutVerifying()->get("https://api.tomtom.com/search/2/geocode/" . urlencode($address) . ".json", [
                'key' => $apiKey,
            ]);

            if ($response->successful() && isset($response['results'][0])) {
                $data                      = $response['results'][0];
                $validatedData['latitude'] = $data['position']['lat'];
                $validatedData['longitude'] = $data['position']['lon'];
            } else {
                return back()->withErrors(['message' => 'Non è stato possibile ottenere le coordinate.']);
            }
        }

        // Gestione dell'upload dell'immagine
        if ($request->hasFile('images')) {
            // Elimina l'immagine esistente, se presente
            if ($apartment->images) {
                Storage::disk('public')->delete($apartment->images);
            }

            // Carica la nuova immagine nel disco 'public'
            $img_path = $request->file('images')->store('uploads/apartments', 'public');
            $validatedData['images'] = $img_path;
        }

        // Aggiorna l'appartamento con i dati validati
        $apartment->update($validatedData);

        // Sincronizza i servizi extra selezionati
        if (isset($validatedData['extra_services'])) {
            $apartment->extraServices()->sync($validatedData['extra_services']);
        }

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

    /**
     * Mostra gli appartamenti eliminati.
     */
    public function deletedIndex()
    {
        // Recupera solo gli appartamenti eliminati
        $apartments = Apartment::onlyTrashed()->where('user_id', auth()->id())->get();

        return view('user.apartment.deleted-index', compact('apartments'));
    }

    /**
     * Ripristina l'appartamento eliminato.
     */
    public function restore(string $id)
    {
        // Recupera l'appartamento eliminato
        $apartment = Apartment::onlyTrashed()->where('user_id', auth()->id())->findOrFail($id);

        // Ripristina l'appartamento
        $apartment->restore();

        return redirect()->route('user.apartments.deleted')->with('success', 'Appartamento ripristinato con successo!');
    }

    /**
     * Eliminazione permanente dell'appartamento.
     */
    public function permanentDelete(string $id)
    {
        // Recupera l'appartamento eliminato
        $apartment = Apartment::onlyTrashed()->where('user_id', auth()->id())->findOrFail($id);

        // Eliminazione permanente
        $apartment->forceDelete();

        return redirect()->route('user.apartments.deleted')->with('success', 'Appartamento eliminato definitivamente!');
    }
}
