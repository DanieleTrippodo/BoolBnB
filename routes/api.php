<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\User\MessageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* CRUD per l'user */
Route::resource('user', UserController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Lista appartamenti
Route::get('/apartments', [GuestController::class, 'index']);

// Dettagli appartamento
Route::get('/apartments/{id}', [GuestController::class, 'show']);

// Ricerca avanzata degli appartamenti
Route::get('/search', [GuestController::class, 'search'])->name('guest.search');

// Ottenere tutti i servizi extra
Route::get('/extra-services', [GuestController::class, 'getAllExtraServices']);

// Assegnare uno sponsor a un appartamento
Route::post('/apartments/{id}/assign-sponsor', [GuestController::class, 'assignSponsor']);

// Invia messaggio
Route::post('/messages', [MessageController::class, 'store']);
