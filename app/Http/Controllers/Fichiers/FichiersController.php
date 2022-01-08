<?php

namespace App\Http\Controllers\Fichiers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fichiers;
use App\Models\Alerts;
use App\Models\Clients;

class FichiersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // redirection vers la page de recher fichier
        return view('fichiers.fichier_home');
    }


    public function search(Request $request){
        //dd($request->search);

        // Après afficher pleusieur entreprise de meme nom si l'utilisateur clique sur un de lien il arrive dans ce condition
        //dd($request->search);

        
        if (isset($request->search) && $request->search == 'second') {
            $fichiers = Fichiers::where('client_id', $request->second_search)->get();
            if (count($fichiers) > 0 ){
                return view('fichiers.fichier_home', ['fichiers' => $fichiers, 'nb_client' => 1]);
            }
            return back()->with('fail',' le Client n\'a pas des fichiers !');
        }
        

        if (isset($request->search) && $request->search == 'first') {
            if ($request->recherch != Null ){
                $search = $request->recherch;
                $client_ids = Clients::where('nom_entreprise', 'LIKE', '%'.$search.'%')->where('accepter', '1')->get();
                $res = [];

                if ($client_ids->first() == Null ){
                    return back()->with('fail','On ne trouve pas l\'entreprise avec le mot clé que vous entrée !');
                }

                //dd(count($client_ids));
                for ($index=0; $index < count($client_ids) ; $index++) { 
                    $res[] = $client_ids[$index]->id;
                }

                if (count($res) > 1 ){
                    $result = [];

                    for ($index=0; $index < count($res) ; $index++) { 
                        $result[] = [
                            'id' => $res[$index],
                            'entreprise' =>  Clients::whereid($res[$index])->first()->nom_entreprise,
                            'email' => Clients::whereid($res[$index])->first()->email
                        ];
                    }

                    //dd($result);
                    return view('fichiers.fichier_home', ['clients' => $result, 'nb_client' => count($res) ]);
                }
                
                $fichiers = Fichiers::where('client_id', $res[0])->get();
                //dd(count($fichiers));
                return view('fichiers.fichier_home', ['fichiers' => $fichiers, 'nb_client' => count($res)]); 
            }
            return back()->with('fail','Votre recherche est vide, S\'il vous okait ecrire le nom d\'entreprise pour rechercher les fichier correspondance !');
        }
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Fichiers $file ) {

        // validation de données 
        //var_dump($request);
        
        $validator = $request->validate([
            'client_id' => 'required',
            'file_name' => 'required',
            'file_path' => 'required',
            'last_check' => 'required',
        ]);

        // Inséerer les données dans le base de données.
        $file->create([
            'client_id' => $request->client_id,
            'nom_de_fichier' =>  $request->file_name,
            'Chemin_de_fichier' => $request->file_path,
            'date_du_dernier_check' => $request->last_check,
        ]);
        
        
        return redirect('/');
        //return response()->json(['message' => "Fichier sont ajouter avec success dans le base de données."]);

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Request $request)
    {
        //
        //dd($request->id);
        $fichiers = Fichiers::whereclient_id($request->id)->get();

        if(count($fichiers) != 0){
            return view('fichiers.fichier_client', ['fichiers' => $fichiers]);
        }
        return redirect()->back()->with('fail','cette client n\'a pas ajouter encore les fichiers Appats!'); 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
