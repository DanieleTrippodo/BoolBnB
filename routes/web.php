<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ApartmentController as UserApartmentController;
use Illuminate\Support\Facades\Auth;


/* per gestire le rotte del guest */
use App\Http\Controllers\GuestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Rotte per i guest
// Route::prefix('guest')->group(function () {
//     Route::get('/', [GuestController::class, 'index'])->name('guest.index');  // Mostra lista appartamenti
//     Route::get('/apartment/{id}', [GuestController::class, 'show'])->name('guest.show');  // Mostra dettagli appartamento
// });
// /* Rotte per la ricerca degli appartamenti */
// Route::get('/search', [GuestController::class, 'search'])->name('guest.search');




// Route::get('/', function () {
//     return view('/pages/welcome');
// });

// Route::get('/', function () {
//     return redirect()->route('home');
// });

Route::get('/', function () {
    if (Auth::check()) {
        // Se l'utente è autenticato, reindirizzalo alla pagina dei suoi appartamenti
        return redirect()->route('user.apartments.index');
    } else {
        // Se non è autenticato, reindirizzalo alla pagina di login
        return redirect()->route('login');
    }
});




Auth::routes();

// Route::get('/home', [GuestController::class, 'index'])->name('home');
// // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->name('user.')->prefix('user/')->group(function () {
    Route::get('/apartments', [UserApartmentController::class, 'index'])->name('apartments.index');
    Route::get('/apartments/deleted', [UserApartmentController::class, 'deletedIndex'])->name('apartments.deleted');
    Route::patch('/apartments/{apartment}/restore', [UserApartmentController::class, 'restore'])->name('apartments.restore');
    Route::delete('/apartments/{apartment}/permanent-delete', [UserApartmentController::class, 'permanentDelete'])->name('apartments.permanent.delete');
    Route::resource('/apartments', UserApartmentController::class);
});