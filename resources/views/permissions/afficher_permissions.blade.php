
@extends('templates.dashboard')

@section('content')


    <div class="card">
        <div class="card-header">
            <h3> Liste du Permissions </h3>
        </div>


        <div class="card-body">
            <div class="card-title">
            <a href="{{route('user.create-permission')}}" class="btn btn-success"> Ajouter permission </a>

            </div>
            
            <table class="table table-bordered table-striped">
                <thead class="align-middle bg-dark text-white">
                    <tr>
                        <th scope="col"> # </th>
                        <th scope="col"> Nom de permission </th>
                        <th scope="col"> Label  </th>
                        <th scope="col"> Action </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $index => $permission)
                        <tr>
                            <td> {{$index+1}} </td>
                            <td> {{ $permission->name }} </td>
                            <td> {{ $permission->slug }} </td>

                            <td class="text-center">
                        
                        <div class="btn-group">
                            <form id="rejeter-form" action="{{ route('user.permission_delete' , $permission->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $permission->id }}">
                                <button class="btn btn-danger" ><i class="fa fa-trash"></i> Supprimer </button> 
                            </form>

                            <a href="{{route('user.permission_edit', $permission->id )}}" class="btn btn-primary rounded mx-1"> <i class="fa fa-edit"></i> Modifier </a>

                        </div>
                    </td>


                        </tr>
                    @endforeach
                
                </tbody>  
            </table>

        </div>
    </div>



@endsection
