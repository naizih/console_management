<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\APIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/connexion', function(){
	return response()->json([
		'etat' => "connected",
	]);
});


// API pour afficher tous les clients. 
Route::get('/clients', [APIController::class, 'index']);

//Route::post('/add_client', [APIController::class, 'add_client']);
Route::post('/update_client', [APIController::class, 'update_client']);




// Route API, Pour sauvegarder les données envoyer par un client.
Route::post('/resultat_check', [APIController::class, 'store']);
