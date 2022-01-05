@extends('templates.dashboard')

@section('content')
<div class="table-responsive m-4">
    <h2> Tous les fichiers de utilisateur <strong>{{$fichiers[0]->client->nom_client}}</strong> </h2>
    <table class="table table-bordered">
        <thead class="text-center align-middle">
            <tr>
                <th scope="col"> {{ __('Nom de fichier')}} </th>
                <th scope="col"> {{ __('Chemin de fichier')}} </th>
                <th scope="col"> {{ __('Date de dernier check')}} </th>
                <th scope="col"> {{ __('Date de creation')}} </th>
            </tr>
            </thead>

            <tbody>
                @foreach ($fichiers as $fichier )
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
</div>

@endsection