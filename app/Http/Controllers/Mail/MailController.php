<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Mail\MyTestMail;
use App\Models\Email;

use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //

    public function index()
    {
        $this->authorize('crud_emails', User::class);

        $emails = Email::get();
        return view('mails.afficher_email_responsable_alerts', compact('emails'));
    }



    public function create()
    {
        $this->authorize('crud_emails', User::class);
        //$this->authorize('gestion_utilisateur', User::class);
        return view('mails.ajouter_email_responsable_alert');

    }


    public function store(Request $request, Email $email){

        $this->authorize('crud_emails', User::class);

        $validator = $request->validate([
            'nom' => 'required|max:255',
            'email' => 'required|max:255',
            'description'   => 'required|max:1000',
        ]);

        $email->create([
            'name' =>  $request->nom,
            'email' =>  $request->email,
            'description'   => $request->description,
        ]);


        return redirect('/admin/gerer_alerts/mails')->with('message', "Vous avez crée avec succès le nouveau Email.");


    }

    public function show(Email $email)
    {
        //return view('admin.Emails.show', ['Email' => $Email]);
    }


    public function edit($id) {
        
        $this->authorize('crud_emails', User::class);

        $Email = Email::whereId($id)->first();
        return view('mails.modifier_mail_responsable_alerts',['email' => $Email]);
    }


    public function update(Request $request, Email $email, $id) {
        
        $this->authorize('crud_emails',$email);

        //validate the Email fields
        $request->validate([
            'nom' => 'required|max:255',
            'email' => 'required|max:255',
            'description'   => 'required|max:1000',
        ]);


        $email = $email->find($id);
        
        $email->name = $request->nom;
        $email->email = $request->email;
        $email->description = $request->description;
        $email->save();


        return redirect('/admin/gerer_alerts/mails')->with('message', "Vous avez Modifé avec succès le Email.");
       
    }

    public function destroy(Email $email, $id) {

        $this->authorize('crud_emails', User::class);

        // supprimer la ligne correspondance dans le base de données.
        $email->where('id', $id)->delete();        
        return redirect('/admin/gerer_alerts/mails')->with('message', "La Email est supprimer avec succès.");
    }

}
