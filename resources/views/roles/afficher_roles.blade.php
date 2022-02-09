
@extends('templates.dashboard')

@section('content')


    <div class="card">
        <div class="card-header">
            <h3> Liste du Roles </h3>
        </div>


        <div class="card-body">
            <div class="card-title">
            <a href="{{route('user.create-role')}}" class="btn btn-success"> Ajouter Role </a>

            </div>
            
            <table class="table table-bordered table-striped">
                <thead class="align-middle bg-dark text-white">
                    <tr>
                        <th scope="col"> # </th>
                        <th scope="col"> Nom de role </th>
                        <th scope="col"> Label  </th>
                        <th scope="col"> Permissions  </th>
                        <th scope="col"> Action </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $index => $role)
                        <tr>
                            <td> {{$index+1}} </td>
                            <td> {{ $role->name }} </td>
                            <td> {{ $role->slug }} </td>

                            <td>
                                @if ($role->slug == 'admin')
                                <ul>
                                    <li> Tous les permissions </li>
                                </ul>
                                @else
                                <ul>
                                    @foreach ($role->permissions as $permission)
                                        <li> {{ $permission->name }} </li>
                                    @endforeach
                                </ul>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="btn-group">
                                    <form id="rejeter-form" action="{{ route('user.role_delete' , $role->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $role->id }}">
                                        <button class="btn btn-danger" ><i class="fa fa-trash"></i> Supprimer </button> 
                                    </form>

                                    <a href="{{route('user.role_edit', $role->id )}}" class="btn btn-primary rounded mx-1"> <i class="fa fa-edit"></i> Modifier </a>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                
                </tbody>  
            </table>

        </div>
    </div>



@endsection
