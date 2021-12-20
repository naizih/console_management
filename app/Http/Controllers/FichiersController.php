<?php

namespace App\Http\Controllers;

use App\Models\Fichiers;
use Illuminate\Http\Request;

class FichiersController extends Controller
{
 
    public function index()
    {
        //
    }

 
    public function create()
    {
        //
    }

  
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
     * @param  \App\Models\Fichiers  $fichiers
     * @return \Illuminate\Http\Response
     */
    public function show(Fichiers $fichiers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fichiers  $fichiers
     * @return \Illuminate\Http\Response
     */
    public function edit(Fichiers $fichiers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fichiers  $fichiers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fichiers $fichiers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fichiers  $fichiers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fichiers $fichiers)
    {
        //
    }
}
