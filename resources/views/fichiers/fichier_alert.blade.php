

@extends('templates.dashboard')

@section('content')

<section>
    <div class="card">
        <div class="card-header">
            <h3> Afficher les fichiers de Alerts !</h3>
        </div>

        <div class="card-body">


            @if(Session::get('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
            @endif



            <div class="col-sm-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Filtre par:</label>
                    </div>

                    <form action="{{ route('user.alert-filter') }}" method="post" id="form-filter">
                        @csrf
                        <select class="form-select"  name="filter" id="filter_alert">
                            <option value=""> Choisir un option pour filtrer </option>
                            <option value="alert_success"> Alertes non gérées </option>
                            <option value="alert_gerer"> Alertes gérées </option>
                        </select>
                    </form>
                </div>
            </div>

            <hr class="my-4">




            <div class="row">
                @foreach($fichiers as $fichier )
                <div class="col-sm-3">
                    @if($fichier->gerer == '1' )
                        <div class="card text-black alert alert-success border border-success">
                    @else
                        <div class="card text-black alert alert-danger border border-danger">
                    @endif
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

                            <div class="row">
                                <div class="col-sm-2"> 
                                    <i class="fa fa-history"></i>
                                </div>
                                <div class="col-sm">
                                    {{$fichier->fichier->created_at}}
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




<script type="text/javascript">
    $(document).ready(function() {
        $('select[name=filter]').change(function() {
            if ($('select[name=filter]').val().length != 0){
                $('#form-filter').submit();
            }
        });
    });
</script>

@endsection