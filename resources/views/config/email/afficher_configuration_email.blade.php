
@extends('templates.dashboard')

@section('content')

    @if (!count($configuration) > 0 )
    <a href="{{route('user.emailconfiguration_create')}}" class="btn btn-success"> Ajouter Configuration de Mail </a>
    @endif

    <div class="table-responsive my-2  bg-white border rounded">     
        <h2 class="px-2 py-3"> Serveurs Mail </h2>
        <table class="table table-bordered table-striped">
            <thead class="align-middle">
                <tr>
                    <th scope="col"> Driver </th>
                    <th scope="col"> Host </th>
                    <th scope="col"> Port </th>
                    <th scope="col"> Encryption </th>
                    <th scope="col"> User Name </th>
                    <th scope="col"> Password </th>
                    <th scope="col"> Actions </th>
                    
                </tr>
            </thead>

            <tbody>
                @foreach ($configuration as $config )
                <tr>
                    <td> {{ $config->driver }} </td>
                    <td> {{ $config->host }} </td>
                    <td> {{ $config->port }} </td>
                    <td> {{ $config->encryption }} </td>
                    <td> {{ $config->user_name }} </td>
                    <td> {{ $config->password }} </td>

                    <td class="text-center">
                        
                        <div class="btn-group">
                            
                            <a href="{{route('user.mailconfiguration_edit', $config->id)}}" class="btn btn-primary rounded mx-1"> <i class="fa fa-edit"></i> Modifier </a>


                            <form id="rejeter-form" action="{{route('user.mailconfiguration_delete', $config->id)}}" method="post">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger" ><i class="fa fa-trash"></i> Supprimer </button> 
                            </form>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- End of responsive table -->


        {{-- Pagination --}}
        @if($configuration instanceof \Illuminate\Pagination\LengthAwarePaginator )
        <div class="d-flex justify-content-center my-4">
            {!! $config->links() !!}
        </div>
        @endif

@endsection
