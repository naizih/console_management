

@extends('templates.dashboard')

@section('content')

<section>
    <div class="card">
        <div class="card-header">
            <h5> Afficher les fichiers de Alerts !</h5>
        </div>

        <div class="card-body">
            <div class="row">
                @foreach($fichiers as $fichier )
                <div class="col-sm-3">
                    <div class="card text-black alert alert-danger border border-danger">
                        <div class="card-header">
                            <h5 class="card-title"> {{ $fichier->fichier->client->nom_entreprise}} </h5>
                        </div>

                        <div class="card-body">                    
                            <div class="row">
                                <div class="col-sm-2">
                                    <i class="fa fa-user"></i> 
                                </div>
                                <div class="col-sm">
                                    {{$fichier->fichier->client->nom_client}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-2">
                                    <i class="fa fa-mobile"></i>
                                </div>
                                <div class="col-sm">
                                    <a class="text-decoration-none" href="tel:{{$fichier->fichier->client->mobile}}"> {{$fichier->fichier->client->mobile}} </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-2">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="col-sm">
                                    <a class="text-decoration-none" href="mailto:{{$fichier->fichier->client->email}}"> {{$fichier->fichier->client->email}} </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-2">
                                    <i class="fa fa-location-arrow"></i> 
                                </div>
                                <div class="col-sm">
                                    {{$fichier->fichier->client->site}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-2">
                                    <i class="fa fa-file"></i> 
                                </div>
                                <div class="col-sm">
                                    {{$fichier->fichier->nom_de_fichier}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2"> 
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="col-sm">
                                    {{$fichier->fichier->Chemin_de_fichier}}
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <div class="p-3 btn-group">
                                <a href="/client_info/{{$fichier->id}}/details" class="btn btn-primary"> <i class="fa fa-user"></i> Client</a>
                                <form action="{{ route('user.fichier_client') }}" method="post">
                                    @csrf 
                                    <input type="hidden" name="id" value="{{$fichier->id}}">
                                    <button type="submit" class="btn btn-primary mx-1"> <i class="fa fa-folder"></i> Fichiers</button>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Pagination --}}
        @if($fichiers instanceof \Illuminate\Pagination\LengthAwarePaginator )
        <div class="d-flex justify-content-center my-4">
            {!! $fichiers->links() !!}
        </div>
        @endif
    </div>
</section>

@endsection