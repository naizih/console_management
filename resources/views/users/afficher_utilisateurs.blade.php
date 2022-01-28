



    <a href="/register" class="btn btn-success"> Ajouter utilisateur </a>

    <div class="table-responsive my-2  bg-white border rounded">     
        <h2 class="px-2 py-3"> {{ __('USERS')}} </h2>
        <table class="table table-bordered table-striped">
            <thead class="align-middle">
                <tr>
                    <th scope="col"> {{ __('Nom')}} </th>
                    <th scope="col"> {{ __('Email')}} </th>
                    <th scope="col"> Type d'utilisateur </th>
                    <th scope="col"> {{ __('Actions')}} </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($clients as $client )
                <tr>
                    <td> {{ $client->name }} </td>
                    <td> <a href="mailto:{{$client->email}}" class="text-decoration-none"> {{ $client->email }} </a> </td>
                    <td> {{ $client->is_admin == 1 ? 'Admin' : 'Utilisateur' }} </td>
                    <td class="text-center">
                        
                        <div class="btn-group">
                            <a href="/client_info/{{$client->id}}/details" class="btn btn-success rounded"> <i class="fa fa-eye"></i> Voir </a>

                            <a href="/edit/{{$client->id}}" class="btn btn-primary rounded mx-1"> <i class="fa fa-edit"></i> Modifier </a>


                            <form id="rejeter-form" action="{{ route('user.admin_delete' , $client->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $client->id }}">
                                <button class="btn btn-danger" ><i class="fa fa-trash"></i> Supprimer </button> 
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
        @if($clients instanceof \Illuminate\Pagination\LengthAwarePaginator )
        <div class="d-flex justify-content-center my-4">
            {!! $clients->links() !!}
        </div>
        @endif
