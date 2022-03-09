<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;
use App\Models\Alerts;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $paginate_alert = Alerts::all()->where('gerer', '0');
        if ( count($paginate_alert) > 4 ){
            $paginate_alert = Alerts::where('gerer', '0')->paginate(4, ['*'], 'pagination_alert');
        }


        $paginate_client = Clients::where('accepter', NULL)->get();
        if ( count($paginate_client) > 4 ){
            $paginate_client = Clients::where('accepter', Null)->paginate(4, ['*'], 'pagination_client');
        }

        //$clients = Clients::where('accepter', Null)->get();
        //$fichiers = Alerts::paginate(4);
        return view('accueil', ['clients' => $paginate_client, 'alerts' => $paginate_alert]);
    }

}
