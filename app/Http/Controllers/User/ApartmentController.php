<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $apartments = Apartment::all();

        // Recupera tutti gli appartamenti dell'utente loggato
        // $apartments = Apartment::where('user_id', auth()->id())->get();


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
        // Validazione direttamente nel controller
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'rooms_num' => 'required|integer|min:1',
            'beds_num' => 'required|integer|min:1',
            'bathroom_num' => 'required|integer|min:1',
            'sq_mt' => 'required|integer|min:1',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'images' => 'nullable|string',
            'visibility' => 'boolean',
        ]);

        // Salva l'appartamento
        Apartment::create([
            'user_id' => auth()->id(),
            'title' => $validatedData['title'],
            'rooms_num' => $validatedData['rooms_num'],
            'beds_num' => $validatedData['beds_num'],
            'bathroom_num' => $validatedData['bathroom_num'],
            'sq_mt' => $validatedData['sq_mt'],
            'address' => $validatedData['address'],
            'latitude' => $validatedData['latitude'],
            'longitude' => $validatedData['longitude'],
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
        // if (auth()->id() !== $apartment->user_id) {
        //     return redirect()->route('user.apartments.index')->with('error', 'Non hai accesso a questo appartamento.');
        // }

        return view('user.apartment.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        // Verifica se l'utente è il proprietario dell'appartamento
        // if (auth()->id() !== $apartment->user_id) {
        //     return redirect()->route('user.apartments.index')->with('error', 'Non hai accesso a questo appartamento.');
        // }

        return view('user.apartment.edit', compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        // Verifica se l'utente è il proprietario dell'appartamento
        // if (auth()->id() !== $apartment->user_id) {
        //     return redirect()->route('user.apartments.index')->with('error', 'Non hai accesso a questo appartamento.');
        // }

        // Validazione
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'rooms_num' => 'required|integer|min:1',
            'beds_num' => 'required|integer|min:1',
            'bathroom_num' => 'required|integer|min:1',
            'sq_mt' => 'required|integer|min:1',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'images' => 'nullable|string',
            'visibility' => 'boolean',
        ]);

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
        // if (auth()->id() !== $apartment->user_id) {
        //     return redirect()->route('user.apartments.index')->with('error', 'Non hai accesso a questo appartamento.');
        // }

        // Elimina l'appartamento
        $apartment->delete();

        return redirect()->route('user.apartments.index')->with('success', 'Appartamento eliminato con successo!');
    }
}
