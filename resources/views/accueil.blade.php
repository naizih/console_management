
@extends('templates.dashboard')

@section('content')
<section>

    <div class="container">

        @if(Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
        @endif

        @if(Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif
      


        <h1> Accueil</h1>


        
        <hr>

        
        <!-- Si un nouveau utilisateur s'enregistre, on le affiche sur le page d'accueil pour approuver ou rejeter -->
        @if(count($clients) > 0 )
            @include('clients.nouveau_client_request')
        @endif



        @if(count($alerts) > 0 )
            @include('fichiers.accueil_fichier_alert')
        @endif




    </div>
</section>

@endsection
