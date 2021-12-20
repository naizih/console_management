<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Clients::first();
        return response()->json(['data' => $data]);
        //dd($data);
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
    public function store(Request $request, Clients $client )
    {
        //

        //var_dump($request);
        
        
        $validator = $request->validate([
            'nom_entreprise' => 'required',
            'site' => 'required',
            'nom_client' => 'required',
            'mobile' => 'required',
            'client_email' => 'required',
        ]);

        // we use direst methode herer because of API also use this function
        $client->create([
            'nom_entreprise' =>  $request->file_name,
            'site' =>  $request->site,
            'nom_client' => $request->nom_client,
            'mobile' => $request->mobile,
            'email' => $request->client_email,
        ]);
        

        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function show(Clients $clients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit(Clients $clients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clients $clients)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clients $clients)
    {
        //
    }
}
