<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


use App\Models\Role;


class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //  
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {

    }







    public function crud_utilisateurs(User $user) {
        return $user->hasPermission('crud_utilisateurs');
    }

    public function crud_roles(User $user) {
        return $user->hasPermission('crud_roles');
    }

    public function crud_permissions(User $user) {
        return $user->hasPermission('crud_permissions');
    }

    public function crud_emails(User $user) {
        return $user->hasPermission('crud_emails');
    }

    public function user_management_button(User $user) {
        if ( $user->hasPermission('crud_utilisateurs') || $user->hasPermission('crud_roles') || $user->hasPermission('crud_permissions')){
            return true;
        }
    }


    public function user_configuration_button(User $user) {
        if ( $user->hasPermission('crud_emails') ){
            return true;
        }
    }




    public function accept_request(User $user){
        return $user->hasPermission('accepter_request');
    }

    public function rejeter_request(User $user){
        return $user->hasPermission('rejeter_request');
    }

    public function gerer_alert(User $user){
        return $user->hasPermission('gerer_alert');
    }
    

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
