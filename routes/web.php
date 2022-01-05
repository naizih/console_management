<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Clients\ClientsController;
use App\Http\Controllers\Fichiers\FichiersController;






Route::name('user.')->group(function(){

    Route::get('/', [DashboardController::class, 'index'])->name('home');


    Route::get('/clients', [ClientsController::class, 'index'])->name('clients');
    Route::get('/client_info/{id}/details', [ClientsController::class, 'show']);

    Route::get('/fichiers', [FichiersController::class, 'index'])->name('fichiers');
    Route::post('/fichiers/clients', [FichiersController::class, 'show'])->name('fichier_client');

    Route::get('/alerts', [FichiersController::class, 'alert'])->name('alerts');

    Route::post('/fichiers', [FichiersController::class, 'search'])->name('recherch_fichier');


    //Route::middleware(['guest:web','PreventBackHistory'])->group(function(){ });

    //Route::middleware(['auth:web','PreventBackHistory'])->group(function(){ });
});



