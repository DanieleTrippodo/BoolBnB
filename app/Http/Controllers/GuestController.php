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
}
