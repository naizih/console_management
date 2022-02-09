



@extends('templates.dashboard')

@section('content')


<div class="col-md-10" style="margin: auto;">
    <div class="card p-4">
    
        <div class="row">
            <div class="col-sm-2">
                <img src="{{asset('images/profile.jpg')}}" class="img-fluid rounded-start" alt="...">
            </div>

            <div class="col-sm-8 mx-4">
                <h3 class="card-title"> Information de client </h3>
                <p class="card-text"><small class="text-muted"> Information de client {{$client->nom_entreprise}} </small> </p>


                <div class="row">
                    <span class="col-sm-4"> <i class="fa fa-building"></i> &nbsp; Nom d'entreprise :</span>
                    <div class="col-sm">
                    <p class="text-dark">{{$client->nom_entreprise}}</p>
                    </div>
                </div>

                <div class="row">
                    <span class="col-sm-4"> <i class="fa fa-map-marker"></i> &nbsp; Site (Location) :</span>
                    <div class="col-sm">
                        <p class="text-dark">{{$client->site}}</p>
                    </div>
                </div>
                
                <div class="row">
                    <span class="col-sm-4"> <i class="fa fa-user-circle"></i> &nbsp; Responsable (Admin) :</span>
                    <div class="col-sm">
                        <p class="text-dark">{{$client->nom_client}}</p>
                    </div>
                </div>
                    
                <div class="row">
                    <span class="col-sm-4"> <i class="fa fa-phone"></i> &nbsp; Téléphone :</span>
                    <div class="col-sm">
                        <p>
                            <a class="text-decoration-none" href="tel:{{$client->mobile}}"> {{$client->mobile}} </a>
                        </p>
                    </div>
                </div>
                
                <div class="row">
                    <span class="col-sm-4"><i class="fa fa-envelope"></i> &nbsp; Adresse Mail :</span>
                    <div class="col-sm">
                        <p>
                            <a class="text-decoration-none" href="mailto:{{$client->email}}"> {{$client->email}} </a>
                        </p>
                    </div>
                </div>

                <!--
                <div class="row pt-3">
                    <span class="col-sm-4 col-form-label"> &nbsp;</span>
                    <div class="col-sm">
                        <a class="btn btn-outline-secondary" href="#"> Modifier </a>
                    </div>
                </div>
                -->

            </div>
        </div>
    </div>
</div>











@endsection













