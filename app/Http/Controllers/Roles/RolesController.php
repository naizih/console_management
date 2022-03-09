<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;


use App\Models\User;

class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->authorize('crud_roles', User::class);

        $roles = Role::orderBy('id', 'asc')->get();
        return view('roles.afficher_roles', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('crud_roles', User::class);
        $permissions = Permission::get();
        return view('roles.ajouter_role', compact('permissions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Role $role){

        $this->authorize('crud_roles', User::class);

        $validator = $request->validate([
            'role' => 'required|max:255',
            'label' => 'required|max:255',
        ]);

        $role->name = $request->role;
        $role->slug = strtolower(str_replace(" ", "_", $request->label));
        $role->save();

        $role->permissions()->sync($request->permissions);

        return redirect('/admin/roles')->with('message', "Vous avez crée avec succès le nouveau role.");


        /*
        //validate the role fields
        $request->validate([
            'role_name' => 'required|max:255',
            'role_slug' => 'required|max:255'
        ]);

        $role = new Role();

        $role->name = $request->role_name;
        $role->slug = $request->role_slug;
        $role-> save();

        $listOfPermissions = explode(',', $request->roles_permissions);//create array from separated/coma permissions
        
        foreach ($listOfPermissions as $permission) {
            $permissions = new Permission();
            $permissions->name = $permission;
            $permissions->slug = strtolower(str_replace(" ", "-", $permission));
            $permissions->save();
            $role->permissions()->attach($permissions->id);
            $role->save();
        }    

        return redirect('/roles');
        */

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('crud_roles', User::class);
        
        $role = Role::whereId($id)->first();
        $permissions = Permission::get();
        return view('roles.modifier_role',['role' => $role, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role, $id)
    {

        $this->authorize('crud_roles', User::class);
        
        //validate the role fields
        $request->validate([
            'role' => 'required|max:255',
            'label' => 'required|max:255',
        ]);

        /*

        //mise à jour des données dans le base de donnée.
        $role->find($id)->update([
            'name' =>  $request->role,
            'slug' =>  strtolower(str_replace(" ", "_", $request->label)),
        ]);
        */

        $role = $role->find($id);

        $role->name = $request->role;
        $role->slug = strtolower(str_replace(" ", "_", $request->label));
        $role->save();


        $role->permissions()->sync($request->permissions);


/*
        if($request->permissions != NULL) {
            foreach ( $request->permissions as $permission ){
                $role->permissions()->attach($permission);
                $role->role_ligne()->associate($role_ligne);
                $role->save();
            }
        }
*/

        return redirect('/admin/roles')->with('message', "Vous avez Modifé avec succès le role.");
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, $id) {
        
        $this->authorize('crud_roles', User::class);

        // supprimer la ligne correspondance dans le base de données.
        $role->where('id', $id)->delete();        
        return redirect('/admin/roles')->with('message', "La role est supprimer avec succès.");
    }
}