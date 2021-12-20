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
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\FichiersController;
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
       
        // créer instance de model suivant
        $client = new Clients;
        $file = new Fichiers;
        $resultatCheck = new ResultatCheck;
       
        // verifiées si les données envoyer par client sont pas vide
        if (empty($request[0])){
            return response()->json(['message' => "aucune données sont reçu."]);
        }
        
        // Si il y a des données sont present dans le request
        for ($index = 0; $index<$request_length; $index++ ){

            // GET information de variable correspondance reçu depuis client.
            $client_email_received = $request[0]['client_email'];       // on prendre le email de premier array car tous les données dans le meme request(array) vient de meme client.
            $file_path_received = $request[$index]['file_path'];        // On GET le path de chaque fichier reçu
            $alert = $request[$index]['alert'];     // GET le variable alert reçu.

            $new_request = new Request($request[$index]);       // on change le type array on type request

            // Verification des données reçu si ils sont vide ou pas
            // Si l'email et le chemin de fichier n'est pas vide
            if (!empty($client_email_received) && !empty($file_path_received)){
                // GET information correspondance à ce condition depuis le base de données.
                $file_row_database = Fichiers::where('Chemin_de_fichier', $file_path_received)->first();      // GET ALL data correspondaning to client
                $client_row_database = Clients::where('email', $client_email_received)->first();      // comparer le email reçu avec le email dans le base de données 
                
                // Verifié si le email reçu est différent de celle dans le base de données.
                // Si le client existe déja dans le base de données
                if($client_row_database !== NULL){
                    $last_inserted_file_id = Fichiers::latest('id')->first()->id;       // GET dernier id dans le table de fichier
                    $client_id = $client_row_database['id'];        // GET client ID

                    // Verifiée Si le fichier existe déja dans le base de données
                    if ($file_row_database !== null){
                        
                        // models
                        //$resultatCheck = new ResultatCheck;     // On créer un instant resultatCheck de model ResultatCheck
                        $last_inserted_file_id = Fichiers::latest('id')->first()->id; 

                        // Variables
                        $file_ID = $file_row_database['id'];       // GET file ID
                        $alert_message = "alerts n'existe pas!";
                        $new_request->merge(['file_id' => $last_inserted_file_id]);        // Ajoute le variable client_id dans le request
                        
                        // Ajouter alerts ( on ajoute alert si le client et fichier existe )
                        // Si il y a un alert dans le fichier reçu on ajoute un alert dans le tableau alert de base de données.
                        if ($alert){
                            // On crée nouveau request
                            // on peut envoyer le request qui est déja crée mais dans le request on envoie tous les données 
                            // mais on veut que on envoie que une ligne dans le request.
                            $req = new Request;
                            $req->merge(['file_id' =>  $file_row_database['id']]);

                            // Ajouter alerts dans le base de données
                            AlertsController::store($req);

                            // Retourner le reponse.
                            $alert_message = "alerts existe et alert est ajouter avec success dans le table d'alerts.";
                        }
                        // Si l'Alert n'est pas vrai dans le request reçu ( si aleert = false )

                        // Ajouter le resultat de check dans le table resultat_check
                        ResultatCheckController::store($new_request, $resultatCheck);

                        // retourne le response avec le messsage
                        return response()->json(['message' => "Fichier est ajouter avec success dans le base de données, ".$alert_message]);                    
                    
                    }else{  // Si le fichier n'existe pas dans le base de donnéees mais le client s'existe.
                        
                        $alert_message = ".";
                        
                        $new_request->merge(['client_id' => $client_id]);        // Ajoute le variable client_id dans le request

                        // ajouter les informations dans le table fichiers
                        FichiersController::store($new_request, $file);

                        // On GET dernier ID de la table fichier pour ajouter dans le table resultatcheck.
                        $last_inserted_file_id = Fichiers::latest('id')->first()->id; 
                        $new_request->merge(['file_id' => $last_inserted_file_id]);        // Ajoute le variable client_id dans le request

                        // ajouter les informations dans le table resultat_check
                        ResultatCheckController::store($new_request, $resultatCheck);

                        if ($alert){
                            // On crée nouveau request
                            $req = new Request;
                            $req->merge(['file_id' =>  $last_inserted_file_id]);

                            // Ajouter alerts dans le base de données
                            AlertsController::store($req);

                            // Retourner le reponse.
                            $alert_message = "et alerts!";
                        }

                        // Retourne la reponse
                        return response()->json(['message' => "les information sont ajouter avec success dans le table fichiers, Resultat-Check ".$alert_message]);
                    }

                }else{  // SI le client n'existe pas déja dans le base de données 

                    // On verifiée que le premier array de request car on est ici dans le condition si le client n'existe pas
                    // après insérer le client on ne vien pas dans ce condition.
                    $new_request= new Request($request[$index]);       // on change le type array en type request

                    // Crée le client en appellant le fonction store de ClientsController
                    ClientsController::store($new_request, $client);

                    // Après créer le client on GET son ID et on l'ajoute dans le request.
                    $client_id = Clients::where('email', $client_email_received)->first()->id;      // GET client ID
                    $new_request->merge(['client_id' => $client_id]);        // Ajoute le variable client_id dans le request

                    // ajouter les informations dans le table fichiers
                    // Si le client ne s'existe pas alors il n'aucune fichiers aussi dans le table de fichiers. 
                    FichiersController::store($new_request, $file);

                    
                    // On GET dernier ID de la table fichier pour ajouter dans le table resultatcheck.
                    $last_inserted_file_id = Fichiers::latest('id')->first()->id; 
                    $new_request->merge(['file_id' => $last_inserted_file_id]);        // Ajoute le variable client_id dans le request

                    // ajouter les informations dans le table resultat_check
                    ResultatCheckController::store($new_request, $resultatCheck);


                    // Ajouter Alerts
                    // on ne traite pas cette condition ici, car c'est le premier request qui vient de client et
                    // c'est presque impossible que le client créer son compte et ajouter un fichier et le hash de fichier 
                    // sera différent.
    
                    return response()->json(['message' => "Client est crée avec success et le premier fichier est aussi ajouter, et en plus le resultat de check est sauvegarder! "]);
                }

            } else{ // Si email et path est vide dans les données recu.
                return response()->json(['message' => "Verifiée si le client et le fichier sont bien engregistré chez client serveur!"]);
            }
        }
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
