<?php

namespace App\Http\Controllers;

use App\Models\API;
use Illuminate\Http\Request;

// Models
use App\Models\Clients;
use App\Models\Fichiers;
use App\Models\ResultatCheck;
use App\Models\Alerts;

// Controllers
use App\Http\Controllers\Clients\ClientsController;
use App\Http\Controllers\Fichiers\FichiersController;
use App\Http\Controllers\ResultatCheckController;
use App\Http\Controllers\AlertsController;



class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Clients::all();
        return response()->json(['clients' => $data]);
        //return response()->json(['message' => "hello"]); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request) {
        
        $request_length = count($request->json());      // GET longueure de données (array) reçu dans le request.
        $messages = [];         // variable pour stocker le message et envoyer à la fin au utilisateur.

        // créer instance de model suivant
        $client = new Clients;
        $file = new Fichiers;
        $resultatCheck = new ResultatCheck;
       
        // verifiées si les données envoyer par client sont pas vide
        if (empty($request[0])){
            return response()->json(['message' => "aucune données sont reçu try."]);
        }

        // si le email n'est pas vide
        if ($request[0]['client_email'] != Null ){
            $client_existe = Clients::where('email', $request[0]['client_email'])->first();     // variable qui compare le email reçu avec les emails de base de données.

            // check if client not existe
            // On verifiée que le premier array de request car on est ici dans le condition si le client n'existe pas
            if ( $client_existe == NULL ){
                $new_request= new Request($request[0]);       // On crée un instance de request avec les données qu'on a reçu ( on change le type array en type request ).

                // Crée le nouveau client en appellant le fonction store de ClientsController
                ClientsController::store($new_request, $client);

                $messages[] = "Client est sauvgardé avec succes.";
            }else{
                // Boucle 
                for ($index=0; $index < $request_length ; $index++) { 
                    
                    $get_client_id = Clients::where('email', $request[0]['client_email'])->first()->id;         // GET id de client 
                    $file_existe = Fichiers::where('client_id', $get_client_id)->where('Chemin_de_fichier', $request[$index]['file_path'])->first();    // query pout savoir si le fichier existe déja dans le base de données.
                    $alert = $request[$index]['alert'];     // GET le variable alert reçu.
                    $new_request = new Request($request[$index]);       // on change le type array on type request

                    // Si le fichier n'existe pas
                    if ($file_existe == NULL ){
                        $alert_message = "et alerts n'existe pas!";             // message d'alert par default.
                        $new_request->merge(['client_id' => $get_client_id]);        // Ajoute le variable client_id dans le request

                        // ajouter les informations dans le table fichiers
                        FichiersController::store($new_request, $file);
                        $messages[] = "Fichier est ajouter avec succces!";

                        // On GET dernier ID de la table fichier pour ajouter dans le table resultatcheck.
                        $last_inserted_file_id = Fichiers::where('client_id', $get_client_id)->latest('id')->first()->id; 

                        $new_request->merge(['file_id' => $last_inserted_file_id]);        // Ajoute le variable client_id dans le request

                        // ajouter les informations dans le table resultat_check
                        ResultatCheckController::store($new_request, $resultatCheck);
                        $messages[] = "les information sont ajouter avec success dans le table Resultat-Check.";

                        // Si l'alert est true dans le donnée reçu.
                        if ($alert){
                            $req = new Request;                 // On crée nouveau instance de request
                            $req->merge(['file_id' =>  $last_inserted_file_id]);        // On insére file_id dans le request

                            // Ajouter alerts dans le base de données
                            AlertsController::store($req);
                            
                            $alert_message = "et alerts existe, est ajoute avec succes";
                        }

                        $messages[] = "Fichier est ajouter avec success ".$alert_message;
                        
                    }else{  // Si fichier existe déjà.
                        
                        $get_file_id = Fichiers::where('client_id', $get_client_id)->where('Chemin_de_fichier', $request[$index]['file_path'])->first()->id;    // GET id de fichier
                        $new_request->merge(['file_id' => $get_file_id]);        // Ajoute le variable client_id dans le request

                        $alert_message = "alerts n'existe pas!";
                        // Si l'alert est true.
                        if ($alert){
                            $req = new Request;     // On crée un instance de model request.
                            $req->merge(['file_id' =>  $get_file_id]);    //on insére que le file_id dans le request.

                            // Ajouter alerts dans le table de alerts en base de données
                            AlertsController::store($req);

                            // Retourner le reponse.
                            $alert_message = "alerts existe et alert est ajouter avec success dans le table d'alerts.";
                        }
                        // Si l'Alert n'est pas vrai dans le request reçu ( si aleert = false )

                        // Ajouter le resultat de check dans le table resultat_check
                        ResultatCheckController::store($new_request, $resultatCheck);

                        $messages[] = "Fichier est ajouter avec success dans le table de checkresult ".$alert_message;

                    }
                } // Fin de loop
            }
        }else{
            $messages[] = "client not existe";
        }

        return response()->json(['message' => $messages]);
    }


    public function show(API $aPI)
    {
        //
    }

   
    public function edit(API $aPI)
    {
        //
    }



    public function update_client(Request $request)
    {
        
        $client_exist = Clients::where('email', $request->email)->get();      // Check if client exist
        
        if(sizeof($client_exist) > 0){ // if client exist
            $client = Clients::where('email', '=', $request->email)->first();
            $client->update([
                'nom_entreprise' =>  $request->nom_entreprise,
                'site' =>  $request->site,
                'nom_client' => $request->nom_client,
                'mobile' => $request->mobile,
            ]);

            return response()->json(['message' => "et dans le serveur console management!"]); 
        } else {    
            Clients::create([
                'nom_entreprise' =>  $request->nom_entreprise,
                'site' =>  $request->site,
                'nom_client' => $request->nom_client,
                'mobile' => $request->mobile,
                'email' => $request->email,
            ]);
            return response()->json(['message' => " et dans le dans le serveur console management!"]); 
        }   
    }    

    public function destroy(API $aPI)
    {
        //
    }
}
