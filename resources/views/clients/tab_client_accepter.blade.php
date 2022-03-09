
@extends('templates.dashboard')

@section('content')
<div class="table-responsive m-4 bg-white border rounded">

    @if(Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if(Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
    @endif


    <!-- Include le page tab -->
    @include('clients.tabs')

    <h2 class="px-2 py-3"> {{ __('Tous les clients Accepter')}} </h2>
    <table class="table table-bordered table-striped">
        <thead class="align-middle">
            <tr>
                <th scope="col"> {{ __('Nom d\'entreprise')}} </th>
                <th scope="col"> {{ __('Nom de client')}} </th>
                <th scope="col"> {{ __('Mobile')}} </th>
                <th scope="col"> {{ __('Email')}} </th>
                <th scope="col"> {{ __('Site')}} </th>
                <th scope="col"> {{ __('Date de enregistrement')}} </th>
                <th scope="col"> {{ __('Actions')}} </th>
            </tr>
            </thead>

            <tbody>
                @foreach ($clients as $client )
                <tr>
                    <td> {{ $client->nom_entreprise }} </td>
                    <td> {{ $client->nom_client }} </td>
                    <td>
                        <a href="tel:{{$client->mobile}}" class="text-decoration-none"> {{ $client->mobile }} </a>    
                    </td>
                    <td>
                        <a href="mailto:{{$client->email}}" class="text-decoration-none"> {{ $client->email }} </a></td>
                    <td> {{ $client->site }} </td>
                    <td> {{ $client->created_at}} </td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="/client_info/{{$client->id}}/details" class="btn btn-secondary"> <i class="fa fa-user"></i> {{ __('Profile')}} </a>
                            <form action="{{ route('user.fichier_client') }}" method="post">
                                @csrf 
                                <input type="hidden" name="id" value="{{$client->id}}">
                                <button type="submit" class="btn btn-primary mx-1"> <i class="fa fa-folder"></i> Fichiers</button>
                            </form>


                            @can('rejeter_request', App\Models\User::class)
                            <form id="rejeter-form" action="{{ route('user.user-request') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $client->id }}">
                                <button class="btn btn-danger" name="send" value="deny"><i class="fa fa-times"></i> Désactiver </button> 
                            </form>
                            @endcan

                        </div>
                        <!--<a href="client_info/{{$client->id}}/edit" class="btn btn-primary"> <i class="fa fa-edit"></i> {{ __('Edit')}} </a>-->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- End of responsive table -->


        {{-- Pagination --}}
        @if($clients instanceof \Illuminate\Pagination\LengthAwarePaginator )
        <div class="d-flex justify-content-center my-4">
            {!! $clients->links() !!}
        </div>
        @endif

</div>


@endsection