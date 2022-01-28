<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('config.accueil', ['clients' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('users.creer_utilisateur');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        //validate the fields
        
        $validator = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required|same:password',
            'is_admin' => 'required'
        ],
        [
            'is_admin.required' => "Choisir le type d'utilisateur SVP!"
        ]);


        $user->create([
            'name' =>  $request->name,
            'email' =>  $request->email,
            'is_admin' => $request->is_admin,
            'password' => Hash::make($request->password),
        ]);



        /*
        if($request->role != null){
            $user->roles()->attach($request->role);
            $user->save();
        }

        if($request->permissions != null){            
            foreach ($request->permissions as $permission) {
                $user->permissions()->attach($permission);
                $user->save();
            }
        }
        */
        
        return redirect('/config')->with('message', "Vous avez crée avec succès le nouveau utilisateur.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::whereId($id)->first();
        return view('users.modifier_utilisateur', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {

        //validate the fields
        if($request->password == NULL) {
            $request->validate([
                'name' => 'required|max:50',
                'email' => 'required|email|max:100',
                'is_admin' => 'required'
            ]);

        }else{
            $request->validate([
                'name' => 'required|max:50',
                'email' => 'required|email|max:100',
                'password' => 'required|between:8,255|confirmed',
                'password_confirmation' => 'required|same:password',
                'is_admin' => 'required'
            ]);
        }


        //dd($user->find($request->id)->password);

        $pass = $user->find($request->id)->password;

        if($request->password != null){
            $pass = Hash::make($request->password);
        }else{
            $pass = $user->find($request->id)->password;
        }
        

        //mise à jour des données dans le base de donnée.
        $user->find($request->id)->update([
            'name' =>  $request->name,
            'email' =>  $request->email,
            'password' => $pass,
            'is_admin' => $request->is_admin,
        ]);

    

/*
        $user->roles()->detach();
        $user->permissions()->detach();

        if($request->role != null){
            $user->roles()->attach($request->role);
            $user->save();
        }

        if($request->permissions != null){            
            foreach ($request->permissions as $permission) {
                $user->permissions()->attach($permission);
                $user->save();
            }
        }
*/
        return redirect('/config')->with('message', "Vous avez Modifé avec succès le utilisateur ".$request->name);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id) {

              // supprimer la ligne correspondance dans le base de données.
              $user->where('id', $id)->delete();        
              
              return redirect('/config')->with('message', "Le utilisateur est supprimer avec succès..");
    }
}