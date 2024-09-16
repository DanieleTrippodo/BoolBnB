<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Apartment;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Salva un nuovo messaggio inviato da un visitatore.
     * Questa azione è utilizzata per l'invio dei messaggi tramite API.
     */
    public function store(Request $request)
    {
        // Validazione dei dati in arrivo
        $validatedData = $request->validate([
            'apartment_id' => 'required|exists:apartments,id', // L'appartamento deve esistere
            'name' => 'required|string|max:255',               // Nome del mittente
            'sender_email' => 'required|email|max:255',        // Email del mittente
            'message' => 'required|string',                    // Testo del messaggio
        ]);

        // Crea il nuovo messaggio
        Message::create([
            'apartment_id' => $validatedData['apartment_id'],
            'name' => $validatedData['name'],
            'sender_email' => $validatedData['sender_email'],
            'message' => $validatedData['message'],
        ]);

        // Risposta JSON in caso di successo
        return response()->json(['success' => true, 'message' => 'Messaggio inviato con successo!'], 201);
    }

    /**
     * Mostra i messaggi ricevuti dal proprietario autenticato.
     * Questa azione è utilizzata per mostrare i messaggi nella dashboard dell'utente.
     */
    public function showMessagesForOwner()
    {
        // Recupera l'utente autenticato
        $user = auth()->user();

        // Recupera tutti i messaggi relativi agli appartamenti dell'utente
        $messages = Message::whereHas('apartment', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('apartment')->get();

        // Ritorna la vista con i messaggi
        return view('user.messages.index', compact('messages'));
    }
}