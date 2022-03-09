<?php

namespace App\Http\Controllers;

use App\Models\ResultatCheck;
use Illuminate\Http\Request;

class ResultatCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, ResultatCheck $resultatCheck)
    {
        //
        $validator = $request->validate([
            'file_id' => 'required',
            'check_result' => 'required',
        ]);

        // Inséerer les données dans le base de données.
        $resultatCheck->create([
            'file_id' =>  $request->file_id,
            'resultat_check' =>  $request->check_result,
        ]);
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResultatCheck  $resultatCheck
     * @return \Illuminate\Http\Response
     */
    public function show(ResultatCheck $resultatCheck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResultatCheck  $resultatCheck
     * @return \Illuminate\Http\Response
     */
    public function edit(ResultatCheck $resultatCheck)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResultatCheck  $resultatCheck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResultatCheck $resultatCheck)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResultatCheck  $resultatCheck
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResultatCheck $resultatCheck)
    {
        //
    }
}
