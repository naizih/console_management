<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\EmailConfiguration;
use Illuminate\Support\Facades\Mail;
use App\Mail\DynamicEmail;

class EmailConfigurationController extends Controller
{
    //

    public function index(){
        $config = EmailConfiguration::all();
        return view('config.email.afficher_configuration_email', ['configuration' => $config]);
    }

    public function create(Request $request) {
        $this->authorize('crud_emails', User::class);
        
        return view('config.email.ajouter_emailconfiguration');
    }

    public function createConfiguration(Request $request) {
        $this->authorize('crud_emails', User::class);

        $request->validate([
            'driver' => 'required',
            'hostName' => 'required',
            'port' => 'required',
            'encryption' => 'required',
            'userName'   => 'required',
            'password'  => 'required',
            'senderName' => 'required',
            'senderEmail' => 'required',
        ]);

        $configuration  =   EmailConfiguration::create([
            "user_id"       =>      \Auth::user()->id,
            "driver"        =>      $request->driver,
            "host"          =>      $request->hostName,
            "port"          =>      $request->port,
            "encryption"    =>      $request->encryption,
            "user_name"     =>      $request->userName,
            "password"      =>      $request->password,
            "sender_name"   =>      $request->senderName,
            "sender_email"  =>      $request->senderEmail
        ]);

        if(!is_null($configuration)) {
           return back()->with("success", "Email configuration created.");
        }

        else {
            return back()->with("failed", "Email configuration not created.");
        }
    }

    public function composeEmail() {
        return view("mails.email-compose");
    }

    public function sendEmail(Request $request) {
        $toEmail    =   $request->emailAddress;
        $data       =   array(
            'name' => 'khan',
            'email' => 'khan@gmail.com',
            'subject' => 'test',
            'phone' => '0534545245234',
            "message"    =>   $request->message
        );

        // pass dynamic message to mail class
        \Mail::to($toEmail)->send(new DynamicEmail($data));

        if(Mail::failures() != 0) {
            return back()->with("success", "E-mail sent successfully!");
        }

        else {
            return back()->with("failed", "E-mail not sent!");
        }
    }




    public function sendtestmail(Request $request) {
        //dd(config('mail'));
        $toEmail    =   $request->emailAddress;
        $data       =   array(
            'title' => 'Email',
            "body"    =>   $request->message
        );

        // pass dynamic message to mail class
        \Mail::to($toEmail)->send(new DynamicEmail($data));
        //dd("Email is Sent.");
    }





    public function edit($id)
    {
        $this->authorize('crud_emails', User::class);
     
        $config = EmailConfiguration::whereId($id)->first();
        return view('config.email.edit_configuration_email', ['config' => $config]);
    }


    public function update(Request $request, EmailConfiguration $config) {

        $this->authorize('crud_emails', User::class);
        
        //validate the fields
        $request->validate([
            'driver' => 'required',
            'hostName' => 'required',
            'port' => 'required',
            'encryption' => 'required',
            'userName'   => 'required',
            'password'  => 'required',
            'senderName' => 'required',
            'senderEmail' => 'required',
        ]);
        


      
        $config = $config->find($request->id);

        $config->driver = $request->driver;
        $config->host = $request->hostName;
        $config->port = $request->port;
        $config->encryption = $request->encryption;
        $config->user_name = $request->userName;
        $config->password = $request->password;
        $config->sender_name = $request->senderName;
        $config->sender_email =   $request->senderEmail;
        $config->save();


        return redirect('/admin/emailconfiguration')->with('message', "Vous avez Modifé avec succès le configuration de serveur mail.");

    }



    public function destroy(EmailConfiguration $config, $id) {

        $this->authorize('crud_emails', User::class);

        // supprimer la ligne correspondance dans le base de données.
        $config->where('id', $id)->delete();        
              
        return redirect('/admin/emailconfiguration')->with('message', "Le serveur smtp est supprimer avec succès..");
    }

}
