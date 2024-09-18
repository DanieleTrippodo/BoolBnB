<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ApartmentController as UserApartmentController;
use App\Http\Controllers\User\MessageController as UserMessageController;
use Illuminate\Support\Facades\Auth;


/* per gestire le rotte del guest */
use App\Http\Controllers\GuestController;


/* -------------Aggiornato---------------------- */
Route::get('/', function () {
    return view('pages.welcome');
})->name('home');
/* -------------Aggiornato---------------------- */




// per la ricerca avanzata
Route::get('/search', [GuestController::class, 'search'])->name('guest.search');



/* Rotta per il /search */
Route::get('/api/services', [GuestController::class, 'getServices'])->name('guest.services');


/* rotta POST per gestire l'invio dei mesaggi */
Route::post('/apartments/{apartment}/messages', [GuestController::class, 'storeMessage'])->name('guest.messages.store');

/* rotta per visualizzare il dettaglio di un appartamento pubblico */
Route::get('/apartments/{apartment}', [GuestController::class, 'show'])->name('guest.apartments.show');


/* -------------Aggiornato---------------------- */
Auth::routes(['register' => true, 'login' => true]);
/* -------------Aggiornato---------------------- */


// Reindirizza /home a user.apartments.index
Route::get('/home', function () {
    return redirect()->route('user.apartments.index');
})->name('home');
// // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->name('user.')->prefix('user/')->group(function () {
    Route::get('/apartments', [UserApartmentController::class, 'index'])->name('apartments.index');
    Route::get('/apartments/deleted', [UserApartmentController::class, 'deletedIndex'])->name('apartments.deleted');
    Route::patch('/apartments/{apartment}/restore', [UserApartmentController::class, 'restore'])->name('apartments.restore');
    Route::delete('/apartments/{apartment}/permanent-delete', [UserApartmentController::class, 'permanentDelete'])->name('apartments.permanent.delete');
    Route::resource('/apartments', UserApartmentController::class);
// Messaggi
    Route::get('/messages', [UserMessageController::class, 'showMessagesForOwner'])->name('messages.index');
});
