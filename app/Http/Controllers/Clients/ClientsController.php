<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Clients;
use Illuminate\Support\Facades\Auth;


class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate = Clients::paginate(12);
        return view('clients.afficher_clients', ['clients' => $paginate]);
    }

    // fonction pour afficher les clients accepter
    function clients_accepter(){

        $clients = Clients::all()->where('accepter', '1');
        //dd(count($clients));
        if ( count($clients) > 12 ){
            $paginate = Clients::where('accepter', '1')->paginate(12);
            return view('clients.tab_client_accepter', ['clients' => $paginate]);
        }else{
            return view('clients.tab_client_accepter', ['clients' => $clients]);
        }
    }


    // fonction pour afficher les clients rejeter
    function clients_rejeter(){

        $clients = Clients::all()->where('accepter', '0');
        if ( count($clients) > 12 ){
            $paginate = Clients::where('accepter', '0')->paginate(12);
            return view('clients.tab_client_rejeter', ['clients' => $paginate]);
        }else{
            return view('clients.tab_client_rejeter', ['clients' => $clients]);
        }

    }


    function user_request(Request $request){
        $client = new Clients;

        if(isset($request->send) && $request->send == 'accept'){
            $client->whereid($request->id)->update([
                'accepter' => '1'
            ]);

            return redirect()->back()->with('success', 'user has been acivate it with success.');
        }

        if(isset($request->send) && $request->send == 'deny'){
            $client->whereid($request->id)->update([
                'accepter' => '0'
            ]);

            return redirect()->back()->with('fail', 'user has been rejecte it with success.');
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
            'nom_entreprise' =>  $request->nom_entreprise,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $client = Clients::whereid($id)->first();
        return view('clients.Afficher_client_info', ['client' => $client]);
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

    function logout(){
        Auth::guard('web')->logout();
        return redirect('/home');
    }
}
