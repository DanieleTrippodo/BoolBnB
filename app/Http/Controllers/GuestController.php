<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // rendiamo visibili tutti gli appartamenti
    public function index()
    {
        $apartments = Apartment::where('visibility', true)->get();
        return view('guest.index', compact('apartments'));
    }

    // Mostra i dettagli di un appartamento
    public function show($id)
    {
        $apartment = Apartment::where('id', $id)->where('visibility', true)->firstOrFail();
        return view('guest.show', compact('apartment'));
    }


    public function search(Request $request)
{
    // Recupera i parametri di ricerca
    $location = $request->input('location');
    $rooms_num = $request->input('rooms_num');

    // Esegui la query sugli appartamenti
    $apartments = Apartment::where('visibility', true)
        ->when($location, function ($query, $location) {
            return $query->where('address', 'LIKE', '%' . $location . '%');
        })
        ->when($rooms_num, function ($query, $rooms_num) {
            return $query->where('rooms_num', '>=', $rooms_num);
        })

        // /* Per filtrare dal prezzo più basso */
        // ->when($min_price, function ($query, $min_price) {
        //     return $query->where('price', '>=', $min_price);
        // })        dobbiamo definire il prezzo minimo! nella tabella apartments

        ->get();


    // Ritorna la view con i risultati della ricerca
    return view('guest.index', compact('apartments'));


}




}




