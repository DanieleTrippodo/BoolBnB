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




Route::get('/apartments', [GuestController::class, 'index']);  // Lista appartamenti
Route::get('/apartments/{id}', [GuestController::class, 'show']);  // Dettagli appartamento
Route::get('/search', [GuestController::class, 'search'])->name('guest.search');

/* Aggiornato */
Route::post('/apartments/{apartment}/messages', [MessageController::class, 'store'])->name('api.messages.store');

/* per mostrare gli appartamenti agli utenti non registrati */
Route::get('/apartments', [GuestController::class, 'getAllApartments'])->name('api.apartments.index');
