<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Permission;

class PermissionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $this->authorize('crud_permissions', User::class);

        $Permissions = Permission::orderBy('id', 'asc')->get();
        return view('permissions.afficher_permissions', ['permissions' => $Permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('crud_permissions', User::class);
        
        return view('permissions.ajouter_permission');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Permission $Permission){


        $this->authorize('crud_permissions', User::class);
        
        $validator = $request->validate([
            'permission' => 'required|max:255',
            'label' => 'required|max:255',
        ]);


        $Permission->create([
            'name' =>  $request->permission,
            'slug' =>  strtolower(str_replace(" ", "_", $request->label)),
        ]);


        return redirect('/admin/permissions')->with('message', "Vous avez crée avec succès le nouveau Permission.");


        /*
        //validate the Permission fields
        $request->validate([
            'Permission_name' => 'required|max:255',
            'Permission_slug' => 'required|max:255'
        ]);

        $Permission = new Permission();

        $Permission->name = $request->Permission_name;
        $Permission->slug = $request->Permission_slug;
        $Permission-> save();

        $listOfPermissions = explode(',', $request->Permissions_permissions);//create array from separated/coma permissions
        
        foreach ($listOfPermissions as $permission) {
            $permissions = new Permission();
            $permissions->name = $permission;
            $permissions->slug = strtolower(str_replace(" ", "-", $permission));
            $permissions->save();
            $Permission->permissions()->attach($permissions->id);
            $Permission->save();
        }    

        return redirect('/Permissions');
        */

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $Permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $Permission)
    {
        //return view('admin.permissions.show', ['Permission' => $Permission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $Permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('crud_permissions', User::class);

        $Permission = Permission::whereId($id)->first();
        return view('permissions.modifier_permission',['permission' => $Permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $Permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $Permission, $id) {

        $this->authorize('crud_permissions', User::class);
        
        //validate the Permission fields
        $request->validate([
            'nom_permission' => 'required|max:255',
        ]);


        $permission = $Permission->find($id);
        
        $permission->name = $request->nom_permission;
        //$permission->slug = strtolower(str_replace(" ", "_", $request->label));
        $permission->save();


        return redirect('/admin/permissions')->with('message', "Vous avez Modifé avec succès le Permission.");
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $Permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission, $id) {

        $this->authorize('crud_permissions', User::class);

        // supprimer la ligne correspondance dans le base de données.
        $permission->whereid($id)->delete();        
        return redirect('/admin/permissions')->with('message', "La Permission est supprimer avec succès.");
    }
}