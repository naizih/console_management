


@extends('templates.dashboard')

@section('content')


<div class="table-responsive m-4">

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

    <h2> {{ __('All clients')}} </h2>
    <table class="table table-bordered">
        <thead class="text-center align-middle">
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
                            <a href="/client_info/{{$client->id}}/details" class="btn btn-success"> <i class="fa fa-eye"></i> {{ __('Afficher')}} </a>
                            <form action="{{ route('user.fichier_client') }}" method="post">
                                @csrf 
                                <input type="hidden" name="id" value="{{$client->id}}">
                                <button type="submit" class="btn btn-primary mx-1"> <i class="fa fa-folder"></i> Fichiers</button>
                            </form>
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
    <div class="d-flex justify-content-center my-4">
        {!! $clients->links() !!}
    </div>
</div>

@endsection