<?php

use App\Http\Controllers\PetitionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PetitionController::class, 'show'])->name('petition.show');

Route::get('/stats', [PetitionController::class, 'stats'])->name('petition.stats');

Route::post('/signer', [PetitionController::class, 'sign'])
    ->middleware('throttle:10,1')
    ->name('petition.sign');

Route::get('/legal/{slug}', [PetitionController::class, 'legal'])
    ->whereIn('slug', [
        'conditions-utilisation',
        'politique-utilisation-donnees',
    ])
    ->name('legal.show');
