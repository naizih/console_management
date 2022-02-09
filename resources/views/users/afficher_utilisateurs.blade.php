
@extends('templates.dashboard')

@section('content')

    <a href="/register" class="btn btn-success"> Ajouter utilisateur </a>

    <div class="table-responsive my-2  bg-white border rounded">     
        <h2 class="px-2 py-3"> Utilisateurs </h2>
        <table class="table table-bordered table-striped">
            <thead class="align-middle">
                <tr>
                    <th scope="col"> {{ __('Nom')}} </th>
                    <th scope="col"> {{ __('Email')}} </th>
                    <th scope="col"> Role </th>
                    <!--<th scope="col"> Permissions </th>-->
                    <th scope="col"> {{ __('Actions')}} </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user )
                <tr>
                    <td> {{ $user->name }} </td>
                    <td> <a href="mailto:{{$user->email}}" class="text-decoration-none"> {{ $user->email }} </a> </td>

                    <td> <a href="{{ route('user.roles')}}"> {{ $user->role->name }} </a></td>

                    <!--
                    <td>
                        @foreach ( $user->role->permissions as $permission)
                            <li>
                                {{ $permission->slug }}
                            </li>
                        @endforeach
                    </td>
                    -->

                    <td class="text-center">
                        
                        <div class="btn-group">
                            
                            <a href="/edit/{{$user->id}}" class="btn btn-primary rounded mx-1"> <i class="fa fa-edit"></i> Modifier </a>


                            <form id="rejeter-form" action="{{ route('user.user_delete' , $user->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button class="btn btn-danger" ><i class="fa fa-trash"></i> Supprimer </button> 
                            </form>

                        </div>
                        <!--<a href="user_info/{{$user->id}}/edit" class="btn btn-primary"> <i class="fa fa-edit"></i> {{ __('Edit')}} </a>-->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- End of responsive table -->


        {{-- Pagination --}}
        @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator )
        <div class="d-flex justify-content-center my-4">
            {!! $users->links() !!}
        </div>
        @endif

@endsection
