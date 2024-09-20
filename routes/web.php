<?php

use App\Http\Controllers\Admin\BraintreeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ApartmentController as UserApartmentController;
use App\Http\Controllers\User\MessageController as UserMessageController;
use App\Http\Controllers\User\SponsorController as UserSponsorController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GuestController;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('user.apartments.index') : redirect()->route('login');
});

Route::get('/search', [GuestController::class, 'search'])->name('guest.search');

Auth::routes();

Route::get('/home', function () {
    return redirect()->route('user.apartments.index');
})->name('home');

// Rotte protette da autenticazione per gli utenti
Route::middleware('auth')->name('user.')->prefix('user/')->group(function () {
    Route::resource('/apartments', UserApartmentController::class);
    Route::get('/apartments/deleted', [UserApartmentController::class, 'deletedIndex'])->name('apartments.deleted');
    Route::patch('/apartments/{apartment}/restore', [UserApartmentController::class, 'restore'])->name('apartments.restore');
    Route::delete('/apartments/{apartment}/permanent-delete', [UserApartmentController::class, 'permanentDelete'])->name('apartments.permanent.delete');
    Route::get('/messages', [UserMessageController::class, 'showMessagesForOwner'])->name('messages.index');
    Route::get('/sponsors/{apartment}', [UserSponsorController::class, 'sponsorshipsIndex'])->name('sponsorships.index');
    Route::post('/sponsors/{apartment}/assign', [UserSponsorController::class, 'assignSponsor'])->name('sponsorships.assign');
});

// Rotte per il pagamento Braintree
Route::middleware('auth')->group(function () {
    // Rotta per mostrare la pagina di pagamento
    Route::get('/payment', [BraintreeController::class, 'token'])->name('token');

    // Rotta POST per gestire il pagamento e assegnare lo sponsor
    Route::post('/payment', [BraintreeController::class, 'processPayment'])->name('payment');
});