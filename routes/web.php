<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Clients\ClientsController;
use App\Http\Controllers\Fichiers\FichiersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlertsController;
use App\Http\Controllers\Config\ConfigController;

use App\Http\Controllers\User\UsersController;
use App\Http\Controllers\Roles\RolesController;
use App\Http\Controllers\Permissions\PermissionsController;
use App\Http\Controllers\Mail\MailController;
use App\Http\Controllers\EmailConfigurationController;


use App\Models\User;


Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);


Route::name('user.')->group(function(){
    Route::middleware(['auth:web', 'PreventBackHistory'])->group(function(){

        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        
        Route::get('/alerts', [AlertsController::class, 'index'])->name('alerts');
        Route::put('/alert-gerer', [AlertsController::class, 'update'])->name('alert-gerer');
        Route::get('/alert-filter', [AlertsController::class, 'filter'])->name('alert-filter');

        
        
        // Route de controlleur fichiers ( CRUD )
        Route::get('/fichiers', [FichiersController::class, 'index'])->name('fichiers');
        Route::post('/fichiers/clients', [FichiersController::class, 'show'])->name('fichier_client');
        Route::post('/fichiers', [FichiersController::class, 'search'])->name('recherch_fichier');



        // Route Cleint ( CRUD )
        Route::get('/clients', [ClientsController::class, 'index'])->name('clients');
        Route::get('/client_info/{id}/details', [ClientsController::class, 'show']);
        // Tabs
        Route::get('/home/clients-accepter', [ClientsController::class, 'clients_accepter'])->name('clients-accepter');
        Route::get('/home/clients-rejeter', [ClientsController::class, 'clients_rejeter'])->name('clients-rejeter');
        Route::post('user-request', [ClientsController::class, 'user_request'])->name('user-request');


        //09022022
        // Configurationd e serveur MAIL
        Route::get("/admin/emailconfiguration", [EmailConfigurationController::class, "index"])->name("email-configuration-index");
        Route::get('/admin/mail/create', [EmailConfigurationController::class, 'create'])->name('emailconfiguration_create');
        Route::post("/admin/email-configuration", [EmailConfigurationController::class, "createConfiguration"])->name("emailconfiguration_store");
        Route::get('/admin/mail/{id}/edit', [EmailConfigurationController::class, 'edit'])->name('mailconfiguration_edit', 'id');
        Route::post('/admin/mail/update', [EmailConfigurationController::class, 'update'])->name('mailconfiguration_update');
        Route::delete('/admin/{id}/delete', [EmailConfigurationController::class, 'destroy'])->name('mailconfiguration_delete', 'id');

        // Route pour afficher le page d'envoyer un mail static
        //Route::get("get-email", [EmailConfigurationController::class, "composeEmail"])->name("get-email");
        //Route::post("compose-email", [EmailConfigurationController::class, "sendtestmail"])->name('compose-email');

       
        // Route pour recevoire les email en cas d'un alerts et ( CRUD )
        Route::get('/admin/gerer_alerts/mails', [MailController::class, 'index'])->name('mails');                               // Index
        Route::get('/admin/gerer_alerts/mails/create', [MailController::class, 'create'])->name('create-email');                // Create  
        Route::post('/admin/gerer_alerts/mails/store', [MailController::class, 'store'])->name('new-email');                    // Store
        Route::post('/admin/gerer_alerts/mails/{id}/delete', [MailController::class, 'destroy'])->name('delete-email', 'id');   // Delete
        Route::get('/admin/gerer_alerts/mails/{id}/edit', [MailController::class, 'edit'])->name('edit-email', 'id');           // Edit
        Route::post('/admin/gerer_alerts/mails/{id}/update', [MailController::class, 'update'])->name('email-update', 'id');    // Update



        // Route pour gestion des utilisateurs ( CRUD )
        Route::get('/admin/utilisateurs', [UsersController::class, 'index'])->name('users');
        // IS Admin
        Route::get('/register', [UsersController::class, 'create'])->name('register');
        Route::post('/register', [UsersController::class, 'store'])->name('new-user');
        //Route::get('/view', [UsersController::class, 'index'])->name('admin_view');
        Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('edit');
        Route::post('/user/update', [UsersController::class, 'update'])->name('user_update');
        Route::post('/delete/{id}', [UsersController::class, 'destroy'])->name('user_delete', 'id');
        // IS Admin finished



        // Route pour CRUD de roles
        Route::get('/admin/roles', [RolesController::class, 'index'])->name('roles');
        Route::get('/admin/role', [RolesController::class, 'create'])->name('create-role');
        Route::post('/admin/role/store', [RolesController::class, 'store'])->name('new-role');
        Route::get('/admin/role/edit/{id}', [RolesController::class, 'edit'])->name('role_edit', 'id');
        Route::post('/admin/role/update/{id}', [RolesController::class, 'update'])->name('role-update', 'id');
        Route::post('/admin/role/delete/{id}', [RolesController::class, 'destroy'])->name('role_delete', 'id');


        // Route pour gestion de permissions ( CRUD )
        Route::get('/admin/permissions', [PermissionsController::class, 'index'])->name('permissions');
        Route::get('/admin/permission', [PermissionsController::class, 'create'])->name('create-permission');
        Route::post('/admin/permission/store', [PermissionsController::class, 'store'])->name('new-permission');
        Route::get('/admin/permission/edit/{id}', [PermissionsController::class, 'edit'])->name('permission_edit', 'id');
        Route::post('/admin/permission/update/{id}', [PermissionsController::class, 'update'])->name('permission-update', 'id');
        Route::post('/admin/permission/delete/{id}', [PermissionsController::class, 'destroy'])->name('permission_delete', 'id');


        /*
        Route::middleware(['is_admin:email'])->group(function () {
            //Route::get('/admin/email', [PermissionsController::class, 'index'])->name('email');
            //Route::get('/admin/email', [PermissionsController::class, 'create'])->name('create-email');
        });
        */

        Route::post('/logout', [ClientsController::class, 'logout'])->name('logout');
    });


    /*
    Route::middleware(['is_admin', 'PreventBackHistory'])->group(function(){
        //Route::get('/config', [ConfigController::class, 'index'])->name('config'); 
    });
    */

    //Route::middleware(['guest:web','PreventBackHistory'])->group(function(){ });
    //Route::middleware(['auth:web','PreventBackHistory'])->group(function(){ });

});






