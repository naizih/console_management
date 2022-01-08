
@extends('templates.dashboard')

@section('content')

<section>
    <div class="card">
        <div class="card-header">
            <h5> Chercher les fichiers de client !</h5>
        </div>
        
        <div class="card-body">

            @if(Session::get('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
            @endif
      
            <form method="post" action="{{ route('user.recherch_fichier') }}" autocomplet="off">
                @csrf

                <div class="col-sm-4">
                    <div class="row g-2">
                        <div class="col-sm">
                            <input type="text" class="form-control me-2" name="recherch" value="{{ old('search') }}" placeholder=" {{ __('Ecrire le nom entreprise') }}...">
                        </div>
                        <div class="col-sm">
                            <button class="btn btn-success" name="search" value="first"> {{ __('Recherche') }} </button>
                        </div>
                    </div>
                </div>
            </form>
            <hr class="my-4">




            <!-- Si il n'existe qu'un seule entreprise a ce nom rechercher -->
        @if($fichiers ?? '')
            @if ($nb_client === 1)
                <div class="table-responsive m-4">
                    <table class="table table-bordered">
                        <h3> Tous les fichiers de utilisateur <a href="client_info/{{ ($fichiers[0]->client->id)}}/details"> {{ ucfirst($fichiers[0]->client->nom_client)}}</a> </h3>
                        <thead class="text-center align-middle">
                            <tr>
                                <th scope="col"> {{ __('Nom de fichier')}} </th>
                                <th scope="col"> {{ __('Chemin de fichier')}} </th>
                                <th scope="col"> {{ __('Date de dernier check')}} </th>
                                <th scope="col"> {{ __('Date de creation')}} </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fichiers as $fichier)
                            <tr>
                                <td> {{ $fichier->nom_de_fichier }} </td>
                                <td> {{ $fichier->Chemin_de_fichier }} </td>
                                <td> {{ $fichier->date_du_dernier_check }} </td>
                                <td> {{ $fichier->created_at }} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            @endif
        @endif

        @if($clients ?? '')

                <p class="alert alert-success"> Pleusieur entreprise ont le meme nom !</p>
                @foreach ($clients as $client)
                    <form method="POST" action="{{ route('user.recherch_fichier') }}" autocomplet="off">
                        @csrf
                        <input type="hidden" class="me-2" name="second_search" value="{{$client['id']}}">
                        <button class="text-decoration-none btn btn-link" name="search" value="second"> Entreprise {{ $client['entreprise']}}  avec l'email {{ $client['email']}} </button>
                    </form>
                @endforeach
        @endif

           


            
        </div>
    </div>
</section>

@endsection