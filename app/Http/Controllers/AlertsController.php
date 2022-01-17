<?php

namespace App\Http\Controllers;

use App\Models\Alerts;
use Illuminate\Http\Request;

class AlertsController extends Controller
{
    public function index()
    {
        // redirection vers la page de alert
        $all_file = Alerts::all();
        if ( count($all_file) > 8 ){
            $paginate = Alerts::paginate(8);
            return view('fichiers.fichier_alert', ['fichiers' => $paginate]);
        }else{
            return view('fichiers.fichier_alert', ['fichiers' => $all_file]);
        }
    }



    public function filter(Request $request){
        
        //dd(Alerts::orderBy('gerer', 'desc')->get());

        //$fichiers = Alerts::orderBydesc('gerer', '1')->paginate(8);   
        if ( $request->filter  == 'alert_success') {
            $fichiers = Alerts::orderBy('gerer', 'asc')->orderBy('created_at', 'desc')->paginate(8);   
        }

        if ( $request->filter  == 'alert_gerer') {
            $fichiers = Alerts::orderBy('gerer', 'desc')->orderBy('created_at', 'asc')->paginate(8);   
        }

        return view('fichiers.fichier_alert', ['fichiers' => $fichiers]);

    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'file_id' => 'required',
        ]);

        // Inséerer les données dans le base de données.
        Alerts::create([
            'file_id' =>  $request->file_id,
        ]);
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alerts  $alerts
     * @return \Illuminate\Http\Response
     */
    public function show(Alerts $alerts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alerts  $alerts
     * @return \Illuminate\Http\Response
     */
    public function edit(Alerts $alerts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alerts  $alerts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alerts $alerts)
    {
        //
        $request->validate([
            'id' => 'required',
        ]);

        $alerts->where('id', $request->id)->update([
            'gerer' => '1'
        ]);

        return redirect('/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alerts  $alerts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alerts $alerts)
    {
        //
    }
}
