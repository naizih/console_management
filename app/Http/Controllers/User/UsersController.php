<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
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
        $this->authorize('crud_utilisateurs', User::class);

        $users = User::all();
        $first_user = User::first();
        return view('users.afficher_utilisateurs', ['users' => $users, 'first_user' => $first_user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
     
        $this->authorize('crud_utilisateurs', User::class);
        
        $roles = Role::get();
        return view('users.creer_utilisateur', compact('roles'));
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

        $this->authorize('crud_utilisateurs', $user);
        
        $validator = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required|same:password',
            'role_id' => 'required'
        ],
        [
            'is_admin.required' => "Choisir le type d'utilisateur SVP!"
        ]);


        $user->create([
            'name' =>  $request->name,
            'email' =>  $request->email,
            'is_admin' => '0',
            'password' => Hash::make($request->password),
            'role_id'   => $request->role_id,
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
        
        return redirect('/admin/utilisateurs')->with('message', "Vous avez crée avec succès le nouveau utilisateur.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //return view('admin.users.show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('crud_utilisateurs', User::class);
     
        $user = User::whereId($id)->first();
        $roles = Role::get();
        $permissions = Permission::get();
        return view('users.modifier_utilisateur', ['user' => $user, 'roles' => $roles, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {

        $this->authorize('crud_utilisateurs', $user);
        
        //validate the fields
        if($request->password == NULL) {
            $request->validate([
                'name' => 'required|max:50',
                'email' => 'required|email|max:100',
                'role_id'   => 'required'
            ]);
        }else{
            $request->validate([
                'name' => 'required|max:50',
                'email' => 'required|email|max:100',
                'password' => 'required|between:8,255|confirmed',
                'password_confirmation' => 'required|same:password',
                'role_id'   => 'required'
            ]);
        }
        

        $pass = $user->find($request->id)->password;

        if($request->password != null){
            $pass = Hash::make($request->password);
        }else{
            $pass = $user->find($request->id)->password;
        }
        
        
        $user = $user->find($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $pass;
        $user->role_id = $request->role_id;
        $user->save();


        return redirect('/admin/utilisateurs')->with('message', "Vous avez Modifé avec succès le utilisateur ".$request->name);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id) {

        $this->authorize('crud_utilisateurs', User::class);

        // supprimer la ligne correspondance dans le base de données.
        $user->where('id', $id)->delete();        
              
        return redirect('/admin/utilisateurs')->with('message', "Le utilisateur est supprimer avec succès..");
    }
}