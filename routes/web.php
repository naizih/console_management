<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Clients\ClientsController;
use App\Http\Controllers\Fichiers\FichiersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlertsController;
use App\Http\Controllers\Config\ConfigController;



//Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);


Route::get('/', function(){
    return redirect('home');
});


Route::name('user.')->group(function(){


    //Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');



    Route::middleware(['auth:web', 'PreventBackHistory'])->group(function(){

        Route::get('/clients', [ClientsController::class, 'index'])->name('clients');
        Route::get('/client_info/{id}/details', [ClientsController::class, 'show']);

        Route::get('/fichiers', [FichiersController::class, 'index'])->name('fichiers');
        Route::post('/fichiers/clients', [FichiersController::class, 'show'])->name('fichier_client');

        Route::get('/alerts', [AlertsController::class, 'index'])->name('alerts');
        Route::put('/alert-gerer', [AlertsController::class, 'update'])->name('alert-gerer');
        Route::post('/alert-filter', [AlertsController::class, 'filter'])->name('alert-filter');

        Route::post('/fichiers', [FichiersController::class, 'search'])->name('recherch_fichier');



        Route::get('/config', [ConfigController::class, 'index'])->name('config');



        
        Route::post('user-request', [ClientsController::class, 'user_request'])->name('user-request');



        // Tabs
        Route::get('/home/clients-accepter', [ClientsController::class, 'clients_accepter'])->name('clients-accepter');
        Route::get('/home/clients-rejeter', [ClientsController::class, 'clients_rejeter'])->name('clients-rejeter');




        Route::post('/logout', [ClientsController::class, 'logout'])->name('logout');
    });


    //Route::middleware(['guest:web','PreventBackHistory'])->group(function(){ });

    //Route::middleware(['auth:web','PreventBackHistory'])->group(function(){ });
});






